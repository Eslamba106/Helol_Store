@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    {{-- <li class="breadcrumb-item active">Profile</li> --}}
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-row">
            <div class="col-md-6">
                <x-form.label>First Name</x-form.label>
                <x-form.input name="first_name" :value="$user->profile->first_name" />
            </div>
            <div class="col-md-6">
                <x-form.label>Last Name</x-form.label>
                <x-form.input name="last_name" :value="$user->profile->last_name" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <x-form.label>Birthday</x-form.label>
                <x-form.input name="birthday" type="date" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
                <x-form.label>Gender</x-form.label>
                <x-form.radio name="gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <x-form.label>Street Address</x-form.label>
                <x-form.input name="street_address" :value="$user->profile->streer_address" />
            </div>
            <div class="col-md-4">
                <x-form.label>City</x-form.label>
                <x-form.input name="city" :value="$user->profile->city" />
            </div>

            <div class="col-md-4">
                <x-form.label>State</x-form.label>
                <x-form.input name="state" :value="$user->profile->state" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <x-form.label>Postal Code</x-form.label>
                <x-form.input name="postal_code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
                <x-form.label>Country</x-form.label>
                <x-form.select name="country" :options="$countries" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
                <x-form.label>Locale</x-form.label>
                <x-form.select name="locale" :options="$locales"  :selected="$user->profile->locale" />
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save</button>

    </form>
@endsection
{{-- /* :value="$user->profile->locale" :value="$user->profile->country" */ --}}