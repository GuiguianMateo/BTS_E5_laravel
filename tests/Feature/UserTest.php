<?php

namespace Tests\Feature;


use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_people_with_account_can_show_user_info() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
