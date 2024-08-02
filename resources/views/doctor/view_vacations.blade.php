<!DOCTYPE html>
<html lang="en">

<head>
    @include('doctor.css')
</head>

<body>
    <div class="bg-black container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('doctor.sidebar')
        <!-- partial -->
        <div class="container-fluid ms-2 page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('doctor.navbar')
            <!-- partial -->
            <div class="page-body-wrapper">
                <div class="container">
                     
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($requests->isEmpty())
                        <div class="text-center my-5">
                            <h1 class="font-bold">empty !!</h1>
                        </div>
                    @else
                        <div class="table-responsive mt-4 mx-auto" style="width: 1000px; overflow-x: auto;">
                            <h1 class="text-center text-muted mb-4">Vacation History</h1>
                            <table class="table table-dark table-striped border text-white">
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
                                                <td>{{ $request->start_date}}</td>
                                                <td>{{ $request->end_date}}</td>
                                                <td>{{ $request->reason }}</td>
                                                <td>
                                                    @switch($request->status)
                                                        @case('pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                            @break
                                                        @case('approved')
                                                            <span class="badge badge-success">Approved</span>
                                                            @break
                                                        @case('rejected')
                                                            <span class="badge badge-danger">Rejected</span>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>{{ $request->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('doctor.vacation.form') }}" class="btn btn-primary mt-3">
                                Make a New Request
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 1 .5.5v4h4a.5.5 0 0 1 0 1h-4v4a.5.5 0 0 1-1 0v-4H3.5a.5.5 0 0 1 0-1h4v-4a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('doctor.script')
</body>

</html>
