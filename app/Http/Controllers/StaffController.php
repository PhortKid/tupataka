<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Designation;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=Staff::where('status','1')->get();
        $designations=Designation::where('status','1')->get();
        return view('dashboard.staff.index',compact('employees','designations'));
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
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'designation_id' => 'required|exists:designation,id',
            'nida' => 'nullable|string|max:50',
            'nssf_refference' => 'nullable|string|max:50',
            'tin_refference' => 'nullable|string|max:50',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email_address' => 'required|email|max:255',
            'residential_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_mobile' => 'nullable|string|max:20',
            'contact_person_address' => 'nullable|string|max:255',
        ]);

        

        $staff = Staff::create([
        'firstname'             => $request->firstname,
        'middlename'            => $request->middlename,
        'lastname'              => $request->lastname,
        'gender'                => $request->gender,
        'dob'                   => $request->dob,
        'designation_id'        => $request->designation_id,
        'nida'                  => $request->nida,
        'nssf_refference'        => $request->nssf_refference,
        'tin_refference'         => $request->tin_refference,
        'phone1'                => $request->phone1,
        'phone2'                => $request->phone2,
        'email_address'         => $request->email_address,
        'residential_address'   => $request->residential_address,
        'permanent_address'     => $request->permanent_address,
        'contact_person_name'   => $request->contact_person_name,
        'contact_person_mobile' => $request->contact_person_mobile,
        'contact_person_address'=> $request->contact_person_address,
    ]);

    

        return redirect()->back()->with('success', 'Staff created successfully.');
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
    public function update(Request $request, string $id)
    {
        /*
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'designation_id' => 'required|exists:designation,id',
            'nida' => 'nullable|string|max:50',
            'nssf_refference' => 'nullable|string|max:50',
            'tin_refference' => 'nullable|string|max:50',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'email_address' => 'required|email|max:255',
            'residential_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_mobile' => 'nullable|string|max:20',
            'contact_person_address' => 'nullable|string|max:255',
        ]);
 */
        $staff = Staff::findOrFail($id);

        $staff->update([
            'firstname'             => $request->firstname,
            'middlename'            => $request->middlename,
            'lastname'              => $request->lastname,
            'gender'                => $request->gender,
            'dob'                   => $request->dob,
            'designation_id'        => $request->designation_id,
            'nida'                  => $request->nida,
            'nssf_refference'        => $request->nssf_refference,
            'tin_refference'         => $request->tin_refference,
            'phone1'                => $request->phone1,
            'phone2'                => $request->phone2,
            'email_address'         => $request->email_address,
            'residential_address'   => $request->residential_address,
            'permanent_address'     => $request->permanent_address,
            'contact_person_name'   => $request->contact_person_name,
            'contact_person_mobile' => $request->contact_person_mobile,
            'contact_person_address'=> $request->contact_person_address,
        ]);

        return redirect()->back()->with('success', 'Staff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->update(['status' => '0']); 
        return redirect()->back()->with('success', 'Staff removed successfully.');
    }
}
