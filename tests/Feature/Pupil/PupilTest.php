<?php

namespace Tests\Feature\Pupil;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pupil;

class PupilTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_pupil(): void
    {
        $user = User::where('role', 'admin')->first();
        $response = $this->actingAs($user)->get('/pupil/create');

        $response->assertStatus(200);
    }

    public function test_can_store_pupil()
    {
        $user = User::where('role', 'admin')->first();
        $response = $this->actingAs($user)->post('/pupil', [
            'name' => '長谷川　蛍介',
            'sex' => '1',
            'birthday' => '2010-1-1',
            'skill' => '四段',
            'note' => '四段です！',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('pupils', [
            'name' => '長谷川　蛍介',
            'sex' => '1',
            'birthday' => '2010-1-1',
            'skill' => '四段',
            'note' => '四段です！',
            'user_id' => $user->id,
        ]);
    }

    public function test_can_edit_pupil(): void
    {
        $user = User::where('role', 'admin')->first();
        $pupil = Pupil::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/pupil/' . $pupil->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_can_update_pupil()
    {
        $user = User::where('role', 'admin')->first();
        $pupil = Pupil::factory()->create(['user_id' => $user->id]);

        $response =  $this->actingAs($user)->put('/pupil/' . $pupil->id, [
            'name' => '伊崎　志遠',
            'sex' => '1',
            'birthday' => '2010-4-4',
            'skill' => '5段',
            'note' => '5段です！',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('pupils', [
            'name' => '伊崎　志遠',
            'sex' => '1',
            'birthday' => '2010-4-4',
            'skill' => '5段',
            'note' => '5段です！',
            'user_id' => $user->id,
        ]);
    }

    public function test_can_delete_pupil()
    {
        $user = User::where('role', 'admin')->first();
        $pupil = Pupil::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete('/pupil/' . $pupil->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('pupils', ['id' => $pupil->id]);

        $adminUser = User::where('role', 'admin')->first();
        $pupil3 = Pupil::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($adminUser)->delete('/pupil/' . $pupil3->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('pupils', ['id' => $pupil3->id]);
    }
}
