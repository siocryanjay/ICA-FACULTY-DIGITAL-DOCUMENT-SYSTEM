@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <a href="{{ route('designations.designation.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Designations">
                        <i class="fa fa-reply" aria-hidden="true"></i> Back to Designations 
                    </a>
                    <h5 class="text-center">{{ $designation->design_name }}</h5>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                                <p>Designation ID:</p>
                                <p>Employee ID:</p>
                                <p>Designation Name:</p>
                                <p>Date From</p>
                                <p>Date To</p>
                        </div>
                        <div class="col-md-4">
                                <p>{{ $designation->id }}</p>
                                <p>{{ $designation->emp_id }}</p>
                                <p>{{ $designation->design_name }}</p>
                                <p>{{ $designation->date_from }}</p>
                                <p>{{ $designation->date_to }}</p>
                        </div>
                        <img src="/storage/{{ $designation->designation_digital_file }}" alt="Image" style="width: 200px; height: 200px;">
                    </div>
                    
                </div>
               <div class="card-footer">
                    <div class="d-inline-flex">
                        @include('designations.modal-del')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger mx-5 px-5 py-2 float-right" data-toggle="modal" data-target="#confirmDelete">
                        <i class="fas fa-trash pr-1"></i> Delete Designation File
                        </button>
                        <a href="{{ route('designations.designation.edit', $designation) }}" class="float-left mx-5"><button type="button" class="btn btn-sm btn-info  py-2 px-5"><i class="fas fa-pencil-alt pr-1"></i> Edit Designation File</button></a>
                               
                    </div>
                </div>
                                 
            </div>
            
                        
        </div>
    </div>
@endsection
