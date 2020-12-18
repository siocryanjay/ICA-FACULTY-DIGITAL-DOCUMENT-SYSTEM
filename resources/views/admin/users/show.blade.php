@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ $user-> name }}'s Information
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back To Users">
                        <i class="fa fa-reply" aria-hidden="true"></i> Back to Users   
                    </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><small><strong>Employee ID</strong></small></th>
                                <th scope="col"><small><strong>Name</strong></small></th>
                                <th scope="col"><small><strong>Email</strong></small></th>
                                <th scope="col"><small><strong>Roles</strong></small></th>
                                <th scope="col"><small><strong>Created At</strong></small></th>
                                <th scope="col"><small><strong>Updated At</strong></small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><small>{{ $user->emp_id }}</small></td>
                                <td><small>{{ $user->name }}</small></td>
                                <td><small>{{ $user->email }}</small></td>
                                <td><small>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</small></td>
                                <td><small>{{ $user->created_at }}</small></td>
                                <td><small>{{ $user->updated_at }}</small></td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-sm btn-info mx-5 text-white px-5 py-2"><i class="fas fa-pencil-alt pr-1"></i>Edit this User</button></a>
                    @include('admin.users.modal-delete')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-danger mx-5 px-5 py-2 float-right" data-toggle="modal" data-target="#confirmDelete">
                    <i class="fas fa-trash pr-1"></i> Delete this User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
