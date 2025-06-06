<?php

namespace Modules\Topic\Tests;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravolt\Platform\Models\Permission;
use Laravolt\Platform\Models\Role;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @var User */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat pengguna admin
        Artisan::call('laravolt:admin Administrator admin@laravolt.dev secret');

        Artisan::call('laravolt:sync-permission');

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermission(
            ['*'] + \Laravolt\Platform\Models\Permission::all()->pluck('name')->toArray()
        );

        $admin = User::query()->where('email', 'admin@laravolt.dev')->first();
        $admin->assignRole('admin');

        $this->user = $admin;
        $this->actingAs($this->user);
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
