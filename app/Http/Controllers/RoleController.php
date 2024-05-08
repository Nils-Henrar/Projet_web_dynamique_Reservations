<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::all(); // ou Db::select('select * from roles'); Db::table('roles')->get();
        return view('role.index', [
            'roles' => $roles,
            'resource' => 'roles'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 

        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        //validation des données du formulaire
        $validated = $request->validated();

        $role = new Role();

        $role->role = $validated['role'];
        $role->save();

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $role = Role::find($id);

        return view('role.show', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $role = Role::find($id);

        return view('role.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        // validation des données du formulaire

        // $validated = $request->validate([
        //     'role' => 'required|max:30',
        // ]);

        $validated = $request->validated();

        $role = Role::find($id);

        $role->update($validated);

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
