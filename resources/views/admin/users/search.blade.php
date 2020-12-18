@extends('layouts.app')
<style>
    .container {
        font-family: 'Nunito';
        font: 5px;
    }
</style>

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-2 mt-2"><strong>Showing All Users</strong></div>
                        <div class="col-sm-7">
                            <form action="{{ route('search') }} " method="GET" role="search">
                                {{ csrf_field() }}
                                <div class="input-group col-sm-6 float-right">
                                    <input type="search" name="search" class="form-control" placeholder="Search Users">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button> 
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-dark btn-md float-right">
                                <i class="fa fa-user-plus pr-1" aria-hidden="true"></i> 
                                <span class="hidden-xs hidden-sm">Create New User</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><small><strong>Employee ID</strong></small></th>
                                <th scope="col"><small><strong>First Name</strong></small></th>
                                <th scope="col"><small><strong>Last Name</strong></small></th>
                                <th scope="col"><small><strong>Email</strong></small></th>
                                <th scope="col"><small><strong>Roles</strong></small></th>
                                <th scope="col"><small><strong>Actions</strong></small></th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><small>{{ $user->emp_id }}</small></td>
                                <td><small>{{ $user->name }}</small></td>
                                <td><small>{{ $user->lname }}</small></td>
                                <td><small>{{ $user->email }}</small></td>
                                <td><small>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</small></td>
                                
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('admin.users.show', $user->id) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show User</button></a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit User</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
