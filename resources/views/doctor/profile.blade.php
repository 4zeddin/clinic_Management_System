<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @include('doctor.css')
</head>

<body>
    <div class="bg-black container-scroller">

        <!-- partial:partials/_sidebar.html -->
        @include('doctor.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('doctor.navbar')
            <!-- partial -->
            <div style="background-color: #191c24" class="container-fluid page-body-wrapper">
                <div class="container col-8" aling="center">
                    <form action="{{ route('doctor.profile.edit') }}" method="POST" enctype="multipart/form-data"
                        class="mt-3">
                        <h1 class="text-center text-muted my-4">Doctor Profile</h1>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputtext1" class="text-white">Doctor Name</label>
                            <input type="text" name="name" value="{{ $doctor->name }}"
                                class="form-control text-white" id="exampleInputtext1" placeholder="Enter Doctor Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtext2" class="text-white">Phone</label>
                            <input type="text" name="phone" value="{{ $doctor->phone }}"
                                class="form-control text-white" id="exampleInputtext2" placeholder="Enter Phone Number"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="inputGroupFileAddon01" class="text-white">Speciality</label>
                            <input type="text" name="speciality" value="{{ $doctor->speciality }}"
                                class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-white">Email address</label>
                            <input type="email" name="email" value="{{ $doctor->email }}"
                                class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Enter Email" required>
                        </div>
                        <img loading="lazy" src="doctorImage/{{ $doctor->image }}" alt="Doctor Image"
                            class="img-fluid rounded mb-3">
                        <div class="form-group mb-3">
                            <label for="inputGroupFileAddon01" class="text-white">Update image</label>
                            <input type="file" name="image" class="form-control text-white" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" placeholder="Choose Doctor Image">
                        </div>
                        <button onclick="return confirm('Are you sure')" type="submit"
                            class="btn btn-outline-primary mb-3" style="font-size: 1rem"><i class="bi bi-save"></i>
                            Update</button>
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
    @include('doctor.script')
</body>

</html>
