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
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="page-body-wrapper">
                <div class="container">
                    @if (session()->has('msg'))
                        <script>
                            swal({
                                title: 'Done !',
                                text: "{{ session()->get('msg') }}",
                                icon: "success",
                                button: "Ok",
                                timer: "3000"
                            })
                        </script>
                    @endif
                    @if ($doctors->isEmpty())
                        <div class="text-center my-5">
                            <h1 class="font-bold">Doctors empty!</h1>
                        </div>
                    @else
                        <div class="table-responsive m-4 ms-2 mx-auto" style="width: 1000px; overflow-x: auto;">
                            <table class="table table-dark table-striped border text-white">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Cost</th>
                                        <th>Speciality</th>
                                        <th>Image</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>300dh/h</td>
                                            <td>{{ $row->speciality }}</td>
                                            <td><img loading="lazy" src="{{ asset('doctorImage/' . $row->image) }}"
                                                    alt="{{ $row->name }}" class="img-fluid rounded-circle"></td>
                                            <td>
                                                <a type="button" href='{{ route('doctor.edit', $row->id) }}'
                                                    onclick="return confirm('Are you sure')" class="btn btn-primary">
                                                    <i class="bi< bi-pencil-square"></i> Edit
                                                </a>
                                            </td>
                                            <td>
                                                <a type="button" href='{{ route('doctor.delete', $row->id) }}'
                                                    onclick=confirmDelete(event) class="btn btn-danger">
                                                    <i class="bi bi-x-square"></i> Delete
                                                </a>
                                            </td>
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
