@extends('layouts.master')

@section('content')
    @include('includes.page_header')
    
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <style>
        .contact-page {
            background-color: #f8f9fa;
        }
        .contact-form-wrapper, .company-info-wrapper {
            transition: all 0.3s ease;
        }
        .contact-form-wrapper:hover, .company-info-wrapper:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        .company-info-wrapper {
            background-color: #f8f9fa;
            color: #333;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
        }
        .icon-box {
            width: 50px;
            height: 50px;
            background-color: #243b55;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .icon-box i {
            font-size: 1.5rem;
            color: white;
        }
        .info-content {
            flex-grow: 1;
        }
        .info-title {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #333;
        }
        .info-text {
            font-size: 1rem;
            margin-bottom: 0;
            color: #555;
        }
    </style>

    <section class="contact-page py-5">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="contact-form-wrapper p-4 bg-white shadow-sm rounded">
                        <h2 class="mb-4">Get in Touch</h2>
                        <form id="contactForm" action="{{ route('Contacts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Your name" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="emailAddress">Email Address</label>
                                <input class="form-control" id="emailAddress" name="email" type="email" placeholder="Your email" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_number">Phone Number</label>
                                <input class="form-control" id="phone_number" name="phone_no" type="number" min="1" placeholder="Your phone number" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message" required></textarea>
                            </div>
                            <div class="mb-3 recaptcha-container">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            </div>
                            <div class="mb-3">
                                <div id="recaptchaError" class="text-danger"></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary w-30" style="background-color: #243b55; border-color:#243b55; text-align:center;" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>                              
                <div class="col-lg-6">
                    <div class="company-info-wrapper p-4 bg-light rounded h-100 d-flex flex-column justify-content-center">
                        <h2 class="mb-4 text-dark">{{ $sitesetting->office_name }}</h2>
                        <div class="company-info">
                            <div class="info-item mb-4">
                                <div class="icon-box">
                                    {{-- <i class="fas fa-map-marker-alt fa-fw"></i> --}}
                                    <i class="fas fa-location-dot"></i>
                                </div>
                                <div class="info-content">
                                    <h4 class="info-title">Address</h4>
                                    <p class="info-text">{{ $sitesetting->office_address }}</p>
                                </div>
                            </div>
                            <div class="info-item mb-4">
                                <div class="icon-box">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <h4 class="info-title">Phone</h4>
                                    <p class="info-text">{{ $sitesetting->office_contact }}</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="icon-box">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4 class="info-title">Email</h4>
                                    <p class="info-text">{{ $sitesetting->office_mail }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            var recaptchaError = document.getElementById('recaptchaError');
            if (response.length == 0) {
                // reCaptcha not verified
                event.preventDefault();
                recaptchaError.textContent = "Please verify that you are not a robot.";
            } else {
                recaptchaError.textContent = ""; // Clear the error message
            }
        });
    </script>
    
   
@endsection
