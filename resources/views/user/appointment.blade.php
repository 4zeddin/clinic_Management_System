<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Include other CSS files here -->
</head>
<body>
    <div class="page-section">
        <div class="container">
            <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

            <form class="main-form" action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="row mt-5">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input name="name" @if(auth()->check()) value="{{ Auth::user()->name }}" disabled @endif type="text" class="form-control" placeholder="Full name" style="background-color: #ffffff; color: #000000;">
                        @if(auth()->check())
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <input name="email" type="text" @if(auth()->check()) value="{{ Auth::user()->email }}" disabled @endif class="form-control" placeholder="Email address.." style="background-color: #ffffff; color: #000000;">
                        @if(auth()->check())
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        @endif
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                        <input name="date" id="datepicker" type="text" placeholder="yyyy-mm-dd" class="form-control" style="background-color: #ffffff; color: #000000;">
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="doctor" id="department" class="custom-select">
                            <option>--- Select Doctor ---</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->name }}">Dr. {{ $doctor->name }}<p class="text-muted"> -- Speciality: {{ $doctor->speciality }} -- 300dh/h</p></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input name="phone" type="text" class="form-control" @if(auth()->check()) value="{{ Auth::user()->phone }}" disabled @endif placeholder="Number.." style="background-color: #ffffff; color: #000000;">
                        @if(auth()->check())
                            <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                        @endif
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
                    </div>
                </div>

                @if(auth()->check())
                    <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
                @else
                    <button role="alert" type="button" class="alert alert-warning mt-3" disabled><i class="bi bi-exclamation-triangle"></i> Login Required To Make Appointment</button>
                @endif
            </form>
        </div>  
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pickedDates = @json($pickedDates);

            flatpickr("#datepicker", {
                minDate: "today",
                disable: pickedDates.map(date => new Date(date)),
                dateFormat: "Y-m-d"
            });
        });
    </script>
</body>
</html>
