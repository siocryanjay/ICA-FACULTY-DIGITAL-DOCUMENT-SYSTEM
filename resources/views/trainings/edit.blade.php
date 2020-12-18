@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <form  method="POST" action="{{ route('trainings.training.update', $training) }}" enctype="multipart/form-data">
                 
                 <div class="card-header"><strong>Edit Training File </strong> 
                    <a href="{{ route('trainings.training.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Trainings File">
                    <i class="fa fa-reply" aria-hidden="true"></i> Back to Trainings File 
                    </a>
                </div>
                @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                <div class="card-body">
                    @csrf
                    {{ method_field('PUT') }}
                    
                        <div class="form-group row">
                            <label for="training_name" class="col-md-3 control-label float-right">Training Name</label>

                            <div class="col-md-8 input-group">
                                <input id="training_name" type="text" class="form-control @error('training_name') is-invalid @enderror" name="training_name" value="{{ old('training_name') }}"  aria-describedby="basic-addon2" autocomplete="training_name" required autofocus >
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fab fa-leanpub pr-2"></i> </span>
                                    </div>
                                @error('training_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_from" class="col-md-3 control-label float-right">Date From</label>
                            <div class="col-md-8">
                                    <input type="date" name="date_from">    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_to" class="col-md-3 control-label float-right">Date To</label>
                            <div class="col-md-8">
                                    <input type="date" name="date_to">    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="training_digital_file" class="col-md-3 control-label float-right">Training Digital File</label>

                            <div class="col-md-8 input-group">
                                <input id="training_digital_file" type="file" class="form-control-file" name="training_digital_file" required>
                                @error('training_digital_file')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                        
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-user-plus pr-2" aria-hidden="true"></i>Edit Trainings
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
