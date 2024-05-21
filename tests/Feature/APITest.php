<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Silber\Bouncer\BouncerFacade as Bouncer;

class APITest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_licence_API_index_method_returns_correct_view()
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/api/praticien');

        $response->assertStatus(200);
        $response->assertOk();
    }
}
