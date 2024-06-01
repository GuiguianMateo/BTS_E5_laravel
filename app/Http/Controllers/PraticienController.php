<?php

namespace App\Http\Controllers;

use App\Models\Praticien;
use App\Models\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class PraticienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('praticien-acces'))
        {
            $praticiens = Praticien::all();
            return view('praticien.index', compact('praticiens'));
        }
        abort(401);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('praticien-create'))
        {
            $praticiens = Praticien::all();
            $types = type::all();
            return view('praticien.create', compact('praticiens','types'));
        }
        abort(401);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'job' => 'required|string',
            'type_id' => 'required|exists:types,id',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'job.required' => 'Le travail est obligatoire.',
            'job.string' => 'Le travail doit être une chaîne de caractères.',
            'type_id.required' => 'Le type est obligatoire.',
        ]);

        if (Auth::user()->can('praticien-create'))
        {
            $data = $request->all();

            $praticien = new Praticien;

            $praticien->name = $data['name'];
            $praticien->job = $data['job'];
            $praticien->type_id = $data['type_id'];
            $praticien->save();

            return redirect()->route('praticien.index');

        }
        abort(401);
    }

    /**
     * Display the specified resource.
     */
    // public function show(praticien $praticien)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(praticien $praticien)
    {
        if (Auth::user()->can('praticien-edit'))
        {
            $types = type::all();
            return view('praticien.edit', compact('praticien','types'));
        }
        abort(401);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, praticien $praticien)
    {
        $request->validate([
            'name' => 'required|string',
            'job' => 'required|string',
            'type_id' => 'required|exists:types,id',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'job.required' => 'Le travail est obligatoire.',
            'job.string' => 'Le travail doit être une chaîne de caractères.',
            'type_id.required' => 'Le type est obligatoire.',
        ]);

        if (Auth::user()->can('praticien-edit'))
        {
            $praticien = Praticien::findOrFail($praticien->id);
            $data = $request->all();

            $praticien->name = $data['name'];
            $praticien->job = $data['job'];
            $praticien->type_id = $data['type_id'];

            $praticien->save();

            return redirect()->route('praticien.index');
        }
        abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(praticien $praticien)
    {
        if (Auth::user()->can('praticien-delete'))
        {
            try {
                $praticien->delete();

                return redirect()->route('praticien.index')->with('success', 'Praticien supprimé avec succès.');
            } catch (\Illuminate\Database\QueryException $e) {
                // Vérifie si l'erreur est une violation de clé étrangère
                if ($e->getCode() === '23000') {
                    // Renvoie un message
                    return redirect()->route('praticien.index')->with('error', 'Attention, vous ne pouvez pas supprimer ce praticien car il est déjà affilié à une consultation ou à une demande.');
                }

                // Renvoie un message
                return redirect()->route('praticien.index')->with('error', 'Une erreur est survenue lors de la suppression du praticien.');
            }
        }
        abort(401);
    }
}
