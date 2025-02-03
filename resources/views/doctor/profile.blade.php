@extends('layouts.doctor')

@push('styles')
    <style>
        .image-container {
            position: relative;
            width: 220px;
            height: 220px;
            padding: 5px;
            border: 3px solid #00b38f;
            border-radius: 50%;
            display: inline-block;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <h3 class="text-muted fw-semibold my-4">Doctor Profile</h3>
            <x-animated-btn type="button" data-bs-toggle="modal" data-bs-target="#editProfileModal" color="#00b38f">Edit
                Profile
            </x-animated-btn>
        </div>
        <hr>
        <div class="row">
            <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                <div class="image-container">
                    <img loading="lazy" src="{{ asset('doctorImage/' . $doctor->image) }}" alt="Doctor Image">
                </div>
            </div>
            <div class="col-6 d-flex flex-column justify-content-center align-items-start">
                <div class="mb-5">
                    <h4 class="mb-3">Personel Information</h4>
                    <span class="fw-semibold me-3">Name: </span><span>{{ $doctor->name }}</span><br>
                    <span class="fw-semibold me-3">Speciality: </span><span>{{ $doctor->speciality }}</span>
                </div>
                <div>
                    <h4 class="mb-3">Contact Information</h4>
                    <i class="bi bi-envelope"></i> <span class="fw-semibold me-3">Email:
                    </span><span>{{ $doctor->email }}</span><br>
                    <i class="bi bi-telephone"></i> <span class="fw-semibold me-3">Phone:
                    </span><span>{{ $doctor->phone }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProfileModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('doctor.profile.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <div class="form-control">
                                <input type="text" id="name{{ $doctor->id }}" name="name"
                                    value="{{ $doctor->name }}" placeholder=" " required />
                                <label for="name{{ $doctor->id }}">Doctor Name</label>
                            </div>
                            @error('name')
                                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-control">
                                <input type="text" id="phone{{ $doctor->id }}" name="phone"
                                    value="{{ $doctor->phone }}" placeholder=" " required />
                                <label for="phone{{ $doctor->id }}">Phone</label>
                            </div>
                            @error('phone')
                                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-control">
                                <input type="text" id="speciality{{ $doctor->id }}" name="speciality"
                                    value="{{ $doctor->speciality }}" placeholder=" " required />
                                <label for="speciality{{ $doctor->id }}">Speciality</label>
                            </div>
                            @error('speciality')
                                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-control">
                                <input type="email" id="email{{ $doctor->id }}" name="email"
                                    value="{{ $doctor->email }}" placeholder=" " required />
                                <label for="email{{ $doctor->id }}">Email address</label>
                            </div>
                            @error('email')
                                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <img loading="lazy" src="{{ asset('doctorImage/' . $doctor->image) }}" alt="Doctor Image"
                            class="img-fluid w-25 h25 border border-success-subtle rounded mb-3" />

                        <div class="mb-4">
                            <div class="form-control">
                                <input type="file" id="image{{ $doctor->id }}" name="image" placeholder=" " />
                                <label for="image{{ $doctor->id }}">Update image</label>
                            </div>
                            @error('image')
                                <div class="alert alert-danger mt-2" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <x-button-arrow onclick="confirmDelete(event)">Update</x-button-arrow>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
