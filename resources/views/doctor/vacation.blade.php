@extends('layouts.doctor')

@push('styles')
    <style>
        .form-control textarea {
            font-size: 16px;
            border: none;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease;
            color: var(--hover-gray) !important;
            background: #f8f8f8;
        }

        .date-icon {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--hover-gray);
        }

        .litepicker .container__days .day-item:hover {
            color: var(--light-green) !important;
            -webkit-box-shadow: inset 0 0 0 1px var(--light-green) !important;
            box-shadow: inset 0 0 0 1px var(--light-green) !important;
        }
    </style>
@endpush

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <h4>Vacation Request</h4>
            @if ($req->isNotEmpty())
            <a href="{{ route('doctor.vacations') }}">
                <x-animated-btn color="#367588" icon="bi bi-clock-history">Requests History</x-animated-btn>
            </a>
        @endif
        </div>
        <hr>
        <form action="{{ route('doctor.vacation.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="form-control position-relative">
                    <input type="text" id="start_date" name="start_date" placeholder=" " required />
                    <label for="start_date">Start Date</label>
                    <i class="bi bi-calendar4-week date-icon start-date-icon" aria-label="Open date picker"></i>
                </div>
                @error('start_date')
                    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-control position-relative">
                    <input type="text" id="end_date" name="end_date" placeholder=" " required />
                    <label for="end_date">End Date</label>
                    <i class="bi bi-calendar4-week date-icon end-date-icon" aria-label="Open date picker"></i>
                </div>
                @error('end_date')
                    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-control">
                    <textarea id="reason" class="w-100 p-4" name="reason" placeholder=" " rows="3" required></textarea>
                    <label for="reason">Reason</label>
                </div>
                @error('reason')
                    <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                @enderror
            </div>
            <x-button-arrow type="submit">Submit</x-button-arrow>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Litepicker for start date
            const startDateInput = document.getElementById("start_date");
            const startDateIcon = document.querySelector(".start-date-icon");

            const startPicker = new Litepicker({
                element: startDateInput,
                format: "YYYY-MM-DD",
                minDate: new Date(),
            });

            startDateIcon.addEventListener("click", function() {
                startPicker.show();
            });

            // Initialize Litepicker for end date
            const endDateInput = document.getElementById("end_date");
            const endDateIcon = document.querySelector(".end-date-icon");

            const endPicker = new Litepicker({
                element: endDateInput,
                format: "YYYY-MM-DD",
                minDate: new Date(),
            });

            endDateIcon.addEventListener("click", function() {
                endPicker.show();
            });
        });
    </script>
@endpush
