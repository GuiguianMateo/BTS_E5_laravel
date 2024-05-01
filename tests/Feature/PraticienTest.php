<?php

namespace Tests\Feature;

use App\Models\Praticien;
use App\Models\Consultation;
use App\Models\Type;
use App\Models\User;
use Tests\TestCase;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PraticienTest extends TestCase
{

    use DatabaseTransactions;

    public function test_user_without_role_cant_view_praticien_index() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/praticien');


        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_create_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/praticien/create');

        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_edit_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $praticien = Praticien::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/praticien/{$praticien->id}/edit");

        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_delete_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $praticien = Praticien::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete("/praticien/{$praticien->id}");

        $response->assertStatus(401);
    }


    /* --User With Abilities-- */

    public function test_user_with_role_can_view_praticien_index() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('praticien-acces');
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/praticien');


        $response->assertStatus(200);
        $response->assertViewIs('praticien.index');
    }

    public function test_user_with_role_can_create_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('praticien-create');
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/praticien/create');

        $response->assertStatus(200);
    }


    // public function test_user_with_role_can_store_praticien() : void
    // {
    //     $user = User::factory()->create();
    //     Bouncer::assign('employe')->to($user);
    //     Bouncer::allow('employe')->to('praticien-create');
    //     Bouncer::refresh();

    //     $type = Type::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->post("/praticien", [
    //             'name' => 'bobb',
    //             'job' => 'vlogeur',
    //             'type_id' => $type->id,
    //         ]);

    //     $response->assertStatus(200);
    // }


    public function test_user_with_role_can_edit_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('praticien-edit');
        Bouncer::refresh();

        $praticien = Praticien::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/praticien/{$praticien->id}/edit");

        $response->assertStatus(200);
    }

    public function test_user_with_role_can_update_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('praticien-edit');
        Bouncer::refresh();

        $type = Type::factory()->create();
        $praticien = Praticien::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/praticien/{$praticien->id}/edit", [
                'name' => 'bobb',
                'job' => 'vlogeur',
                'type_id' => $type->id,

            ]);

        $response->assertStatus(200);
    }


    public function test_user_with_role_can_delete_praticien() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('praticien-delete');
        Bouncer::refresh();

        $praticien = Praticien::factory()->create();

        $this->assertDatabaseHas('praticiens', ['id' => $praticien->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/praticien/{$praticien->id}");

        $response->assertRedirect('/praticien');

        $this->assertDatabaseMissing('praticiens', ['id' => $praticien->id]);

    }
}
