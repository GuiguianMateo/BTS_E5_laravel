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
        $praticiens = Praticien::all();
        return view('praticien.index', compact('praticiens'));

        // $response = Http::get('http://127.0.0.1:8000/api/praticien');

        // if ($response->successful()) {
        //     $praticiens = $response->json();

        //     return view('praticien.index', ['praticiens' => $praticiens]);
        // } else {
        //     return back()->withError('Erreur lors de la récupération des données de l\'API');
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $praticiens = Praticien::all();
        $types = type::all();
        return view('praticien.create', compact('praticiens','types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth::user()->can('praticien-create'))
        // {
            $data = $request->all();

            $praticien = new Praticien;

            $praticien->name = $data['name'];
            $praticien->job = $data['job'];
            $praticien->type_id = $data['type_id'];
            $praticien->save();

            return redirect()->route('praticien.index');

        // }
        // abort(401);
    }

    /**
     * Display the specified resource.
     */
    public function show(praticien $praticien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(praticien $praticien)
    {
        $types = type::all();
        return view('praticien.edit', compact('praticien','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, praticien $praticien)
    {
        // if (Auth::user()->can('praticien-edit'))
        // {
            $praticien = Praticien::find($praticien->id);
            $data = $request->all();

            $praticien->name = $data['name'];
            $praticien->job = $data['job'];
            $praticien->type_id = $data['type_id'];

            $praticien->save();

            return redirect()->route('praticien.index');
        // }
        // abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(praticien $praticien)
    {
        if (Auth::user()->can('praticien-delete'))
        {
            $praticien->delete();
            return redirect()->route('praticien.index');
        }
        abort(401);
    }
}
