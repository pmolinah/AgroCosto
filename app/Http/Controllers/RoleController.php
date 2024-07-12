<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $resp=0;
    public $nombre;
    public function index()
    {
        $Roles=Role::all();
        return view('RolPermisos.index',compact(['Roles']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();//where('name','LIKE','%'.'adm.'.'%')->get();
        $permissionsProd=Permission::where('name','LIKE','%'.'prod.'.'%')->get();
        return view('RolPermisos.create',compact(['permissions','permissionsProd']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buscar=Role::where('name',$request->name)->get();
        //dd($buscar);
        foreach($buscar as $dato){
            $this->nombre = $dato->name;
        }
        // dd($request);
        if(empty($this->nombre))
        {
          
            $role = Role::create($request->all())->syncPermissions($request->permission);
         
            Session::flash('success', 'Rol Guardado Correctamente...');
            return back();
        }else{
            
            Session::flash('error', 'Rol ya Existe...');
            return back();
        }
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
    public function edit(Role $rol)
    {
        $permissions = Permission::where('name','LIKE','%'.'adm.'.'%')->get();
        $permissionsProd = Permission::where('name','LIKE','%'.'prod.'.'%')->get();
        return view('RolPermisos.edit',compact('rol','permissions','permissionsProd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));
        Session::flash('success', 'Rol Actualizado Correctamente...');
        return redirect()->route('roles.edit',$role->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        // return $id;
        $borrar=Role::where('id',$id)->delete();
        return ;
    }
}
