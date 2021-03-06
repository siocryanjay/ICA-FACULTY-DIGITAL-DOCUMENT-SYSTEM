@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
<div class="container">
     @include('partials.notification') 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <form action="{{ route('admin.users.update', $user) }}" method="POST">
                <div class="card-header"><strong>Editing User: </strong> {{ $user-> name }}
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Users">
                    <i class="fa fa-reply" aria-hidden="true"></i> Back to Users   
                    </a>
                </div>

                <div class="card-body">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="Employee_ID" class="col-md-3 contol-label float-right">Employee ID</label>

                            <div class="col-md-8 input-group">
                                <input id="emp_id" type="text" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $user->emp_id }}" aria-describedby="basic-addon2" required autocomplete="emp_id">
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-id-card"></i></span>
                                    </div>
                                @error('emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 control-label float-right">First Name</label>

                            <div class="col-md-8 input-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  aria-describedby="basic-addon2" required autofocus >
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                                    </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-md-3 control-label float-right">Last Name</label>

                            <div class="col-md-8 input-group">
                                <input id="lname" type="text" class="form-control @error('name') is-invalid @enderror" name="lname" value="{{ $user->lname }}"  aria-describedby="basic-addon2" required autofocus >
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                                    </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 control-label float-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8 input-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  aria-describedby="basic-addon2" required autocomplete="email" autofocus>
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope " aria-hidden="true"></i></span>
                                    </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-3 control-label float-right">{{ __('Password') }}</label>

                            <div class="col-md-8 input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  aria-describedby="basic-addon2" required autocomplete="current-password">
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 control-label float-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8 input-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" aria-describedby="basic-addon2" required autocomplete="new-password">
                                <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roles" class="col-md-3 control-label float-right">Roles</label>
                            <div class="col-md-8">
                                @foreach($roles as $role)
                                    <div class=" form-check">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                        <label>{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @include('admin.users.modal-save')
                    <div class="card-footer">
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#confirmSave">
                            <i class="fa fa-floppy-o pr-2" aria-hidden="true"></i>Save Changes
                        </button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
