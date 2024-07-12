<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\tipousuario;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HasRoles;


    public function index()
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('User.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        $tipos=tipousuario::all();
        return view('User.create',compact('roles','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //dd($request['name']);
        $user=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'tipo_id' => $request['tipo_id'],
        ])->assignRole($request->rol);
       
        
        // return "ok";
        Session::flash('success', 'Usuario Guardado Correctamente');
        
        return back();
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
    public function edit($id)
    {
       
        $user=User::where('id',$id)->first();
        $roles=Role::all();
        $tipos=tipousuario::all();
        $rol = $user->getRoleNames();
        foreach ($rol as $rol) {
            $roleModel = Role::where('name', $rol)->first();
            $roleId = $roleModel->id;
            $roleDescription = $roleModel->description;
        }

       
        return view('User.edit',compact('user','roles','tipos','rol','roleId','roleDescription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $act=User::where('id',$request->id)->update(['email'=>$request->email,'name'=>$request->name]);
        $user = User::find($request->id)->syncRoles($request->rol);
        Session::flash('success', 'Usuario Actualizado Correctamente');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
