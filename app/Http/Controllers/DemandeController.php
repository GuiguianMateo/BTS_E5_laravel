<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Demande;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demandes = demande::all();
        return view('demande.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $demandes = demande::all();
        // $types = type::all();
        // $users = user::all();
        // return view('demande.create', compact('demandes','types','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Type $type)
    {
        $data = $request->all();


        $demande = new demande;
        $type = Type::find($data['type_id']);

        $demande->date = $data['date'];

        $demande->deadline = date('Y-m-d', strtotime($data['date'] . ' + ' . $type->duration . ' days'));

        $demande->delay = $data['delay'];
        $demande->type_id = $data['type_id'];
        $demande->user_id = $data['user_id'];
        $demande->save();



        return redirect()->route('consultation.index');
    }

    public function accept(Request $request, Consultation $consultation, $id)
    {

        if (Auth::user()->can('demande-accept'))
        {
            $demande = Demande::find($id);

            $consultation = new Consultation();
            $consultation->date = $demande->date;
            $consultation->deadline = $demande->deadline;
            $consultation->delay = $demande->delay;
            $consultation->type_id = $demande->type_id;
            $consultation->user_id = $demande->user_id;
            $consultation->save();

            // Supprimer la demande une fois qu'elle est acceptée
            $demande->delete();

            // Rediriger l'utilisateur vers une autre page, par exemple, la liste des demandes
            return redirect()->route('demande.index');
        }
        abort(401);

    }

    /**
     * Display the specified resource.
     */
    public function show(demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(demande $demande)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, demande $demande, Type $type)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(demande $demande)
    {
        if (Auth::user()->can('demande-reject'))
        {
            $demande->delete();
            return redirect()->route('demande.index');
        }
        abort(401);

    }
}
