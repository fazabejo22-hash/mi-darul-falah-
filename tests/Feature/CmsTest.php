<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Page;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\Document;
use App\Models\Facility;
use App\Models\Achievement;
use App\Models\Extracurricular;
use App\Models\SchoolProfile;
use App\Filament\Resources\EventResource\Pages\ManageEvents;
use App\Filament\Resources\DocumentResource\Pages\ManageDocuments;
use App\Filament\Resources\PageResource\Pages\ManagePages;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SchoolProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
        $this->seed(SchoolProfileSeeder::class);
    }

    public function test_migrate_fresh_and_seed_successful(): void
    {
        $this->assertDatabaseHas('school_profiles', ['npsn' => '69881899']);
        $this->assertDatabaseHas('roles', ['name' => 'Super Admin']);
        $this->assertDatabaseHas('roles', ['name' => 'Siswa']);
        $this->assertDatabaseHas('roles', ['name' => 'Orang Tua/Wali']);
    }

    public function test_school_profile_editable(): void
    {
        $profile = SchoolProfile::first();
        $profile->update(['headmaster' => 'Drs. Ach. Azhari Updated']);
        $this->assertEquals('Drs. Ach. Azhari Updated', $profile->fresh()->headmaster);
    }

    public function test_roles_and_permissions_authorization_access(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('Super Admin');

        $adminTu = User::factory()->create();
        $adminTu->assignRole('Admin/TU');

        $kepala = User::factory()->create();
        $kepala->assignRole('Kepala Madrasah');

        $student = User::factory()->create();
        $student->assignRole('Siswa');

        $parent = User::factory()->create();
        $parent->assignRole('Orang Tua/Wali');

        $inactive = User::factory()->create(['is_active' => false]);
        $inactive->assignRole('Super Admin');

        // Super Admin can access admin panel
        $this->actingAs($superAdmin)->get('/admin')->assertStatus(200);

        // Admin/TU can access admin panel
        $this->actingAs($adminTu)->get('/admin')->assertStatus(200);

        // Kepala Madrasah can access admin panel
        $this->actingAs($kepala)->get('/admin')->assertStatus(200);

        // Student denied
        $response = $this->actingAs($student)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());

        // Parent denied
        $response = $this->actingAs($parent)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());

        // Inactive user denied
        $response = $this->actingAs($inactive)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());
    }

    public function test_page_creation_via_filament_action_and_slug_uniqueness(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        Livewire::actingAs($admin)
            ->test(ManagePages::class)
            ->callAction('create', data: [
                'title' => 'Profil Sekolah',
                'slug' => 'profil-sekolah',
                'content' => 'Konten profil madrasah...',
                'status' => 'published',
                'seo_title' => 'Profil MI Darul Falah',
                'sort_order' => 1,
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas('pages', [
            'slug' => 'profil-sekolah',
            'status' => 'published',
            'seo_title' => 'Profil MI Darul Falah',
            'sort_order' => 1,
            'created_by' => $admin->id,
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Page::create([
            'title' => 'Duplikat',
            'slug' => 'profil-sekolah',
            'content' => 'Duplikat...',
        ]);
    }

    public function test_post_and_category_relations(): void
    {
        $category = PostCategory::create([
            'name' => 'Berita Utama',
            'slug' => 'berita-utama',
        ]);

        $author = User::factory()->create();

        $post = Post::create([
            'post_category_id' => $category->id,
            'author_id' => $author->id,
            'title' => 'Kegiatan Aswaja',
            'slug' => 'kegiatan-aswaja',
            'content' => 'Isi berita kegiatan aswaja...',
            'status' => 'published',
        ]);

        $this->assertEquals($category->id, $post->category->id);
        $this->assertEquals($author->id, $post->author->id);
        $this->assertCount(1, $category->posts);
    }

    public function test_announcement_pinned_and_priority(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $announcement = Announcement::create([
            'title' => 'Pengumuman Penting',
            'slug' => 'pengumuman-penting',
            'content' => 'Isi pengumuman...',
            'is_pinned' => true,
            'priority' => 10,
            'created_by' => $admin->id,
        ]);

        $this->assertDatabaseHas('announcements', [
            'slug' => 'pengumuman-penting',
            'is_pinned' => true,
            'priority' => 10,
        ]);
    }

    public function test_achievement_with_category(): void
    {
        $achievement = Achievement::create([
            'title' => 'Juara 1 MTQ',
            'slug' => 'juara-1-mtq',
            'category' => 'Akademik',
            'level' => 'Kabupaten',
        ]);

        $this->assertDatabaseHas('achievements', [
            'slug' => 'juara-1-mtq',
            'category' => 'Akademik',
        ]);
    }

    public function test_event_validation_fails_when_end_at_is_before_start_at(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        Livewire::actingAs($admin)
            ->test(ManageEvents::class)
            ->callAction('create', data: [
                'title' => 'Event Invalid',
                'slug' => 'event-invalid',
                'start_at' => now()->addDays(5)->toDateTimeString(),
                'end_at' => now()->addDays(2)->toDateTimeString(),
                'status' => 'published',
            ])
            ->assertHasActionErrors(['end_at']);

        $this->assertDatabaseMissing('events', ['slug' => 'event-invalid']);
    }

    public function test_event_can_be_created_with_valid_dates(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        Livewire::actingAs($admin)
            ->test(ManageEvents::class)
            ->callAction('create', data: [
                'title' => 'Event Valid',
                'slug' => 'event-valid',
                'start_at' => now()->addDays(5)->toDateTimeString(),
                'end_at' => now()->addDays(6)->toDateTimeString(),
                'status' => 'published',
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas('events', ['slug' => 'event-valid']);
    }

    public function test_gallery_and_gallery_item_relation(): void
    {
        $gallery = Gallery::create([
            'title' => 'Porsenitas 2026',
            'slug' => 'porsenitas-2026',
            'is_published' => true,
        ]);

        $item = GalleryItem::create([
            'gallery_id' => $gallery->id,
            'image_path' => 'galleries/items/test.jpg',
            'caption' => 'Lari cepat',
        ]);

        $this->assertEquals($gallery->id, $item->gallery->id);
        $this->assertCount(1, $gallery->items);
    }

    public function test_document_upload_validation_fails_with_invalid_file_type(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $fakePhpFile = UploadedFile::fake()->create('malicious.php', 100, 'application/x-php');

        Livewire::actingAs($admin)
            ->test(ManageDocuments::class)
            ->callAction('create', data: [
                'title' => 'Dokumen Malicious',
                'slug' => 'dokumen-malicious',
                'file_path' => $fakePhpFile,
                'is_published' => true,
            ])
            ->assertHasActionErrors(['file_path']);

        $this->assertDatabaseMissing('documents', ['slug' => 'dokumen-malicious']);
    }

    public function test_document_upload_succeeds_with_valid_pdf(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $fakePdf = UploadedFile::fake()->create('panduan.pdf', 500, 'application/pdf');

        Livewire::actingAs($admin)
            ->test(ManageDocuments::class)
            ->callAction('create', data: [
                'title' => 'Panduan Resmi',
                'slug' => 'panduan-resmi',
                'file_path' => $fakePdf,
                'is_published' => true,
            ])
            ->assertHasNoActionErrors();

        $this->assertDatabaseHas('documents', ['slug' => 'panduan-resmi']);
    }

    public function test_cms_resource_server_side_authorization(): void
    {
        $kepala = User::factory()->create();
        $kepala->assignRole('Kepala Madrasah');

        $student = User::factory()->create();
        $student->assignRole('Siswa');

        $parent = User::factory()->create();
        $parent->assignRole('Orang Tua/Wali');

        $inactive = User::factory()->create(['is_active' => false]);
        $inactive->assignRole('Super Admin');

        // Kepala Madrasah can view any, but cannot create (canCreate returns false for Kepala Madrasah)
        $this->assertTrue(ManagePages::canViewAny());
        $this->assertFalse(ManagePages::canCreate());

        // Student cannot access ManageDocuments
        Livewire::actingAs($student)
            ->test(ManageDocuments::class)
            ->assertForbidden();

        // Parent cannot access ManageDocuments
        Livewire::actingAs($parent)
            ->test(ManageDocuments::class)
            ->assertForbidden();

        // Inactive Super Admin cannot access ManageDocuments
        Livewire::actingAs($inactive)
            ->test(ManageDocuments::class)
            ->assertForbidden();
    }

    public function test_facility_achievement_extracurricular_models(): void
    {
        $facility = Facility::create(['name' => 'Perpustakaan', 'slug' => 'perpustakaan', 'quantity' => 1]);
        $achievement = Achievement::create(['title' => 'Juara 1 MTQ', 'slug' => 'juara-1-mtq', 'category' => 'Akademik']);
        $extracurricular = Extracurricular::create(['name' => 'Pramuka', 'slug' => 'pramuka']);

        $this->assertDatabaseHas('facilities', ['slug' => 'perpustakaan']);
        $this->assertDatabaseHas('achievements', ['slug' => 'juara-1-mtq']);
        $this->assertDatabaseHas('extracurriculars', ['slug' => 'pramuka']);
    }

    public function test_soft_deletes_on_cms_models(): void
    {
        $page = Page::create([
            'title' => 'Halaman Hapus',
            'slug' => 'halaman-hapus',
            'content' => 'Hapus...',
        ]);

        $page->delete();

        $this->assertSoftDeleted('pages', ['slug' => 'halaman-hapus']);
    }
}
