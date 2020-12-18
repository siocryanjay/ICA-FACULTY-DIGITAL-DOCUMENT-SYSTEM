@extends('layouts.app')



@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <form  method="POST" action="{{ route('certificates.certificate.store', $certificate) }}" enctype="multipart/form-data">
                 @csrf
                 <div class="card-header"><strong>Upload New Certificate </strong> 
                    <a href="{{ route('certificates.certificate.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Certificates">
                    <i class="fa fa-reply" aria-hidden="true"></i> Back to Certificates  
                    </a>
                </div>
                <div class="card-body">
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label for="cert_name" class="col-md-3 control-label float-right">Certificate Name</label>

                            <div class="col-md-8 input-group">
                                <input id="cert_name" type="text" class="form-control @error('cert_name') is-invalid @enderror" name="cert_name" value="{{ old('cert_name') }}"  aria-describedby="basic-addon2" autocomplete="cert_name" required autofocus >
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-certificate"></i></span>
                                    </div>
                                @error('cert_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cert_type" class="col-md-3 control-label float-right">Certificate Type</label>
                            <div class="col-md-8">
                                    <div class=" form-check">
                                        <input type="radio" name="cert_type" value="Participant">
                                        <label>Participant</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="cert_type" value="Speaker">
                                        <label>Speaker</label>
                                    </div>    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-3 control-label float-right">Certificate Image</label>

                            <div class="col-md-8 input-group">
                                <input id="image" type="file" class="form-control-file" name="image" value="{{ old('image') }}"required>
                                @error('image')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                        
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success float-right">
                        <i class="fas fa-certificate"></i>Upload Certificate
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
