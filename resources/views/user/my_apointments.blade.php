<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>One Health</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anta&family=Ojuju:wght@200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../assets/css/maicons.css">

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="../assets/css/theme.css">

    <link rel="shortcut icon" href="admin/template/assets/images/favicon.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

</head>
@vite('resources/js/app.js')
<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <div id="app">

    @include('user.header')
    @if (session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        @if ($appointments->isEmpty())
            <div class="text-center my-5">
                <h1 class="font-bold">You have no appointments !</h1>
            </div>
        @else
            <table class="table table-light table-striped mt-5 border">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->doctor }}</td>
                            <td class="font-weight-bold @if($row->status == 'approved') text-primary @elseif ($row->status == 'canceled') text-danger @else text-warning @endif">{{ $row->status }}</td>
                            <td>{{ $row->message }}</td>
                            <td>
                                <a type="button" href='{{ route('appointments.delete', $row->id) }}'
                                    onclick="confirmDelete(event)" class="btn btn-outline-danger">
                                    cancel
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>


    <footer-section></footer-section>

    </div>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <script src="../assets/vendor/wow/wow.min.js"></script>

    <script src="../assets/js/theme.js"></script>

    <script>
    function confirmDelete(event) {
        event.preventDefault();
        var url = event.target.href;
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
            } else {
                swal("Your file is safe!");
            }
        });
    }
</script>


</body>

</html>
