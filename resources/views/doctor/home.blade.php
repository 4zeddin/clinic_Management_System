<!DOCTYPE html>
<html lang="en">
<head>
    @include('doctor.css')
    <style>
        @media print {
            /* Hide everything by default */
            body * {
                visibility: hidden;
            }
            /* Ensure the printable area is visible */
            .printableArea, .printableArea * {
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
</head>
<body>
    <div class="container-scroller">
        @include('doctor.sidebar')
        <div class="container-fluid page-body-wrapper">
            @include('doctor.navbar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-12">
                        <div class="bg-white text-black p-5 rounded printableArea">
                            <h1 class="text-center">Work Certificate</h1>
                            <br>
                            <p>This is to certify that Dr. {{ $doctor->name }}, has been employed with us as a medical practitioner.</p>
                            <p>Specializing in: {{ $doctor->speciality }}</p>
                            <p>Employment Duration: {{ \Carbon\Carbon::parse($doctor->created_at)->diffForHumans() }}</p>
                            <p>Date: {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <p>Signature: ____________________</p>
                                <p class="font-weight-bold">One Health</p>
                            </div>
                            <button class="btn btn-primary mt-3 print-btn" onclick="window.print()">Print Certificate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('doctor.script')
</body>
</html>
