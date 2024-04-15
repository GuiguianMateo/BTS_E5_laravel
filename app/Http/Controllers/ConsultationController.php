<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Demande;
use App\Models\praticien;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = consultation::all();
        $demandes = Demande::all();
        $users = user::all();

        return view('consultation.index', compact('consultations','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultations = consultation::all();
        $types = type::all();
        $users = user::all();

        // Récupérer le type sélectionné dans la requête (s'il existe)
        $selectedTypeId = request()->input('type_id');

        // Si un type est sélectionné, récupérer uniquement les praticiens en relation avec ce type
        if ($selectedTypeId) {
            $praticiens = Praticien::where('type_id', $selectedTypeId)->get();
        } else {
            $praticiens = Praticien::all();
        }

        return view('consultation.create', compact('consultations', 'types', 'users', 'praticiens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Type $type)
    {
        $data = $request->all();

        $consultation = new Consultation;
        $type = Type::find($data['type_id']);

        $consultation->date = $data['date'];

        $consultation->deadline = date('Y-m-d', strtotime($data['date'] . ' + ' . $type->duration . ' days'));

        $consultation->delay = $data['delay'];
        $consultation->type_id = $data['type_id'];
        $consultation->user_id = $data['user_id'];
        $consultation->praticien_id = $data['praticien_id'];
        $consultation->save();

        return redirect()->route('consultation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $types = type::all();
        $users = user::all();
        return view('consultation.edit', compact('consultation','types','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation, Type $type)
    {

        if (Auth::user()->can('consultation-edit'))
        {
            $consultation = Consultation::find($consultation->id);
            $data = $request->all();
            $type = Type::find($data['type_id']);

            $consultation->date = $data['date'];

            $consultation->deadline = date('Y-m-d', strtotime($data['date'] . ' + ' . $type->duration . ' days'));

            $consultation->delay = $data['delay'];
            $consultation->type_id = $data['type_id'];
            $consultation->user_id = $data['user_id'];
            $consultation->save();

            return redirect()->route('consultation.index');
        }
        abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        if (Auth::user()->can('consultation-delete'))
        {
            $consultation->delete();
            return redirect()->route('consultation.index');
        }
        abort(401);

    }
}
