<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use Auth;


class CertificateController extends Controller
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
        $certificates = Certificate::simplePaginate(8);
        return view('certificates.cert.index')->with([
            'certificates'=> $certificates,
            'user' => $user    
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Certificate $certificate)
    {
        $certificate = Certificate::find($certificate);
        return view('certificates.cert.create')->with([
            'certificate'=> $certificate,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Certificate $certificate)
    {
        $request->validate([
            'cert_name' => 'required',
            'cert_type' => 'required',
            'image'=> 'required','image',
        ]);
        $imagePath = $request->file('image')->store('uploads', 'public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(200,200);
        $image->save();
       
        $certificate->cert_name = $request->cert_name;
        $certificate->cert_type = $request->cert_type;
        $certificate->image = $imagePath;
        $certificate->emp_id = auth()->user()->emp_id;


        if(auth()->user()->certificates()->save($certificate)){
            return redirect('/certificate')->with('success', $certificate->cert_name.' created successfully');
        }else{
            return redirect()->route('certificates.certificate.create')->with('error', 'Error in uploading certificate');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        return view('certificates.cert.show')->with([
            'certificate'=> $certificate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        return view('certificates.cert.edit')->with([
            'certificate'=> $certificate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'cert_name' => 'required',
            'cert_type' => 'required',
            'image'=> 'required','image',
        ]);
        $imagePath = $request->file('image')->store('uploads', 'public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(200,200);
        $image->save();

        $certificate->cert_name = $request->cert_name;
        $certificate->cert_type = $request->cert_type;
        $certificate->image = $imagePath;
        $certificate->emp_id = auth()->user()->emp_id;
        
        if($certificate->save()){
            return redirect()->route('certificates.certificate.index')->with('success', $certificate->cert_name. ' has been updated');
        }else{
            return redirect()->route('certificates.certificate.index')->with('error', 'Error updating the certificate');

        }

    }
    public function search(Request $request){
        
        $search = $request->get('search');

        $certificates = Certificate::query()
        ->where('id', 'like', "%{$search}%")
        ->orWhere('emp_id', 'like', "%{$search}%")
        ->orWhere('cert_name', 'like', "%{$search}%")
        ->orWhere('cert_type', 'like', "%{$search}%")
        ->get();

        return view('certificates.cert.index', [
            'certificates' => $certificates
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        if($certificate->delete()){
            return redirect()->route('certificates.certificate.index')->with('success', $certificate->cert_name. ' has been deleted');
        }else{
            return redirect()->route('certificates.certificate.index')->with('error', $certificate->cert_name.'cannot be delete');

        }
    }
}
