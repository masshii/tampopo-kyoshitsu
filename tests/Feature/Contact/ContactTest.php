<?php

namespace Tests\Feature\Contact;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_contact(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/contact/create');

        $response->assertStatus(200);
    }

    public function test_can_store_contact(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/contact/store', [
            'title' => 'お問い合わせテスト',
            'body' => 'お問い合わせのテスト',
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('contacts', [
            'title' => 'お問い合わせテスト',
            'body' => 'お問い合わせのテスト',
            'email' => 'test@test.com',
        ]);
    }
}
