<!DOCTYPE html>
@extends('backend.main')
@include('news_page.script')
@section('content')


<div class="container-fluid px-4">
    <h1 class="mt-4">All Users </h1>
    <div class="card mb-4">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>S\N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S\N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php
                        $sn = 1;
                    @endphp

                    @foreach($users as $user)
                        <tr>
                            <td>{{ $sn }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if(auth()->user()->isAdmin())
                                    <form class="d-flex" method="POST" action="{{ route('manage.users.updateRole', $user) }}">
                                        @csrf
                                        @method('POST')
                                        <select name="role" id="role" class="form-select me-2">
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        </select>
            
                                        <button class="btn btn-primary btn-sm" type="submit">Update Role</button>
                                    </form>
                                @endif
                            </td>
                        </tr
                        @php
                            $sn++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection