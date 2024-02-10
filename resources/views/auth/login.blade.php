@extends('layouts.layout')

@section('title', 'BeSmart IT School: Login')
@section('content')
  <x-forms.form-content title="🚀 Login to your account 🚀" link="{{ route('auth.login') }}">
    <x-forms.auth.field value="{{old('email')}}" type="email" name="email" placeholder="email" />
    <x-forms.auth.field  type="password" name="password" placeholder="password" />
    <div class="row mb-3 mt-1 pl-1 flex items-center">
      <input type="checkbox" class="w-4 h-4 mr-2" name="rember" id="rember">
      <label for="rember">Rember me</label>
    </div>
    <x-forms.auth.submit-block type="Sign In" title="Register new account" link="{{ route('auth.add') }}"  />
  </x-forms.form-content>
@endsection