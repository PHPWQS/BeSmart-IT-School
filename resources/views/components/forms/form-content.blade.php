@props(['title', 'link'])

<div class="auth-content max-w-xl mt-8 mx-auto">
    @if (session('success'))
      <div class="success alert mb-3 bg-green-800 py-2 px-2 rounded-md">
        <span class="text-white font-bold text-xl">{{ session('success') }}</span>
      </div>
    @endif
    <div class="auth-title pl-3 text-center">
      <span class="text-xl font-bold">{{ $title }}</span>
    </div>
    <div class="auth-content mt-3">
      <form action="{{ $link }}" method="POST">
        @csrf
        {{ $slot }}
      </form>
    </div>
  </div>
