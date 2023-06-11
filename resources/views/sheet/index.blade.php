@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Dashboard') }}
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('sheet.insert','insert')}}" class="btn btn-outline-success btn-sm">Insert Fake Data</a>
                        <a href="{{route('sheet.delete_from_sheet','delete')}}" class="btn btn-outline-danger btn-sm">Delete All Data</a>
                        <a href="{{route('sheet.sync','sync')}}" class="btn btn-outline-info btn-sm">Sync</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Contact Details</th>
                                <th scope="col">Company Details</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sheets as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->first_name}} {{$user->last_name}}</td>
                                <td>
                                    Phone : {{$user->phone}}<br>
                                    Email: {{$user->email}}
                                </td>
                                <td>
                                    Name : {{$user->company_name}}<br>
                                    Is Owner : {{$user->owner}}<br>
                                    Employees : {{$user->employees}}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-outline-info">Update</button>
                                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                    </div>
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