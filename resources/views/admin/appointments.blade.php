@extends('layouts.admin')

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <span class="title">Appointments List</span>
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
                            <th>Action</th>
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
                                <td>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#notifyModal{{ $appointment->id }}">
                                        <x-animated-btn color="#367588" icon="bi bi-bell-fill">notify</x-animated-btn>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal for message -->
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

                            <!-- Modal for notify form -->
                            <div class="modal fade" id="notifyModal{{ $appointment->id }}" tabindex="-1"
                                aria-labelledby="notifyModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="notifyModalLabel">Send Notification</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('email.send', $appointment->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <input type="text" id="greeting{{ $appointment->id }}"
                                                            name="greeting" placeholder=" " value="{{ old('greeting') }}"
                                                            required />
                                                        <label for="greeting{{ $appointment->id }}">Greeting *</label>
                                                    </div>
                                                    @error('greeting')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <textarea id="body{{ $appointment->id }}" name="body" rows="6" class="w-100 p-4" placeholder=" " required>{{ old('message') }}</textarea>
                                                        <label for="body{{ $appointment->id }}">Email Body *</label>
                                                    </div>
                                                    @error('body')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <x-button-arrow type="submit">Send</x-button-arrow>
                                                </div>
                                            </form>
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
