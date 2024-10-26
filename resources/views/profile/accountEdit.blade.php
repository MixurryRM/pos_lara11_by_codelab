@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="container vh-75 d-flex justify-content-center align-items-center" style="margin-top: 2rem">
            <div class="card shadow p-5" style="width: 100%; max-width: 600px;">
                <h3 class="text-center mb-4 text-primary">Account Edition</h3>
                <form id="accountInfoForm">
                    <!-- Profile Image -->
                    <div class="d-flex">
                        <div class="col mr-5">
                            <div class="mb-3 text-center">
                                <div class="d-flex justify-content-center mb-3">
                                    <img id="profileImagePreview" src="{{ asset('admin/img/undraw_profile.svg') }}"
                                        alt="Profile Image" class="rounded-circle" style="width: 150px; height: 150px;">
                                </div>
                                <input type="file" class="form-control" id="profileImage" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ $userData->name }}"
                                    placeholder="Enter your name" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $userData->email }}" id="email"
                                    placeholder="Enter your email" required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" value="{{ $userData->phone }}"
                                    placeholder="Enter your phone number" required>
                            </div>

                            <!-- Address -->
                            <div class="mb-2">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" placeholder="Enter your address">{{ $userData->address }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary w-100">Save Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
