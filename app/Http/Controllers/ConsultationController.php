<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
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
        return view('consultation.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $consultations = consultation::all();
        return view('consultation.create', compact('consultations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $consultation = new Consultation;

        $consultation->date = $data['date'];
        $consultation->limitedate = $data['limitedate'];
        $consultation->delay = $data['delay'];
        $consultation->accept = $data['accept'];
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
        return view('consultation.edit', compact('consultation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {

        if (Auth::user()->can('consultation-edit'))
        {
            $consultation = Consultation::find($consultation->id);

            $data = $request->all();

            $consultation->date = $data['date'];
            $consultation->limitedate = $data['limitedate'];
            $consultation->delay = $data['delay'];
            $consultation->accept = $data['accept'];
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
