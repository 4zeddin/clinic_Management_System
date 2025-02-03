@extends('layouts.doctor')

@push('styles')
    <style>
        @media print {

            /* Hide everything by default */
            body * {
                visibility: hidden;
            }

            /* Ensure the printable area is visible */
            .printableArea,
            .printableArea * {
                visibility: visible;
            }

            .printableArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
                box-sizing: border-box;
            }

            /* Hide the print button */
            .print-btn {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="latest-users my-5">
        <div class="p-3 rounded printableArea">
            <h2 class="text-center fw-semibold text-muted pb-3" style="text-decoration: underline">Work Certificate</h2>
            <br>
            <p>This is to certify that Dr. {{ $doctor->name }}, has been employed with us as a medical practitioner.</p>
            <p>Specializing in: {{ $doctor->speciality }}</p>
            <p>Employment Duration: {{ \Carbon\Carbon::parse($doctor->created_at)->diffForHumans() }}</p>
            <p>Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
            <div class="d-flex justify-content-between pt-4">
                <p>Signature: ____________________</p>
                <p class="fw-semibold fs-5">One-<span style="color: var(--light-green)">Health</span></p>
            </div>
        </div>
        <x-animated-btn class="mt-4" onclick="window.print()" color="#00b38f" icon="bi bi-printer">Print
            Certificate</x-animated-btn>
    </div>
@endsection
