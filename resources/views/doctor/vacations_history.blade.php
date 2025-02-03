@extends('layouts.doctor')

@section('content')

    <div class="latest-users my-5">
        <div class="latest-users-header d-flex align-items-center">
            <a class="fs-1 text-muted cursor-pointer arrow-icon" href="{{ route('doctor.vacation.form') }}">
                <i class="bi bi-arrow-left-square"></i>
            </a>
            <h4 class="text-center flex-grow-1 m-0">Vacation History</h4>
        </div>
        <hr>
        @if ($requests->isEmpty())
            <div class="text-center my-5">
                <h1 class="font-bold">empty !!</h1>
            </div>
        @else
            <table class="table border">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $request->start_date }}</td>
                            <td>{{ $request->end_date }}</td>
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
                            <td>{{ $request->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
