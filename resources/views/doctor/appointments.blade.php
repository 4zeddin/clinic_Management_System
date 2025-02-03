@extends('layouts.doctor')

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <h4>Appointments</h4>
        </div>
        <hr>
        @if ($appointments->isEmpty())
            <div class="text-center">
                <h3 class="font-bold">No appointments !</h3>
            </div>
        @else
            <div class="table-responsive mt-4">
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Message</th>
                            <th colspan="3">Actions</th>
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
                                <td>{{ $appointment->message }}</td>
                                <td>
                                    <a
                                        type="button"onclick="confirmAction(event, '{{ route('doctor.approved', $appointment->id) }}')">
                                        <x-animated-btn color="#00b38f">approve</x-animated-btn>
                                    </a>
                                </td>
                                <td>
                                    <a
                                        type="button"onclick="confirmAction(event, '{{ route('doctor.canceled', $appointment->id) }}')">
                                        <x-animated-btn>cancel</x-animated-btn>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmAction(event, url) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Something went wrong!',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
