<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data["role"] = Role::orderBy('role', 'asc')->get();
        return view('admin.role.role-index', $data);
    }

    public function show($id)
    {
        abort(404);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'role' => "required|unique:roles",
                'kode_role' => "required|unique:roles",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $role = Role::create([
            "role" => $request->role,
            "kode_role" => $request->kode_role,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $role->role, "data role", "Menambah data role dengan id => [$role->id - $role->role]");

        return redirect()->route("role.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["role"] = Role::where("id", "=", $id)->first();

        return view('admin.role.role-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'role' => "required|unique:Role,role,$id",
                'kode_role' => "required|unique:Role,kode_role,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $role = Role::findOrFail($id);
        $role->role = $request->role;
        $role->kode_role = $request->kode_role;
        $name = auth()->user()->name;
        $this->activity($name, "update", $role->role, "data role", "Memperbarui data role dengan id => [$id - $role->role]");
        
        $role->save();

        return redirect()->route('role.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $this->activity(auth()->user()->name, "delete", $role->role, "data role", "Menghapus [$role->role] dari data role");

        return redirect()->route("role.index")->with('success', 'Data berhasil dihapus . . .');
    }
}
