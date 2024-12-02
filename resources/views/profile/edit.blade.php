@extends('layouts.app')

@section('main')
    <div class="container-fluid">
        <div class="container p-3">
            <h5 class="card-title fw-semibold mb-4">Profile Settings</h5>

            <div class="row flex flex-col">
                <div class="col mb-4">
                    <div class="card">
                        <div class="">

                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card">
                        <div class="">

                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card">
                        <div class="">

                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
