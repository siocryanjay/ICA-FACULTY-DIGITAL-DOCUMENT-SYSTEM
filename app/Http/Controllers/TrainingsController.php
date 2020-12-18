<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\User;
use Auth;


class TrainingsController extends Controller
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
        $trainings = Training::simplePaginate(8);
        return view('trainings.index')->with([
            'trainings'=> $trainings,
            'user' => $user    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Training $training)
    {
        $training = Training::find($training);
        return view('trainings.create')->with([
            'training'=> $training,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Training $training)
    {
        $this->validate($request,[
            'training_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'training_digital_file'=> 'required','image','mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = $request->file('training_digital_file')->store('trainings', 'public'); 
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(650,800);
        $image->save();
       
        $training->training_name = $request->training_name;
        $training->date_from = $request->date_from;
        $training->date_to = $request->date_to;
        $training->training_digital_file = $imagePath;
        $training->emp_id = auth()->user()->emp_id;


        if(auth()->user()->trainings()->save($training)){
            return redirect('/training')->with('success', $training->training_name.' created successfully');
        }else{
            return redirect('/training/create')->with('error', 'Error in uploading certificate');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        return view('trainings.show')->with([
            'training'=> $training,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        return view('trainings.edit')->with([
            'training'=> $training,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        $this->validate($request,[
            'training_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'training_digital_file'=> 'required','image','mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = $request->file('training_digital_file')->store('trainings', 'public'); 
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(650,800);
        $image->save();       
       
        $training->training_name = $request->training_name;
        $training->date_from = $request->date_from;
        $training->date_to = $request->date_to;
        $training->training_digital_file = $imagePath;
        $training->emp_id = auth()->user()->emp_id;


        if($training->save()){
            return redirect('/training')->with('success', $training->training_name.' created successfully');
        }else{
            return redirect('/training/create')->with('error', 'Error in uploading certificate');
        }
    }

    public function search(Request $request){
        
        $search = $request->get('search');

        $trainings = Training::query()
        ->where('id', 'like', "%{$search}%")
        ->orWhere('emp_id', 'like', "%{$search}%")
        ->orWhere('training_name', 'like', "%{$search}%")
        ->orWhere('date_from', 'like', "%{$search}%")
        ->orWhere('date_to', 'like', "%{$search}%")
        ->get();

        return view('trainings.index', [
            'trainings' => $trainings,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        if($training->delete()){
            return redirect()->route('trainings.training.index')->with('success', $training->training_name. ' has been deleted');
        }else{
            return redirect()->route('trainings.training.index')->with('error', $training->training_name.' cannot be delete');

        }
    }
}
