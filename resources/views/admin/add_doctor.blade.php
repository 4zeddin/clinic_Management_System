<!DOCTYPE html>
<html lang="en">

<head>
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
                <div class="col-12" aling="center">
                    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputtext1" class="text-white">Doctor Name</label>
                            <input type="text" name="name" class="form-control text-white" id="exampleInputtext1"
                                placeholder="Enter Doctor Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtext2" class="text-white">Phone</label>
                            <input type="text" name="phone" class="form-control text-white" id="exampleInputtext2"
                                placeholder="Enter Phone Number" required>
                        </div>
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="text-white">Speciality</label>
                            <select name="speciality" class="custom-select text-white"
                                style="width:100%; background-color:#2a3038" id="inputGroupSelect01" required>
                                <option value="general">General</option>
                                <option value="skin">Skin</option>
                                <option value="eye">Eye</option>
                                <option value="heart">Heart</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-white">Email address</label>
                            <input type="email" name="email" class="form-control text-white" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="text-white">Password</label>
                            <input type="password" name="password" class="form-control text-white" id="pass"
                                aria-describedby="emailHelp" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputGroupFileAddon01" class="text-white">Doctor image</label>
                            <input type="file" name="image" class="form-control text-white" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" placeholder="Choose Doctor Image" required>
                        </div>
                        <button type="submit" class="btn btn-outline-success mt-3" style="font-size: 1rem"><i
                                class="bi bi-save"></i> Add Doctor</button>
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
    @if (session()->has('success'))
        <script>
            swal({
                title: "Doctor Added",
                text: "{{session()->get('success')}}",
                icon: "success",
                button: "OK",
                timer: 3000
            });
        </script>
    @endif
</body>

</html>
