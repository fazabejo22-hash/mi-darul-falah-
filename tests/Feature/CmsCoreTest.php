<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CmsCoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_cms_core_tables_are_available(): void
    {
        $this->assertTrue(Schema::hasTable('pages'));
        $this->assertTrue(Schema::hasTable('post_categories'));
        $this->assertTrue(Schema::hasTable('posts'));
    }

    public function test_post_belongs_to_category_and_author(): void
    {
        $category = PostCategory::create([
            'name' => 'Berita',
            'slug' => 'berita',
        ]);

        $author = User::factory()->create();

        $post = Post::create([
            'post_category_id' => $category->id,
            'author_id' => $author->id,
            'title' => 'Berita Uji',
            'slug' => 'berita-uji',
            'content' => 'Konten berita uji.',
        ]);

        $this->assertTrue($post->category->is($category));
        $this->assertTrue($post->author->is($author));
    }

    public function test_super_admin_receives_manage_website_permission(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $this->assertTrue($admin->can('manage-website'));
    }
}
