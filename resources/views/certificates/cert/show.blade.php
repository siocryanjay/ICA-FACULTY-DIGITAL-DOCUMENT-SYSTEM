@extends('layouts.app')


@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <a href="{{ route('certificates.certificate.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Users">
                        <i class="fa fa-reply" aria-hidden="true"></i> Back to Certificates 
                    </a>
                    <h5 class="text-center">{{ $certificate->cert_name }}</h5>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                                <p>Certificate ID:</p>
                                <p>Employee ID:</p>
                                <p>Certificate Name:</p>
                                <p>Certificate Type:</p>
                                <p>Date:</p>
                        </div>
                        <div class="col-md-4">
                                <p>{{ $certificate->id }}</p>
                                <p>{{ $certificate->emp_id }}</p>
                                <p>{{ $certificate->cert_name }}</p>
                                <p>{{ $certificate->cert_type }}</p>
                                <p>{{ $certificate->created_at }}</p>
                        </div>

                        <img src="/storage/{{ $certificate->image }}" alt="Image" style="width: 200px; height: 200px;">

                        <div id="preview_Modal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="cert_img_preview">
                        </div>
                    </div>
                    
                </div>

               <div class="card-footer">
                    <div class="d-inline-flex">
                        @include('certificates.cert.modal-del')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger mx-5 px-5 py-2 float-right" data-toggle="modal" data-target="#confirmDelete">
                        <i class="fas fa-trash pr-1"></i> Delete this Certificate
                        </button>
                        <a href="{{ route('certificates.certificate.edit', $certificate) }}" class="float-left mx-5"><button type="button" class="btn btn-sm btn-info ml-2 py-2 px-5"><i class="fas fa-pencil-alt pr-1"></i> Edit this Certificate</button></a>
                    </div>
                </div>
                                 
            </div>
            
        </div>
    </div>

    
@endsection

