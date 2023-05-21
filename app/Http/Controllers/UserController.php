<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Gate;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users=User::paginate(10);
        return view('dashboard',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return  view('user.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'                        => 'required|max:255',
                'email'                       => 'required|email|max:255|unique:users',
                'contact_number'               => 'required|max:255',
                'home_address'                => 'max:255',
                'password'                    => 'required|min:8|confirmed'
            ],
            [
                'name.required'                => 'Name is required',
                'email.max:255'                => 'The name must not be greater than 255 characters.',
                'email.required'               => 'Email is required',
                'email.unique:users'           => 'The email has already been taken.',
                'email.max:255'                => 'The email must not be greater than 255 characters.',
                'contact_number.required'      => 'Phone no is required',
                'contact_number.max:255'       => 'This phone no must not be greater than 255 characters.',
                'home_address.max:255'         => 'This address must not be greater than 255 characters.',
                'password.required'            => 'Password is required',
                'password.min:8'               => 'The password must be at least 8 characters.',
                'password.confirmed'           => 'The password confirmation does not match.',
                
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'                               => $request->input('name'),
            'email'                              => $request->input('email'),
            'contact_number'                     => $request->input('contact_number'),
            'home_address'                       => $request->input('home_address'),
            'password'                           => Hash::make($request->input('password'))
        ]);
        
        $user->save();
        $users=User::all();
        return redirect('dashboard')->with('success','User is added !!!')->with('users',$users);
    }

    /**
     * Display the specified resource.
     */
    public function searchUser(string $email)
    {
        if($email===null || $email==="null"){
            $users = User::all();
        }else{
            $users = User::where('email', 'LIKE', '%' . $email . '%')->get();
        }
        $response = $users;
        return response()->json($response); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::Find($id);
        return  view('user.editUser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userCurrent    = User::Find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'name'                        => 'required|max:255',
                'contact_number'              => 'required|max:255',
                'home_address'                => 'max:255',
            ],
            [
                'name.required'                => 'Name is required',
                'contact_number.required'      => 'Phone no is required',
                'contact_number.max:255'       => 'This phone no must not be greater than 255 characters.',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $userCurrent->name                             = $request->input('name');
        $userCurrent->contact_number                   = $request->input('contact_number');
        $userCurrent->home_address                     = $request->input('home_address');
        $userCurrent->save();
        $users=User::all();
        return redirect('dashboard')->with('success','User '.$userCurrent->name.' details is updated !!!')->with('users',$users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $user = User::find($id);
        $user->delete();
        $response = array(
            'status' => 'success',
            'msg' => "User deleted Successfully",
        );
        return response()->json($response); 
    }
}
