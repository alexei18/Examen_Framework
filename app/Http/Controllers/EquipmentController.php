<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $equipments = Equipment::all();
    return view('equipments.index', compact('equipments'));
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('equipments.create');
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
    ]);
    $request->validate([
    'name' => 'required|max:255',
    'price' => 'required|numeric',
    ]);

    
    Equipment::create($validated);
    return redirect()->route('equipments.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    $equipment = Equipment::findOrFail($id);
    $equipment->delete();
    return redirect()->route('equipments.index');
}
}
