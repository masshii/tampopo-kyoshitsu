<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_post(): void
    {
        $user = User::where('role', 'admin')->first();
        $response = $this->actingAs($user)->get('/post/create');

        $response->assertStatus(200);
    }

    public function test_can_store_post()
    {
        $user = User::where('role', 'admin')->first();
        $response = $this->actingAs($user)->post('/post', [
            'title' => 'テスト投稿',
            'body' => 'テスト投稿をします',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('posts', [
            'title' => 'テスト投稿',
            'body' => 'テスト投稿をします',
            'user_id' => $user->id,
        ]);
    }

    public function test_can_edit_post(): void
    {
        $user = User::where('role', 'admin')->first();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/post/' . $post->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_can_update_post()
    {
        $user = User::where('role', 'admin')->first();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response =  $this->actingAs($user)->put('/post/' . $post->id, [
            'title' => '投稿の更新',
            'body' => '投稿の更新をしました',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('posts', [
            'title' => '投稿の更新',
            'body' => '投稿の更新をしました',
            'user_id' => $user->id,
        ]);
    }

    public function test_can_delete_post()
    {
        $user = User::where('role', 'admin')->first();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/post/' . $post->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        $adminUser = User::where('role', 'admin')->first();
        $post3 = Post::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($adminUser)->delete('/post/' . $post3->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['id' => $post3->id]);
    }
}
