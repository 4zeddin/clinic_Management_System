@extends('layouts.user')

@section('content')
    <section class="appointment d-flex">
        <div class="appointment-container">
            @if ($appointments->isEmpty())
                <div class="m-5">
                    <h3 class="text-center d-flex justify-center">You have no appointments!</h3>
                </div>
            @else
                <h1 class="mb-5 text-center">My Appointments</h1>
                <x-animated-btn class="fs-6" color="#00d9a5" icon="bi bi-plus-square-dotted" onclick="window.location='{{ route('appointment.make') }}'">
                    New Appointment
                </x-animated-btn>
                <div class="table-responsive">
                <table class="table table-light table-striped mt-5 border">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->doctor }}</td>
                                    <td
                                        class="font-weight-bold
                                        @if ($row->status == 'approved') text-primary
                                        @elseif ($row->status == 'canceled') text-danger
                                        @else text-warning @endif">
                                        {{ $row->status }}
                                    </td>
                                    <td>{{ $row->message }}</td>
                                    <td>
                                        <form action="{{ route('appointments.home.destroy', $row->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-animated-btn icon="bi bi-x-circle" onclick="confirmDelete(event)">Cancel</x-animated-btn>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
