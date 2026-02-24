<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SalesMan;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Permission;
use App\Profile;
class SalesManController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */


    public function index(Request $request)
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $salesman = User::whereHas(
                    'roles', function($q){
                    $q->where('name', 'salesmen');
                }
                )->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')
                ->paginate($perPage);
            } else {
                $salesman = User::whereHas(
                    'roles', function($q){
                    $q->where('name', 'salesmen');
                }
                )->orderBy('id','DESC')->paginate($perPage);
            }
            return view('salesMan.sales-man.index', compact('salesman'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $roles = Role::whereNotIn('name',['admin','user','customer','outsideowner'])->with('permissions')->orderBy('id','DESC')->get();
            $isCreate = true;
            return view('salesMan.sales-man.create',compact('roles', 'isCreate'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        return $request->all();
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
            ]);
            extract($request->all());
            $user = User::create(['name'=>$name,'first_name'=>$name,'email'=>$email,'status'=>$status]);
            Profile::create(['user_id'=>$user->id,'address'=>$address, 'phone'=>$phone]);
            if ($role_id !='custom_role'){
                $role = Role::find($role_id);
                $user->assignRole($role->name);
            }else{
                $role = Role::firstOrCreate(['name' => $request->new_role_name]);
                if($request->permissions != '' || $request->permissions != null){
                    $role->permissions()->sync($request->permissions);
                    $user->assignRole($role->name);
                }
            }//end if else.
            return redirect('salesMan/sales-man')->with('flash_message', ucwords($role->name).' added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $salesman = User::findOrFail($id);
            return view('salesMan.sales-man.show', compact('salesman'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $salesman = User::findOrFail($id);
            $roles = Role::whereIn('name',['staff','salesmen'])->with('permissions')->get();
            $isCreate = false;
            return view('salesMan.sales-man.edit', compact('salesman','roles', 'isCreate'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            extract($request->all());
            $requestData = ['name'=>$name,'email'=>$email, 'status'=>$status];
            User::where('id', $id)->update($requestData);
            $user = User::find($id);
            Profile::where('user_id', $id)->update(['address'=>$address, 'phone'=>$phone]);
            if ($role_id !='custom_role'){
                $role = Role::find($role_id);
                if(!$user->hasRole($role->name)){
                    $user->roles()->first()->pivot->delete();
                    $user->assignRole($role->name);
                }
            }else{
                $role = Role::firstOrCreate(['name' => $request->new_role_name]);
                if(!$user->hasRole($request->new_role_name)){
                    $user->roles()->first()->pivot->delete();
                }
                if($request->permissions != '' || $request->permissions != null){
                    $role->permissions()->sync($request->permissions);
                    $user->assignRole($role->name);
                }
            }//end if else.

            return redirect('salesMan/sales-man')->with('flash_message', 'SalesMan updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('salesman','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            User::destroy($id);

            return redirect('salesMan/sales-man')->with('flash_message', 'SalesMan deleted!');
        }
        return response(view('403'), 403);

    }
    public function getRoleDetails($role){
        if ($role=='custom_role'){
            $permissions = Permission::whereNotIn('id',[1,2,3,4,5,9,14,15,16,17,18,19,20,22,23,24,25,26,27,28,29,30,31,32,33])->get();
            return (string) view('staff.staff.all_permissions',compact('permissions'));
        }else{
            $role = Role::with('permissions')->findOrFail($role);
            return (string) view('salesMan.sales-man.role_permissions',compact('role'));
        }//end if else.
    }//end getRoleDetails function.
}

