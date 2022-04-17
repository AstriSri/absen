<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;
use App\User;
use App\Role;

class UserRoleController extends Controller
{
    public function index()
    {

        $data["userrole"] = UserRole::orderBy('kode_role', 'asc')->get();
        $data["role"] = Role::orderBy('role', 'asc')->get();
        $data["user"] = User::orderBy('username', 'asc')->get();
        return view('admin.userrole.userrole-index', $data);
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
                'username' => "required",
                'kode_role' => "required",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $userrole = UserRole::create([
            "username" => $request->username,
            "kode_role" => $request->kode_role,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $userrole->username, "data userrole", "Menambah data userrole dengan id => [$userrole->id - $userrole->username]");

        return redirect()->route("userrole.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["userrole"] = UserRole::where("id", "=", $id)->first();
        $data["role"] = Role::orderBy('role', 'asc')->get();
        $data["user"] = User::orderBy('username', 'asc')->get();
        
        return view('admin.userrole.userrole-edit', $data);
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
                'username' => "required|unique:user_role,username,$id",
                'kode_role' => "required|unique:user_role,username,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $userrole = UserRole::findOrFail($id);
        $userrole->username = $request->username;
        $userrole->kode_role = $request->kode_role;
        $name = auth()->user()->name;
        $this->activity($name, "update", $userrole->username, "data userrole", "Memperbarui data userrole dengan id => [$id - $userrole->username]");
        
        $userrole->save();

        return redirect()->route('userrole.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userrole = UserRole::findOrFail($id);
        $userrole->delete();
        $this->activity(auth()->user()->name, "delete", $userrole->username, "data userrole", "Menghapus [$userrole->username] dari data userrole");

        return redirect()->route("userrole.index")->with('success', 'Data berhasil dihapus . . .');
    }
}
