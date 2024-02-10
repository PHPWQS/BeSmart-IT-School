@props(['type', 'title', 'link'])

<div class="flex items-center justify-between mt-2">
    <button class="px-4 py-2 bg-slate-900 text-white rounded-md">{{ $type }}</button>
    <div class="register">
      <a href="{{ $link }}" class="hover:underline text-base">{{ $title }}</a>
    </div>
</div>