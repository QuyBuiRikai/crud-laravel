@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td scope="row"> {{$user->id}} </td>
                                <td>{{ $user->name }}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    @can('edit-users')
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary float-left">Edit</a>
                                    @endcan
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="float-left" >
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    
                                       <button type="submit" class="btn btn-warning" > Delete </button>
                                       
                                    </form>
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
