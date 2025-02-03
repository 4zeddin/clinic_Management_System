@extends('layouts.user')

@push('styles')
    <style>
        .alert {
            padding: 5px !important;
        }
    </style>
@endpush

@section('content')
    <section class="appointment d-flex">
        <div class="form-container">
            <h1 class="mb-5 text-center">Make Appointment</h1>
            <form class="form mx-auto" action="{{ route('appointments.home.store') }}" method="POST">
                @csrf
                @auth
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                @endauth

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-control">
                            <input type="text" id="name" name="name" placeholder=" "
                                @auth value="{{ auth()->user()->name }}" @endauth required/>
                            <label for="name">Name *</label>
                        </div>
                        @error('name')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-control date-input-wrapper">
                            <input type="text" id="date" name="date" class="date-input" placeholder=" "
                                value="{{ old('date') }}"  required/>
                            <label for="date">Select Date *</label>
                            <i class="bi bi-calendar4-week date-icon" id="date-icon" aria-label="Open date picker"></i>
                        </div>
                        @error('date')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-control">
                            <input type="email" id="email" name="email" placeholder=" "
                                @auth value="{{ auth()->user()->email }}" @endauth required/>
                            <label for="email">Email *</label>
                        </div>
                        @error('email')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-control">
                            <select class="form-select" id="doctor" name="doctor" required>
                                <option selected disabled>Select Doctor - speciality *</option>
                                @foreach ($doctors as $doc)
                                    <option value="{{ $doc->name }}" @selected(old('doctor') == $doc->name)>
                                        {{ $doc->name }} {{ ' - ' }} {{ $doc->speciality }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('doctor')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <div class="form-control">
                            <input type="text" id="phone" name="phone" placeholder=" "
                                @auth value="{{ auth()->user()->phone }}" @endauth required/>
                            <label for="phone">Phone *</label>
                        </div>
                        @error('phone')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <div class="form-control">
                            <textarea id="message" name="message" rows="6" placeholder=" " required>{{ old('message') }}</textarea>
                            <label for="message">Message *</label>
                        </div>
                        @error('message')
                            <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-start">
                    @auth
                        <x-button-arrow type="submit">Send</x-button-arrow>
                    @endauth
                    @guest
                        <div class="rounded p-3 mb-2 bg-warning-subtle text-warning-emphasis d-inline-block"><i
                                class="bi bi-exclamation-triangle-fill"></i> Log In is Required to Make Appointment
                        </div>
                    @endguest
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("date");
            const dateIcon = document.getElementById("date-icon");

            const pickedDates = @json($pickedDates);

            console.log(pickedDates);

            const picker = new Litepicker({
                element: dateInput,
                format: "YYYY-MM-DD",
                minDate: new Date(),
                lockDays: pickedDates,
            });

            dateIcon.addEventListener("click", function() {
                picker.show();
            });
        });
    </script>
@endpush
