@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                <a href="{{ route('trainings.training.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Trainings File">
                        <i class="fa fa-reply" aria-hidden="true"></i> Back to Trainings File 
                    </a>
                    <h5 class="text-center">{{ $training->training_name }}</h5>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                                <p>Training ID:</p>
                                <p>Employee ID:</p>
                                <p>Training Name:</p>
                                <p>Date From</p>
                                <p>Date To</p>
                        </div>
                        <div class="col-md-4">
                                <p>{{ $training->id }}</p>
                                <p>{{ $training->emp_id }}</p>
                                <p>{{ $training->training_name }}</p>
                                <p>{{ $training->date_from }}</p>
                                <p>{{ $training->date_to }}</p>
                        </div>
                        
                        <img src="/storage/{{ $training->training_digital_file }}" alt="Image" style="width:200px; height:200px;">
                    </div>
                    
                </div>
               <div class="card-footer">
                    <div class="d-inline-flex">
                        @include('trainings.modal-del')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger mx-5 px-5 py-2 float-right" data-toggle="modal" data-target="#confirmDelete">
                        <i class="fas fa-trash pr-1"></i> Delete this Training File
                        </button>
                        <a href="{{ route('trainings.training.edit', $training) }}" class="float-left mx-5"><button type="button" class="btn btn-sm btn-info ml-2 py-2 px-5"><i class="fas fa-pencil-alt pr-1"></i> Edit this Training File</button></a>
                               
                    </div>
                </div>
                                 
            </div>
            
        </div>
    </div>
@endsection
