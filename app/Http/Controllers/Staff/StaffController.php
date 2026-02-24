<?php

namespace App\Http\Controllers\Staff;

use App\CalculatorBaseValue;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PositionBlock;
use App\Staff;
use App\StaffFinance;
use App\User;
use App\UserCheckIn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Role;
use App\Profile;
use App\Permission;
use Mail;
use DB;
class StaffController extends Controller
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
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $staff = User::whereHas(
                    'roles', function($q){
                    $q->where('name','!=', 'customer');
                    $q->where('name','!=', 'user');
                    $q->where('name','!=', 'admin');
                }
                )->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')->paginate($perPage);
            } else {
                $staff = User::whereHas('roles', function($q){$q->where('name','!=','admin')->where('name','!=','user')->where('name','!=','customer');})->orderBy('id', 'desc')->get();
            }
            return view('staff.staff.index', compact('staff'));
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
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $roles = Role::whereNotIn('name',['admin','customer','outsideowner'])->with('permissions')->orderBy('id','DESC')->get();
            $isCreate = true;
            $positionBlocks = PositionBlock::get();
            return view('staff.staff.create',compact('roles', 'isCreate', 'positionBlocks'));
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
        $model = str_slug('staff','-');
            if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            try {
                $this->validate($request, [
                'first_name' => 'required',
                'email' => 'required'
            ]);
            extract($request->all());
                DB::beginTransaction();
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $name = $first_name . ' ' . $last_name;
            $password = str_random(8);
            $requestData = [
                'name' => $name,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'status' => $status,
                'password'=>bcrypt($password),
                'created_by' => auth()->id(),
            ];
            $user = User::create($requestData);
            Profile::create([
                'user_id'=>$user->id,
                'address'=>$address,
                'phone' => '+1' . str_replace(['(', ')', '-', ' '], '', $phone),
                'colour_id' => $colour_id,
            ]);
            StaffFinance::create([
                'staff_id' => $user->id,
                'staff_position' => $request->position,
                'staff_compensation' => $request->compensation,
                'position_record' => json_encode($request->positions),
                'compensation_record' => json_encode($request->compensations),
            ]);
            //end foreach.
            if ($role_id !='custom_role'){
                $role = Role::find($role_id);
                $user->assignRole($role->name);
            }else{
                $role = Role::firstOrCreate(['name' => $request->new_role_name]);
                if($request->permissions != '' || $request->permissions != null){
                    $role->permissions()->sync($request->permissions);
                    $user->assignRole($role->name);
                }//end if.
            }//end if else.
                DB::commit();
            try {
                $this->sendWelcomeEmailWithLoginDetails($user, $password);
            }catch (\Exception $e) {}//ends try catch.
            return redirect('staff/staff')->with('flash_message', ucwords($role->name).' added!');
            }catch (\Exception $e) {
                DB::rollBack();
                return redirect('staff/staff')->with('flash_message', 'Unable to add staff, please try again!');
            }//end try catch.

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
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $staff = User::findOrFail($id);
            $staffFinance = StaffFinance::where('staff_id', $id)->first();
            $roles = Role::whereNotIn('name',['admin','user','customer','outsideowner'])->with('permissions')->get();
            return view('staff.staff.show', compact('staff', 'staffFinance', 'roles'));
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
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $staff = User::with('roles.permissions')->findOrFail($id);
            $positionBlocks = PositionBlock::get();
            $roles = Role::whereNotIn('name',['admin','customer','outsideowner'])->with('permissions')->get();
            $isCreate = false;
            return view('staff.staff.edit', compact('staff','roles', 'isCreate', 'positionBlocks'));
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
        extract($request->all());
        $model = str_slug('staff','-');
            if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
                $this->validate($request, [
                'first_name' => 'required',
                'email' => 'required'
            ]);
            extract($request->all());
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $name = $first_name . ' ' . $last_name;
            $requestData = ['name'=>$name, 'first_name'=>$first_name, 'last_name'=>$last_name,'email'=>$email, 'status'=>$status];
            User::where('id', $id)->update($requestData);
            $user = User::find($id);
            StaffFinance::updateOrCreate(['staff_id' => $id],
                [
                    'staff_position' => $request->position,
                    'staff_compensation' => $request->compensation,
                    'position_record' => json_encode($request->positions),
                    'compensation_record' => json_encode($request->compensations),
                ]
            );
            Profile::where('user_id', $id)->update(['address'=>$address, 'phone'=>'+' . str_replace(['(', ')', '-', ' '], '', $phone), 'colour_id' => $colour_id]);
            if($request->has('role_id')){
                    if ($role_id !='custom_role')
                {
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
                }
            }
           return redirect('staff/staff')->with('flash_message', 'Staff updated!');
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
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            $user = User::find($id);
            $user->update([
                'deleted_at' => now(),
                'email' => $user->email . now()
            ]);
            return redirect('staff/staff')->with('flash_message', 'Staff deleted!');
        }
        return response(view('403'), 403);

    }
    public function getRoleDetails($role){
        if ($role=='custom_role'){
            $role = Role::findOrfail(Auth::id());
            $role_permissions = $role->permissions()->pluck('id')->toArray();
            $permissions = Permission::whereIn('id',$role_permissions)->get();
            return (string) view('staff.staff.all_permissions',compact('permissions'));
        }else{
            $role = Role::with('permissions')->findOrFail($role);
            return (string) view('staff.staff.role_permissions',compact('role'));
        }//end if else.
    }//end getRoleDetails function.
    public function staffTimeClock($id){
        $model = str_slug('staff','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $staff = User::findOrFail($id);
            $checkIns = $staff->userCheckIn()->orderBy('date', 'desc')->get();
            $groupedData = $checkIns->groupBy('date');
//            $staff = json_decode($staff->staffPosition, true);
//            return $staff['compensation_record'];
            return (string) view('staff.staff.staff_time_clock', compact('staff', 'groupedData'));
        }
        return response(view('403'), 403);
    }
    public function editCheckInModal(Request $request){
        $userCheckIn = UserCheckIn::find($request->id);
        return view('staff.staff.edit_checkin_modal', compact('userCheckIn'));
    }

    public function updateCheckin(Request $request){
        extract($request->all());
        $userCheckIn = UserCheckIn::find($clock_id);
        $userCheckIn->update([
           'date' => $date,
           'check_in'   => Carbon::parse($date . ' ' . $check_in)->format('Y-m-d H:i:s'),
           'check_out'  => Carbon::parse($date . ' ' . $check_out)->format('Y-m-d H:i:s'),
           'total_hours' => $total_hours,
        ]);
        return back()->with('flash_message', 'Staff check-in updated successfully!');
    }
    public function staffSalaryBlock()
    {
        $salaryBlockData = CalculatorBaseValue::first();
        $salaryBlock = $salaryBlockData ? json_decode($salaryBlockData->salary_block, true) : [];
        return view('staff.staff.staff_salary_block', compact('salaryBlock'));
    }
    public function staffBenefitsBlock()
    {
        $positions = PositionBlock::get();
        return view('staff.staff.staff_benefits_block', compact('positions'));
    }
    public function staffPositionsBlock()
    {
        return view('staff.staff.staff_positions_block');
    }

    public function staffPasswordReset(Request $request){
        extract($request->all());
        $user = User::find($user_id);
        $password = 'Leadup@123';
        $user->update(['password' => bcrypt($password)]);
        $emailContent = 'Hello ' . $user->name . ', Your password has been reset to Leadup@123';
            Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email)
            ->subject('Password Reset');
            });
        return response()->json(['success']);
    }

}//end class.
