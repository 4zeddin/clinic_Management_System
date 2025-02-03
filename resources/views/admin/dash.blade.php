
@extends('layouts.admin')

@section('content')
    {{-- Stats Cards --}}
    <div class="stats my-5">
        <div class="stat-card">
            <h3>Appointments</h3>
            <div class="stat-value">
                $1200 <span><i class="bi bi-check2-all"></i></span>
            </div>
        </div>
        <div class="stat-card">
            <h3>In Progress</h3>
            <div class="stat-value">
                4.500K
                <span><i class="bi bi-clock-history"></i></span>
            </div>
        </div>
        <div class="stat-card">
            <h3>Confirmed</h3>
            <div class="stat-value">
                6.100k <i class="bi bi-check-square"></i>
            </div>
        </div>
    </div>

    {{-- Latest Users --}}
    <div class="latest-users">
        <div class="latest-users-header">
            <span class="title">Latest Users</span>
            <a href="{{ route('users.index') }}">
                <x-button-arrow>More</x-button-arrow>
            </a>
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

    {{-- Latest Appointments --}}
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <span class="title">Latest Appointments</span>
            <a href="{{ route('appointments.index') }}">
                <x-button-arrow>More</x-button-arrow>
            </a>
        </div>
        <hr>
        @if ($appointments->isEmpty())
            <div class="text-center">
                <h3 class="font-bold">No appointments!</h3>
            </div>
        @else
            <div class="table-responsive">
                <table class="latest-users-table table border rounded">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->doctor }}</td>
                                <td>
                                    @switch($appointment->status)
                                        @case('In progress')
                                            <span class="badge rounded-pill text-bg-warning">Pending</span>
                                        @break

                                        @case('approved')
                                            <span class="badge rounded-pill text-bg-success">Approved</span>
                                        @break

                                        @case('canceled')
                                            <span class="badge rounded-pill text-bg-danger">Rejected</span>
                                        @break

                                        @default
                                            <span class="badge rounded-pill text-bg-dark">Unknown Status</span>
                                    @endswitch
                                </td>
                                <td style="cursor:pointer" data-bs-toggle="modal"
                                    data-bs-target="#{{ $appointment->id }}Modal">
                                    <span>
                                        {{ Str::limit($appointment->message, 7, '...') }}
                                    </span>
                                    <i class="bi bi-plus-square-dotted"></i>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="{{ $appointment->id }}Modal" tabindex="-1"
                                aria-labelledby="truncatedModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="truncatedModalLabel">Full Message</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $appointment->message }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
