@extends('layouts.user')

@section('main')
    <section>
        <div class="card-body">
            <div class="card-title">
                <h2 class="h5 fw-semibold mb-2">{{ __('Profile Information') }}</h2>
                <p class="text-muted small">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </div>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}"
                        required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                        required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="alert alert-warning mt-2 d-flex align-items-center" role="alert">
                            <div>
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>

                    @if (session('status') === 'profile-updated')
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-success">
                            {{ __('Saved.') }}
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
