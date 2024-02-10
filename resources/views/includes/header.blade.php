<header class="mt-1 py-2 rounded-md pl-3" style="box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.75);">
  <nav class="flex items-center justify-between">
    <div class="logo">
      <a href="{{ route('index') }}">
        <div class="logo_content px-3 py-2 rounded-full bg-slate-800 flex items-center">
          <span class="mr-3 text-slate-900 font-bold text-xl">⚛️</span>
          <span class="text-white text-lg">BeSmart</span>
        </div>
      </a>
    </div>
    <ul class="flex items-center justify-between">
      <li class="duration-300 mr-5 py-3 px-2 rounded-md hover:text-white hover:bg-slate-900 hover:cursor-pointer">
        <a href="" class="font-bold">All Courses</a>
      </li>
      <li class="duration-300 mr-5 py-3 px-2 rounded-md hover:text-white hover:bg-slate-900 hover:cursor-pointer">
        <a href="" class="font-bold">Blogs</a>
      </li>
      <li class="duration-300 mr-5 py-3 px-2 hover:text-white hover:bg-slate-900 hover:cursor-pointer rounded-md">
        <a href="" class="font-bold">About Project</a>
      </li>
      @auth
      <li class="mr-5">
        <a href="{{ route('auth.logout') }}" class="font-bold">
          <button class="px-4 py-3 bg-slate-900 text-white rounded-md">Logout</button>
        </a>
      </li>
      @else
      <li class="mr-5">
        <a href="{{ route('auth.index') }}" class="font-bold">
          <button class="px-4 py-3 bg-slate-900 text-white rounded-md">Sign In</button>
        </a>
      </li>
      @endauth
    </ul>
  </nav>
</header>