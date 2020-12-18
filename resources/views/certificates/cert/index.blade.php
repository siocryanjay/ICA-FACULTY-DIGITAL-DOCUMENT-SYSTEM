@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notification')
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-2 mt-2"><strong>Showing Certificates</strong></div>
                        <div class="col-sm-7">
                            @can('manage-users')<form action="{{ route('search-certificate') }}" method="GET" role="search">
                                {{ csrf_field() }}
                                <div class="input-group col-sm-6 float-right">
                                    <input type="search" name="search" class="form-control" placeholder="Search Certificate" value="{{ old('search') }}">
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
                            <a href="{{ route('certificates.certificate.create') }}" class="btn btn-outline-dark btn-md float-right">
                                <i class="fa fa-certificate pr-2" aria-hidden="true"></i> 
                                <span class="hidden-xs hidden-sm">Upload Certificate</span>
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
                                <th scope="col"><small><strong>Certificate Name</strong></small></th>
                                <th scope="col"><small><strong>Certificate Type</strong></small></th>
                                <th scope="col"><small><strong>Date</strong></small></th>
                                <th scope="col"><small><strong>Action</strong></small></th>
                            </tr>
                        </thead>
                        @can('manage-users')
                        <tbody>
                            @foreach($certificates as $certificate)
                            <tr>
                                <td><small>{{ $certificate->id }}</small></td>
                               <th scope="col"><small><strong>{{ $certificate->emp_id }}</strong></small></th>
                                <td><small>{{ $certificate->cert_name }}</small></td>
                                <td><small>{{ $certificate->cert_type }}</small></td>          
                                <td><small>{{ $certificate->created_at }}</small></td>
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('certificates.certificate.show', $certificate) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Certificate</button></a>
                                    <a href="{{ route('certificates.certificate.edit', $certificate) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Certificate</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endcan
                        @can('user-table')
                        <tbody>
                        @if(count($certificates) > 0)
                            @foreach($user->certificates as $certificate)
                            <tr>
                                <td><small>{{ $certificate->id }}</small></td>
                                <td><small>{{ $certificate->cert_name }}</small></td>
                                <td><small>{{ $certificate->cert_type }}</small></td>          
                                <td><small>{{ $certificate->created_at }}</small></td>
                                
                                <td class="d-inline-flex"> 
                                    <a href="{{ route('certificates.certificate.show', $certificate) }}"><button type="button" class="btn btn-sm btn-success ml-2"><i class="fa fa-eye pr-1" aria-hidden="true"></i>Show Certificate</button></a>
                                    <a href="{{ route('certificates.certificate.edit', $certificate) }}"><button type="button" class="btn btn-sm btn-info ml-2"><i class="fas fa-pencil-alt pr-1"></i> Edit Certificate</button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                            <tr>
                                <td>You have no certificates uploaded</td>
                            </tr>
                        @endif
                        @endcan
                    </table>
                    @if(count($errors) > 0)
                         
                         @if($certificate->search)
                             {{ $certificates->links() }}
                                                     
                         @endif
                         @foreach($errors->all() as $error)
                             <div class="alert alert-danger">{{ $error }}
                                 
                             </div>
                         @endforeach
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
