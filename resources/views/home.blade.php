@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Details: </strong>{{ Auth::user()->name }} {{ Auth::user()->lname }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Employee ID:</p>
                            <p>First Name:</p>
                            <p>Last Name:</p>
                            <p>Email Address:</p>
                        </div>
                        <div class="col-md-8">
                            <p>{{ Auth::user()->emp_id }}</p>
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->lname }}</p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
