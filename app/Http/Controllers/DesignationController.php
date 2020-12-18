<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\User;
use Auth;

class DesignationController extends Controller
{
    public function _construct(){

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $designations = Designation::simplePaginate(8);
        return view('designations.index')->with([
            'designations'=> $designations,
            'user' => $user    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Designation $designation)
    {
        $designation = Designation::find($designation);
        return view('designations.create')->with([
            'designation'=> $designation,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Designation $designation)
    {
        $this->validate($request,[
            'design_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'designation_digital_file'=> 'required','image','mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = $request->file('designation_digital_file')->store('designation', 'public'); 
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(650,800);
        $image->save();
       
        $designation->design_name = $request->design_name;
        $designation->date_from = $request->date_from;
        $designation->date_to = $request->date_to;
        $designation->designation_digital_file = $imagePath;
        $designation->emp_id = auth()->user()->emp_id;


        if(auth()->user()->designations()->save($designation)){
            return redirect('/designation')->with('success', $designation->design_name.' created successfully');
        }else{
            return redirect('/designation/create')->with('error', 'Error in uploading certificate');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return view('designations.show')->with([
            'designation'=> $designation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return view('designations.edit')->with([
            'designation'=> $designation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $this->validate($request,[
            'design_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'designation_digital_file'=> 'required','image','mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = $request->file('designation_digital_file')->store('designation', 'public'); 
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(650,800);
        $image->save();
       
        $designation->design_name = $request->design_name;
        $designation->date_from = $request->date_from;
        $designation->date_to = $request->date_to;
        $designation->designation_digital_file = $imagePath;
        $designation->emp_id = auth()->user()->emp_id;


        if($designation->save()){
            return redirect('/designation')->with('success', $designation->design_name.' created successfully');
        }else{
            return redirect('/designation/create')->with('error', 'Error in uploading certificate');
        }
    }
    public function search(Request $request){
        
        $search = $request->get('search');

        $designations = Designation::query()
        ->where('id', 'like', "%{$search}%")
        ->orWhere('emp_id', 'like', "%{$search}%")
        ->orWhere('design_name', 'like', "%{$search}%")
        ->orWhere('date_from', 'like', "%{$search}%")
        ->orWhere('date_to', 'like', "%{$search}%")
        ->get();

        return view('designations.index', [
            'designations' => $designations,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if($designation->delete()){
            return redirect()->route('designations.designation.index')->with('success', $designation->design_name. ' has been deleted');
        }else{
            return redirect()->route('designations.designation.index')->with('error', $designation->design_name.' cannot be delete');

        }
    }
}
