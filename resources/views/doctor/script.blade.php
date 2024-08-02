<!-- JavaScript Libraries -->
    <script src="{{ asset('admin/template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/template/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/template/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/template/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/template/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/template/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>

<!-- Custom Scripts -->
    <script src="{{ asset('admin/template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/misc.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/settings.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('admin/template/assets/js/dashboard.js') }}"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); 
            var url = event.currentTarget.getAttribute('href');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                    swal("Poof! Your file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
        }
    </script>
    