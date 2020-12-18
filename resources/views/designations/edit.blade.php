@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <form  method="POST" action="{{ route('designations.designation.update', $designation) }}" enctype="multipart/form-data">
                 
                 <div class="card-header"><strong>Edit Designation File </strong> 
                    <a href="{{ route('designations.designation.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Designations">
                    <i class="fa fa-reply" aria-hidden="true"></i> Back to Designations
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
                            <label for="design_name" class="col-md-3 control-label float-right">Designation Name</label>

                            <div class="col-md-8 input-group">
                                <input id="design_name" type="text" class="form-control @error('design_name') is-invalid @enderror" name="design_name" value="{{ old('design_name') }}"  aria-describedby="basic-addon2" autocomplete="design_name" required autofocus >
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-certificate"></i></span>
                                    </div>
                                @error('design_name')
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
                            <label for="designation_digital_file" class="col-md-3 control-label float-right">Designation Digital File</label>

                            <div class="col-md-8 input-group">
                                <input id="designation_digital_file" type="file" class="form-control-file" name="designation_digital_file" value="{{ old('designation_digital_file') }}"required>
                                @error('designation_digital_file')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                        
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-user-plus pr-2" aria-hidden="true"></i>Edit Designation
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
