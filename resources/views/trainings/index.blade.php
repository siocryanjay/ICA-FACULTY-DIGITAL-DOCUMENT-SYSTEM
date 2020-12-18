@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-2 mt-2"><strong>Showing Trainings File</strong></div>
                        <div class="col-sm-7">
                            @can('manage-users')<form action="{{ route('search-training') }}" method="GET" role="search">
                                {{ csrf_field() }}
                                <div class="input-group col-sm-6 float-right">
                                    <input type="search" name="search" class="form-control" placeholder="Search Training File">
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
                            <a href="{{ route('trainings.training.create') }}" class="btn btn-outline-dark btn-md float-right">
                                <i class="fab fa-leanpub pr-2"></i> 
                                <span class="hidden-xs hidden-sm">Upload Training File</span>
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
                                <th scope="col"><small><strong>Training Name</strong></small></th>
                                <th scope="col"><small><strong>Date From</strong></small></th>
                                <th scope="col"><small><strong>Date To</strong></small></th>
                                <th scope="col"><small><strong>Action</strong></small></th>
                            </tr>
                        </thead>
                        @can('manage-users')
                        <tbody>
                            @foreach($trainings as $training)
                            <tr>
                                <td><small>{{ $training->id }}</small></td>
                               <th scope="col"><small><strong>{{ $training->emp_id }}</strong></small></th>
                                <td><small>{{ $training->training_name }}</small></td>
                                <td><small>{{ $training->date_from }}</small></td>          
                                <td><small>{{ $training->date_to }}</small></td>
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('trainings.training.show', $training) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Training File</button></a>
                                    <a href="{{ route('trainings.training.edit', $training) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Training File</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endcan
                        @can('user-table')
                        <tbody>
                        @if(count($trainings) > 0)
                            @foreach($user->trainings as $training)
                            <tr>
                                <td><small>{{ $training->id }}</small></td>
                                <td><small>{{ $training->training_name }}</small></td>
                                <td><small>{{ $training->date_from }}</small></td>          
                                <td><small>{{ $training->date_to }}</small></td>
                                
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('trainings.training.show', $training) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Training File</button></a>
                                    <a href="{{ route('trainings.training.edit', $training) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Training File</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                            <tr>
                                <td>You have no training's file uploaded</td>
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
