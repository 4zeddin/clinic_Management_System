@extends('layouts.admin')

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <span class="title">Users List</span>
        </div>
        <hr>
        @if ($users->isEmpty())
            <div class="text-center">
                <h3 class="font-bold">No Users!</h3>
            </div>
        @else
            <table class="latest-users-table table border rounded">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Number</th>
                        <th scope="col">Block By IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-animated-btn type="submit" onclick="confirmDelete(event)">Block
                                        User</x-animated-btn>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
