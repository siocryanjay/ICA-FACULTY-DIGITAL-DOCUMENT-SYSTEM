<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Auth;
use DB;
class UsersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct(){

        $this->middleware('auth');
    }
    
    public function index()
    {
        $users=User::simplePaginate(8);
        return view('admin.users.index', compact('users'))->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::all();
        return view('admin.users.create')->with([
            'user'=> $user,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->validate($request,[
            'emp_id' => ['required', 'digits:10'],
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'emp_id' => $request['emp_id'],
            'name' => $request['name'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $role = Role::select('id')->where('name', 'user')->first();

        $user->roles()->attach($role);
        
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show(User $user)
    {
        return view('admin.users.show')->with([
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user'=> $user,
            'roles' => $roles
        ]);
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

        $user->roles()->sync($request->roles);
        
        $this->validate($request,[
            'emp_id' => ['required', 'digits:10'],
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user->emp_id = $request->emp_id;
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ]);
        
        if($user->save()){
            $request->session()->flash('success', 'User has been updated');
        }else{
            $request->session()->flash('error', 'Error updating the user');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();
        
        if ($currentUser != $user) {
            $user->roles()->detach();
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'Successfully deleted the user!');
        }
        return back()->with('error', 'You cannot delete yourself!');
    }

    public function search(Request $request){
        
        $search = $request->get('search');

        $users = User::query()
        ->where('emp_id', 'like', "%{$search}%")
        ->orWhere('name', 'like', "%{$search}%")
        ->orWhere('lname', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")
        ->get();
        $roles = Role::query()
        ->where('name', 'like', "%{$search}%")
       ->get();

        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}

