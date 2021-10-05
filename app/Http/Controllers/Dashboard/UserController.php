<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-read')->only('index');
        $this->middleware('permission:users-create')->only('create');
        $this->middleware('permission:users-update')->only('edit');
        $this->middleware('permission:users-delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // .........................................
        // search 1
        // .........................................
        // if($request->search){
        //     $users = User::where('first_name','like','%'.$request->search.'%')
        //     ->orWhere('last_name','like','%'.$request->search.'%')->get();
        // }else{
        //     $users = User::WhereRoleIs('admin')->get();
        // }
        // .........................................
        // search 2
        // .........................................

        // $users = User::whereRoleIs('admin')->where(function($q) use ($request){
        //     return $q->when($request->search,function($query) use ($request){

        //        return $query ->where('first_name','like','%'.$request->search.'%')
        //        ->orWhere('last_name','like','%'.$request->search.'%');
        //     });
        // })->get();

        // .........................................
        // search 3
        // .........................................
        $users = User::whereRoleIs('admin')->when($request->search,function($query) use ($request){
            return $query ->where('first_name','like','%'.$request->search.'%')
            ->orWhere('last_name','like','%'.$request->search.'%');
        })->latest()->paginate(2);

        // $users = DB::select('select * from users where active = ?', [1])
        // $users = User::WhereRoleIs('admin')->get();
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request_data = $request->except(['password','password_confirmation','permissions']);
        $request_data['password']=bcrypt($request->password);

        $user =User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success',__('site.added_successfully') );
        return redirect()->route('dashboard.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            
        ]);

        $request_data = $request->except(['permissions']);
        
        $user->update($request_data);

        $user->syncPermissions($request->permissions);
        session()->flash('success',__('site.updated_successfully') );
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success',__('site.deleted_successfully') );
        return redirect()->route('dashboard.users.index');
    }
}