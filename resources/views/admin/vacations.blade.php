<!DOCTYPE html>
<html lang="en">

<head>
<base href="/public">
    @include('admin.css')
</head>

<body>
    <div class="bg-black container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid ms-2 page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="page-body-wrapper">
                <div class="">
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
                            <h1 class="font-bold">No Vacation Requests!</h1>
                        </div>
                    @else
                        <div class="table-responsive mt-4 mx-auto marker: ms-3" style="width: 1000px; overflow-x: auto;">
                            <table class="table table-dark table-striped border text-white">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Doctor Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th colspan="1">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->doctor->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->start_date)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->end_date)->format('Y-m-d') }}</td>
                                            <td>{{ $row->reason }}</td>
                                           <td class="font-weight-bold @if($row->status == 'approved') text-success @elseif ($row->status == 'rejected') text-danger @else text-warning @endif">{{ $row->status }}</td>
                                            <td>
                                                <a href="{{ route('req.approved', $row->id) }}"
                                                    onclick="return confirm('Are you sure?')"
                                                    class="btn btn-success me-3">
                                                    Approved
                                                </a>
                                                <a href="{{ route('req.canceled', $row->id) }}"
                                                    onclick="return confirm('Are you sure?')"
                                                    class="btn btn-danger">
                                                    Rejected
                                                </a>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    @include('admin.script')
</body>

</html>
