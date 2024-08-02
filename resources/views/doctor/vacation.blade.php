<!DOCTYPE html>
<html lang="en">

<head>
    @include('doctor.css')
</head>

<body>
    <div class="container-scroller">
        @include('doctor.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('doctor.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div style="background-color: #191c24" class="p-5 rounded">
                            <h1 class="text-center">Vacation Request</h1>
                            <form action="{{ route('doctor.vacation.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" id="start_date"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="reason">Reason</label>
                                    <textarea name="reason" class="form-control text-white" id="reason" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit Request <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                    </svg></button>
                            </form>
                            @if ($req->isNotEmpty())
                                <a href="{{ route('doctor.vacations') }}" class="btn btn-secondary mt-3">Request History
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('doctor.script')
</body>

</html>
