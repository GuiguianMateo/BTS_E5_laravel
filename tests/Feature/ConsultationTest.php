<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\praticien;
use App\Models\Type;
use App\Models\User;
use Tests\TestCase;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConsultationTest extends TestCase
{

    use DatabaseTransactions;

    public function test_user_without_role_can_view_consultation_index() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/consultation');


        $response->assertStatus(200);
        $response->assertViewIs('consultation.index');
    }

    public function test_user_without_role_cant_create_consultation() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/consultation/create');

        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_edit_consultation() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $consultation = Consultation::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/consultation/{$consultation->id}/edit");

        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_delete_consultation() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $consultation = Consultation::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete("/consultation/{$consultation->id}");

        $response->assertStatus(401);
    }


    /* --User With Abilities-- */
    public function test_user_with_role_can_create_consultation() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('demande-create');
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/consultation/create');

        $response->assertStatus(200);
    }


    // public function test_user_with_role_can_store_consultation() : void
    // {
    //     $user = User::factory()->create();
    //     Bouncer::assign('employe')->to($user);
    //     Bouncer::allow('employe')->to('consultation-create');
    //     Bouncer::refresh();

    //     $praticien = Praticien::factory()->create();
    //     $type = Type::factory()->create();
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->post("/consultation", [
    //             'date' => '2022-12-22',
    //             'deadline' => '2023-12-22',
    //             'delay' => '1',
    //             'type_id' => $type->id,
    //             'user_id' => $user->id,
    //             'praticien_id' => $praticien->id,
    //         ]);

    //     $response->assertStatus(200);
    //     $response->assertRedirect('/consultation');
    // }


    public function test_user_with_role_can_view_consultation_show() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('consultation-show');
        Bouncer::refresh();

        $consultation = Consultation::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/consultation/{$consultation->id}");

        $response->assertStatus(200);
    }

    // public function test_user_with_role_can_edit_consultation() : void
    // {
    //     $user = User::factory()->create();
    //     Bouncer::assign('employe')->to($user);
    //     Bouncer::allow('employe')->to('consultation-edit');
    //     Bouncer::refresh();

    //     $consultation = Consultation::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->get("/consultation/{$consultation->id}/edit");

    //     $response->assertStatus(200);
    // }

    // public function test_user_with_role_can_update_consultation() : void
    // {
    //     $user = User::factory()->create();
    //     Bouncer::assign('employe')->to($user);
    //     Bouncer::allow('employe')->to('consultation-edit');
    //     Bouncer::refresh();

    //     $consultation = Consultation::factory()->create();
    //     $type = Type::factory()->create();
    //     $praticien = Praticien::factory()->create();
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->patch("/consultation/{$consultation->id}", [
    //             'date' => '2022-12-22',
    //             'deadline' => '2023-12-22',
    //             'delay' => '1',
    //             'type_id' => $type->id,
    //             'user_id' => $user->id,
    //             'praticien_id' => $praticien->id,
    //         ]);

    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect('/consultation');
    // }


    public function test_user_with_role_can_delete_consultation() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('consultation-delete');
        Bouncer::refresh();

        $consultation = Consultation::factory()->create();

        $this->assertDatabaseHas('consultations', ['id' => $consultation->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/consultation/{$consultation->id}");

        $response->assertRedirect('/consultation');

        $this->assertDatabaseMissing('consultations', ['id' => $consultation->id]);

    }
}
