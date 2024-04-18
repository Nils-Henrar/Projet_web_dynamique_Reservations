<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $types = Type::all(); // ou Db::select('select * from types'); Db::table('types')->get();
        return view('type.index', [
            'types' => $types,
            'resource' => 'types'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $type = new Type();
        $type->type = $request->type;
        $type->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $type = Type::find($id);

        return view('type.show', [
            'type' => $type,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $type = Type::find($id);

        return view('type.edit', [
            'type' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données du formulaire

        $validated = $request->validate([
            'type' => 'required|string|max:60',
        ]);

        $type = Type::find($id);

        $type->update($validated);

        return redirect()->route('type.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $type = Type::find($id);
        $type->delete();

        return redirect()->route('type.index');
    }
}
