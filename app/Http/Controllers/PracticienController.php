<?php

namespace App\Http\Controllers;

use App\Models\practicien;
use Illuminate\Http\Request;

class PracticienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $practiciens = Practicien::all();
        return view('practicien.index', compact('practiciens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $practiciens = Practicien::all();
        return view('practicien.create', compact('practiciens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $practicien = new Practicien;

        $practicien->name = $data['name'];
        $practicien->job = $data['job'];
        $practicien->save();

        return redirect()->route('practicien.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(practicien $practicien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(practicien $practicien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, practicien $practicien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(practicien $practicien)
    {
        //
    }
}
