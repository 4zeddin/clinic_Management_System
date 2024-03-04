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
            <div style="background-color: #191c24" class="container-fluid page-body-wrapper">
                <div class="container col-8" aling="center">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('doctor.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                        class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputtext1" class="text-white">Doctor Name</label>
                            <input type="text" name="name" value="{{ $data->name }}"
                                class="form-control text-white" id="exampleInputtext1" placeholder="Enter Doctor Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtext2" class="text-white">Phone</label>
                            <input type="text" name="phone" value="{{ $data->phone }}"
                                class="form-control text-white" id="exampleInputtext2" placeholder="Enter Phone Number"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="inputGroupFileAddon01" class="text-white">Speciality</label>
                            <input type="text" name="speciality" value="{{ $data->speciality }}"
                                class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-white">Email address</label>
                            <input type="email" name="email" value="{{ $data->email }}"
                                class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Email" required>
                        </div>
                        <img loading="lazy" src="doctorImage/{{ $data->image }}" alt="Doctor Image"
                            class="img-fluid rounded mb-3">
                        <div class="form-group mb-3">
                            <label for="inputGroupFileAddon01" class="text-white">Update image</label>
                            <input type="file" name="image" class="form-control text-white" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" placeholder="Choose Doctor Image">
                        </div>
                        <button type="submit" class="btn btn-outline-primary mb-3" style="font-size: 1rem"><i
                                class="bi bi-save"></i> Update Doctor</button>
                    </form>

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
