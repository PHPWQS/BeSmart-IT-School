@extends('layouts.layout')

@section('title', 'BeSmart IT School: Register')
@section('content')
  <x-forms.form-content title="🚀 Create an account in our platform 🚀" link="{{ route('auth.store') }}">
    <x-forms.auth.field type="email" name="email" placeholder="email" value="{{old('email')}}" />
    <x-forms.auth.field type="text" name="name" placeholder="name" value="{{old('name')}}" />
    <x-forms.auth.field type="password" name="password" placeholder="password" />
    <x-forms.auth.field type="password" name="password_confirmation" placeholder="confirm password" />
    <div class="row mb-3 mt-1 pl-1 flex items-center">
      <input type="checkbox" class="w-4 h-4 mr-2" name="subscribed" id="subscribe">
      <label for="subscribe">Subscribe for news</label>
    </div>
    <x-forms.auth.submit-block type="Sign Up" title="Go to Login" link="{{ route('auth.index') }}"  />
  </x-forms.form-content>
@endsection