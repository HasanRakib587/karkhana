@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="container my-5 pt-5">
        <h1>Contact Us</h1>
        <!-- Bootstrap 5 starter form -->
        <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- Name input -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Email address input -->
                    <div class="mb-3">
                        <label class="form-label" for="emailAddress">Email Address</label>
                        <input class="form-control" name="email" id="emailAddress" type="email"
                            placeholder="Email Address" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="message">Message</label>
                        <textarea class="form-control" name="message" rows="5" required id="message" type="text"
                            placeholder="Message" style="height: 10rem;"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{-- CAPTCHA --}}
                    <div class="mb-3">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                        </div>
                        @error('captcha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Form submit button -->
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush