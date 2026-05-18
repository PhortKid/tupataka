<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Dashboard | Users Management";
        $users=User::all();
        $roles=Role::all();
        return view('dashboard.users_management.index',compact('roles','users','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //brian.kaseleko@mazingira.com
       /*
        $data = $request->validate([
            'firstname'    => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname'     => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string', 'regex:/^0[67][0-9]{8}$/', 'unique:users,phone_number'],
            'email'        => ['required', 'email', 'max:100', 'unique:users,email'],
            'role_id'         => ['required', 'string'],
        ]); */
    
        function generateStrongPassword($length = 8) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
            return substr(str_shuffle(str_repeat($chars, ceil($length/strlen($chars)))), 0, $length);
        }
        
        $password ='yusto@gmail.com';// generateStrongPassword(8);

         
   
    
        $user = new User;
        $user->firstname = trim($request->input('firstname'));
        $user->lastname = trim($request->input('lastname'));
        $user->phone_number = trim($request->input('phone_number'));
        $user->email = trim($request->input('email'));
        $user->role_id = trim($request->input('role_id'));
        //$user->pharmacy_id = Auth::user()->pharmacy_id;
        $user->password = Hash::make($user->email);
        $user->save();
/*
        $myemail=$user->email;
        Mail::raw("Habari $user->firstname,\n\nYour new password is: $password\n\nPlease change the password after logging in.", function ($message) use ($myemail) {
            $message->to($myemail)
                    ->subject('Password yako mpya');
        });
        */
    
        return redirect()->route('users_management.index')->with('success', 'User added successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'firstname'    => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname'     => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string'],
            'email'        => ['required', 'email'],
            'role_id'         => ['required', 'string'],
        ]);
        
    
        $user = User::findOrFail($id);
       $user->update([
            'firstname'    => trim($data['firstname']),
            'lastname'     => trim($data['lastname']),
            'phone'        => trim($data['phone_number']),
            'email'        => trim($data['email']),
            'role_id'         => trim($data['role_id']),
        ]);

         $user->firstname  = trim($request->firstname);
            $user->lastname   = trim($request->lastname);
            $user->phone_number      = trim($request->phone_number);
            $user->email      = trim($request->email);
            $user->role_id    = trim($request->role_id);

            $user->save();


    
        return redirect()->route('users_management.index')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

    return redirect()->route('users_management.index')->with('success', 'User deleted successfully.');

    }
}
