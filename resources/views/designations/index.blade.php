@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-2 mt-2"><strong>Showing Designations</strong></div>
                        <div class="col-sm-7">
                            @can('manage-users')<form action="{{ route('search-designation') }}" method="GET" role="search">
                                {{ csrf_field() }}
                                <div class="input-group col-sm-6 float-right">
                                    <input type="search" name="search" class="form-control" placeholder="Search Designation File">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button> 
                                    </div>
                                </div>
                            </form>
                            @endcan
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('designations.designation.create') }}" class="btn btn-outline-dark btn-md float-right">
                                <i class="fas fa-award pr-2"></i>
                                <span class="hidden-xs hidden-sm">Upload Designation File</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><small><strong>ID</strong></small></th>
                                @can('manage-users')<th scope="col"><small><strong>Employee ID</strong></small></th>@endcan
                                <th scope="col"><small><strong>Designation Name</strong></small></th>
                                <th scope="col"><small><strong>Date From</strong></small></th>
                                <th scope="col"><small><strong>Date To</strong></small></th>
                                <th scope="col"><small><strong>Action</strong></small></th>
                            </tr>
                        </thead>
                        @can('manage-users')
                        <tbody>
                            @foreach($designations as $designation)
                            <tr>
                                <td><small>{{ $designation->id }}</small></td>
                               <th scope="col"><small><strong>{{ $designation->emp_id }}</strong></small></th>
                                <td><small>{{ $designation->design_name }}</small></td>
                                <td><small>{{ $designation->date_from }}</small></td>          
                                <td><small>{{ $designation->date_to }}</small></td>
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('designations.designation.show', $designation) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Designation File</button></a>
                                    <a href="{{ route('designations.designation.edit', $designation) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Designation File</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endcan
                        @can('user-table')
                        <tbody>
                        @if(count($designations) > 0)
                            @foreach($user->designations as $designation)
                            <tr>
                                <td><small>{{ $designation->id }}</small></td>
                                <td><small>{{ $designation->design_name }}</small></td>
                                <td><small>{{ $designation->date_from }}</small></td>          
                                <td><small>{{ $designation->date_to }}</small></td>
                                
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('designations.designation.show', $designation) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Designation File</button></a>
                                    <a href="{{ route('designations.designation.edit', $designation) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Designation File</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                            <tr>
                                <td>You have no designation's file uploaded</td>
                            </tr>
                        @endif
                        @endcan
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
