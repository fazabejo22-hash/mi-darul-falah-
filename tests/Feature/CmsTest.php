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
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SchoolProfileSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_school_profile_exists_and_is_editable(): void
    {
        $profile = SchoolProfile::first();
        $this->assertEquals('MI Darul Falah', $profile->name);
        $this->assertEquals('69881899', $profile->npsn);

        $profile->update(['headmaster' => 'Drs. Ach. Azhari Updated']);
        $this->assertEquals('Drs. Ach. Azhari Updated', $profile->fresh()->headmaster);
    }

    public function test_page_creation_and_slug_uniqueness(): void
    {
        $page = Page::create([
            'title' => 'Sejarah Madrasah',
            'slug' => 'sejarah-madrasah',
            'content' => 'Sejarah berdirinya MI Darul Falah...',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('pages', ['slug' => 'sejarah-madrasah']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Page::create([
            'title' => 'Sejarah Duplikat',
            'slug' => 'sejarah-madrasah',
            'content' => 'Duplikat slug',
        ]);
    }

    public function test_post_and_category_relations(): void
    {
        $category = PostCategory::create([
            'name' => 'Kegiatan',
            'slug' => 'kegiatan',
            'is_active' => true,
        ]);

        $author = User::factory()->create();

        $post = Post::create([
            'post_category_id' => $category->id,
            'author_id' => $author->id,
            'title' => 'Lomba Maulid Nabi',
            'slug' => 'lomba-maulid-nabi',
            'content' => 'Siswa siswi antusias mengikuti lomba...',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertEquals($category->id, $post->category->id);
        $this->assertEquals($author->id, $post->author->id);
        $this->assertCount(1, $category->posts);
    }

    public function test_announcement_creation(): void
    {
        $announcement = Announcement::create([
            'title' => 'Libur Semester',
            'slug' => 'libur-semester',
            'content' => 'Libur semester dimulai tanggal...',
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('announcements', ['title' => 'Libur Semester']);
    }

    public function test_event_creation(): void
    {
        $event = Event::create([
            'title' => 'Porsenitas',
            'slug' => 'porsenitas',
            'description' => 'Pekan olahraga dan seni...',
            'start_at' => now()->addDays(2),
            'end_at' => now()->addDays(3),
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('events', ['slug' => 'porsenitas']);
    }

    public function test_gallery_and_items_relation(): void
    {
        $gallery = Gallery::create([
            'title' => 'Wisuda 2026',
            'slug' => 'wisuda-2026',
            'is_published' => true,
        ]);

        $item = GalleryItem::create([
            'gallery_id' => $gallery->id,
            'image_path' => 'galleries/items/test.jpg',
            'caption' => 'Foto bersama',
        ]);

        $this->assertEquals($gallery->id, $item->gallery->id);
        $this->assertCount(1, $gallery->items);
    }

    public function test_document_creation(): void
    {
        $doc = Document::create([
            'title' => 'Brosur PPDB 2026',
            'slug' => 'brosur-ppdb-2026',
            'file_path' => 'documents/brosur.pdf',
            'category' => 'Brosur',
            'is_published' => true,
        ]);

        $this->assertDatabaseHas('documents', ['title' => 'Brosur PPDB 2026']);
    }

    public function test_facility_achievement_extracurricular_crud(): void
    {
        $facility = Facility::create(['name' => 'Ruang Kelas', 'slug' => 'ruang-kelas', 'quantity' => 6]);
        $achievement = Achievement::create(['title' => 'Juara 1 Olimpiade', 'slug' => 'juara-1-olimpiade']);
        $extracurricular = Extracurricular::create(['name' => 'Pramuka', 'slug' => 'pramuka']);

        $this->assertDatabaseHas('facilities', ['slug' => 'ruang-kelas']);
        $this->assertDatabaseHas('achievements', ['slug' => 'juara-1-olimpiade']);
        $this->assertDatabaseHas('extracurriculars', ['slug' => 'pramuka']);
    }

    public function test_cms_authorization_access(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('Super Admin');

        $student = User::factory()->create();
        $student->assignRole('Siswa');

        // Super Admin can access admin panel
        $this->actingAs($superAdmin)->get('/admin')->assertStatus(200);

        // Student cannot access admin panel
        $response = $this->actingAs($student)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());
    }
}
