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

    public function test_page_creation_and_slug_uniqueness(): void
    {
        Page::create([
            'title' => 'Profil Sekolah',
            'slug' => 'profil-sekolah',
            'content' => 'Konten profil...',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('pages', ['slug' => 'profil-sekolah']);

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

    public function test_document_upload_and_validation(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('panduan.pdf', 1500, 'application/pdf');

        $doc = Document::create([
            'title' => 'Panduan Kurikulum',
            'slug' => 'panduan-kurikulum',
            'file_path' => $file->store('documents', 'public'),
            'file_name' => 'panduan.pdf',
            'file_size' => $file->getSize(),
            'mime_type' => 'application/pdf',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('documents', ['slug' => 'panduan-kurikulum']);
        $this->assertEquals('application/pdf', $doc->mime_type);
    }

    public function test_facility_achievement_extracurricular_models(): void
    {
        $facility = Facility::create(['name' => 'Perpustakaan', 'slug' => 'perpustakaan', 'quantity' => 1]);
        $achievement = Achievement::create(['title' => 'Juara 1 MTQ', 'slug' => 'juara-1-mtq']);
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
