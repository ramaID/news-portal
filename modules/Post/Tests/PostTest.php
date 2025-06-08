<?php

namespace Modules\Post\Tests;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class PostTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @var User */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->getAdminUser());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_index_page()
    {
        $this->get(route('modules::post.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page()
    {
        $this->get(route('modules::post.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data()
    {
        $attributes = Post::factory()->raw();
        unset($attributes['published_at']);

        $this->post(route('modules::post.store'), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_show_page()
    {
        $post = Post::factory()->create();

        $this->get(route('modules::post.show', $post))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page()
    {
        $post = Post::factory()->create();

        $this->get(route('modules::post.edit', $post))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data()
    {
        $post = Post::factory()->create();
        $attributes = $post->toArray();
        $attributes['title'] = 'Updated Title';
        $attributes['published_at'] = now()->toDateTimeString();

        $this->put(route('modules::post.update', $post), $attributes)
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data()
    {
        $post = Post::factory()->create();

        $this->delete(route('modules::post.destroy', $post))->assertStatus(302);
    }
}
