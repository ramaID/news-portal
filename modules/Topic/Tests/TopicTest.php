<?php

namespace Modules\Topic\Tests;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class TopicTest extends TestCase
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
        $this->get(route('modules::topic.index'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_create_page()
    {
        $this->get(route('modules::topic.create'))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_store_data()
    {
        $attributes = Topic::factory()->raw();

        $this->post(route('modules::topic.store'), $attributes)->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_open_edit_page()
    {
        $topic = Topic::factory()->create();

        $this->get(route('modules::topic.edit', $topic))->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_data()
    {
        $topic = Topic::factory()->create();
        $attributes = $topic->toArray();
        $attributes['name'] = 'Updated Name';
        $attributes['slug'] = 'Updated Slug';

        $this->put(route('modules::topic.update', $topic), $attributes)->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_data()
    {
        $topic = Topic::factory()->create();

        $this->delete(route('modules::topic.destroy', $topic))->assertStatus(302);
    }
}
