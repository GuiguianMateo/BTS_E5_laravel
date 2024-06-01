<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Demande;
use App\Models\praticien;
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
        if (Auth::user()->can('demande-acces'))
        {
            $demandes = demande::all();
            return view('demande.index', compact('demandes'));
        }
        abort(401);

    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Type $type)
    {
            $data = $request->all();

            $demande = new demande;
            $type = Type::findOrFail($data['type_id']);
            $demande->date = $data['date'];

            $demande->deadline = date('Y-m-d H:i:s', strtotime($data['date'] . ' + ' . $type->duration . ' days'));

            $demande->delay = $data['delay'];
            $demande->type_id = $data['type_id'];
            $demande->user_id = $data['user_id'];
            $demande->praticien_id = $data['praticien_id'];
            $demande->save();

            return redirect()->route('consultation.index');
    }

    public function accept(Request $request, Consultation $consultation, $id)
    {

        if (Auth::user()->can('demande-accept'))
        {
            $demande = Demande::findOrFail($id);

            $consultation = new Consultation();
            $consultation->date = $demande->date;
            $consultation->deadline = $demande->deadline;
            $consultation->delay = $demande->delay;
            $consultation->type_id = $demande->type_id;
            $consultation->user_id = $demande->user_id;
            $consultation->praticien_id = $demande->praticien_id;
            $consultation->save();

            $demande->delete();

            return redirect()->route('demande.index');
        }
        abort(401);

    }

    /**
     * Display the specified resource.
     */
    // public function show(demande $demande)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(demande $demande)
    // {

    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, demande $demande, Type $type)
    // {

    // }

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
