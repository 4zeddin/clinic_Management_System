@extends('layouts.admin')

@push('styles')
    <style>
        img {
            width: 50px;
            height: 50px;
        }

        .file-input__input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .file-input__label {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 12px;
            background-color: #f8f8f8;
            color: var(--hover-gray)
        }

        .file-input__label svg {
            height: 16px;
            margin-right: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="latest-users my-5">
        <div class="latest-users-header">
            <span class="title">Doctors List</span>
            <a type="button" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
                <x-animated-btn icon="bi bi-plus-square-dotted" color="#00b38f">Add Doctor</x-animated-btn>
            </a>
        </div>
        <hr>
        @if ($doctors->isEmpty())
            <div class="text-center">
                <h3 class="font-bold">Doctors empty!</h3>
            </div>
        @else
            <div class="table-responsive">
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Cost</th>
                            <th>Speciality</th>
                            <th>Image</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                            <tr>
                                <td>Dr. {{ $doctor->name }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->phone }}</td>
                                <td>300dh/h</td>
                                <td>{{ $doctor->speciality }}</td>
                                <td>
                                    <img loading="lazy" src="{{ asset('doctorImage/' . $doctor->image) }}"
                                        alt="{{ $doctor->name }}" class="img-fluid rounded-circle">
                                </td>
                                <td>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#editDoctorModal{{ $doctor->id }}">
                                        <x-animated-btn type="submit" color="#367588">
                                            <i class="bi bi-x-square"></i> Edit
                                        </x-animated-btn>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('doctor.delete', $doctor->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-animated-btn type="submit" onclick="confirmDelete(event)">
                                            <i class="bi bi-x-square"></i> Delete
                                        </x-animated-btn>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Doctor Modal -->
                            <div class="modal fade" id="editDoctorModal{{ $doctor->id }}" tabindex="-1"
                                aria-labelledby="editDoctorModalLabel{{ $doctor->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDoctorModalLabel{{ $doctor->id }}">Edit
                                                Doctor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('doctor.update', $doctor->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <input type="text" id="name{{ $doctor->id }}" name="name"
                                                            value="{{ $doctor->name }}" placeholder=" " required />
                                                        <label for="name{{ $doctor->id }}">Name</label>
                                                    </div>
                                                    @error('name')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <input type="email" id="email{{ $doctor->id }}" name="email"
                                                            value="{{ $doctor->email }}" placeholder=" " required />
                                                        <label for="email{{ $doctor->id }}">Email</label>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <input type="text" id="phone{{ $doctor->id }}" name="phone"
                                                            value="{{ $doctor->phone }}" placeholder=" " required />
                                                        <label for="phone{{ $doctor->id }}">phone</label>
                                                    </div>
                                                    @error('phone')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <div class="form-control">
                                                        <input type="text" id="speciality{{ $doctor->id }}"
                                                            name="speciality" value="{{ $doctor->speciality }}"
                                                            placeholder=" " required />
                                                        <label for="speciality{{ $doctor->id }}">Speciality</label>
                                                    </div>
                                                    @error('phone')
                                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <div class="file-input">
                                                        <input type="file" name="image" id="image{{ $doctor->id }}"
                                                            class="file-input__input" />
                                                        <label class="file-input__label" for="image{{ $doctor->id }}">
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="upload" class="svg-inline--fa fa-upload fa-w-16"
                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill="currentColor"
                                                                    d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                                                </path>
                                                            </svg>
                                                            <span>Upload Image</span></label>
                                                    </div>
                                                    @error('image')
                                                        <div class="alert alert-danger mt-2" role="alert">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <x-button-arrow>Save</x-button-arrow>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add Doctor Modal -->
            <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDoctorModalLabel">Add Doctor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <div class="form-control">
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            placeholder=" " required />
                                        <label for="name">Name *</label>
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="form-control">
                                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder=" " required />
                                        <label for="phone">phone *</label>
                                    </div>
                                    @error('phone')
                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <select class="form-select" id="speciality" name="speciality" required>
                                        <option selected disabled>Select speciality *</option>
                                        <option value="general" @selected(old('speciality') == 'general')>General</option>
                                        <option value="skin" @selected(old('speciality') == 'skin')>Skin</option>
                                        <option value="eye" @selected(old('speciality') == 'eye')>Eye</option>
                                        <option value="heart" @selected(old('speciality') == 'heart')>Heart</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <div class="form-control">
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            placeholder=" " required />
                                        <label for="email">Email *</label>
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="form-control">
                                        <input type="password" id="password" name="password"
                                            value="{{ old('password') }}" placeholder=" " required />
                                        <label for="password">Password *</label>
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger mt-2" role="alert">{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="file-input">
                                        <input type="file" name="image" id="image" class="file-input__input" />
                                        <label class="file-input__label" for="image">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="upload" class="svg-inline--fa fa-upload fa-w-16"
                                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                                </path>
                                            </svg>
                                            <span>Upload Image</span></label>
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <x-button-arrow>Add Doctor</x-button-arrow>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
