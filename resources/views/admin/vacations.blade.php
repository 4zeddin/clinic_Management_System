@extends('layouts.admin')

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <span class="title">Vacation Requests</span>
        </div>
        <hr>
        @if ($requests->isEmpty())
            <div class="text-center my-5">
                <h1 class="font-bold">No Vacation Requests!</h1>
            </div>
        @else
            <div class="table-responsive">
                <table class="table border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctor Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->doctor->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->start_date)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->end_date)->format('Y-m-d') }}</td>
                                <td>{{ $request->reason }}</td>
                                <td>
                                    @switch($request->status)
                                        @case('pending')
                                            <span class="badge rounded-pill text-bg-warning">Pending</span>
                                        @break

                                        @case('approved')
                                            <span class="badge rounded-pill text-bg-success">Approved</span>
                                        @break

                                        @case('rejected')
                                            <span class="badge rounded-pill text-bg-danger">Rejected</span>
                                        @break

                                        @default
                                            <span class="badge rounded-pill text-bg-dark">Unknown Status</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="#"
                                        onclick="confirmAction(event, '{{ route('req.approved', $request->id) }}')">
                                        <x-animated-btn color="#00b38f">Approve</x-animated-btn>
                                    </a>
                                </td>
                                <td>
                                    <a href="#"
                                        onclick="confirmAction(event, '{{ route('req.canceled', $request->id) }}')">
                                        <x-animated-btn>Reject</x-animated-btn>
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
