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
                <div class="col-12" aling="center">
                    <form action="{{route('email.send', $data->id)}}" method="POST" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputtext1" class="text-white">Greeting</label>
                            <input type="text" name="greeting" class="form-control text-white" id="exampleInputtext1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtext2" class="text-white">Body</label>
                            <input type="text" name="body" class="form-control text-white" id="exampleInputtext2"
                                 required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputtext2" class="text-white">Action Text</label>
                            <input type="text" name="text" class="form-control text-white" id="exampleInputtext2"
                                 required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-white">Action Url</label>
                            <input type="text" name="url" class="form-control text-white" id="exampleInputEmail1"
                              required>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="text-white">End part</label>
                            <input type="text" name="end" class="form-control text-white" id="pass"
                              required>
                        </div>
                        <button type="submit" class="btn btn-outline-success mt-3" style="font-size: 1rem">
                            <i class="bi bi-send"></i>
                            Send</button>
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
    @if (session()->has('msg'))
        <script>
            swal({
                title: "Email Sent",
                text: "{{ session()->get('msg') }}",
                icon: "success",
                button: "OK",
                timer: 3000
            });
        </script>
    @endif
</body>

</html>
