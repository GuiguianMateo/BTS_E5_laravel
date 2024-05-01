<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\Demande;
use App\Models\praticien;
use App\Models\Type;
use App\Models\User;
use Tests\TestCase;
use Silber\Bouncer\BouncerFacade as Bouncer;

class DemandeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_without_role_can_view_demande_index() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/demande');


        $response->assertStatus(401);
    }

    public function test_user_without_role_cant_reject_demande() : void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $demande = Demande::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete("/demande/{$demande->id}");

        $response->assertStatus(401);
    }

    public function test_user_with_role_can_view_demande_index() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('demande-acces');
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/demande');


        $response->assertStatus(200);
        $response->assertViewIs('demande.index');
    }

    // public function test_user_with_role_can_store_demande() : void
    // {
    //     $user = User::factory()->create();
    //     Bouncer::assign('employe')->to($user);
    //     Bouncer::allow('employe')->to('demande-create');
    //     Bouncer::refresh();

    //     $praticien = Praticien::factory()->create();
    //     $type = Type::factory()->create();
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->post("/demande", [
    //             'date' => '2022-12-22',
    //             'deadline' => '2023-12-22',
    //             'delay' => '1',
    //             'type_id' => $type->id,
    //             'user_id' => $user->id,
    //             'praticien_id' => $praticien->id,
    //         ]);

    //     $response->assertStatus(200);
    //     $response->assertRedirect('/demande');
    // }

    public function test_user_with_role_can_accept_demande() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('demande-reject');
        Bouncer::allow('employe')->to('demande-accept');
        Bouncer::allow('employe')->to('consultation-create');
        Bouncer::refresh();

        $demande = Demande::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post("/consultation", [
                'date' => $demande->date,
                'deadline' => $demande->deadline,
                'delay' => $demande->delay,
                'type_id' => $demande->type_id,
                'user_id' => $demande->user_id,
                'praticien_id' => $demande->praticien_id,
            ]);

            $responsedelete = $this
                ->actingAs($user)
                ->delete("/demande/{$demande->id}");
            $responsedelete->assertStatus(302);


        $response->assertStatus(302);
        $this->assertDatabaseMissing('demandes', ['id' => $demande->id]);
    }


    public function test_user_with_role_can_reject_demande() : void
    {
        $user = User::factory()->create();
        Bouncer::assign('employe')->to($user);
        Bouncer::allow('employe')->to('demande-reject');
        Bouncer::refresh();

        $demande = Demande::factory()->create();

        $this->assertDatabaseHas('demandes', ['id' => $demande->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/demande/{$demande->id}");

        $response->assertRedirect('/demande');

        $this->assertDatabaseMissing('demandes', ['id' => $demande->id]);

    }

}
