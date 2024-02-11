<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreLoginRequest;
use App\Http\Requests\Auth\StorePostRequest;
use App\Http\Services\Users\UserService;
use App\Http\Traits\AuthTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use AuthTrait;

    public function __construct(
        protected UserService $userService
    ) {
    }

    public function index()
    {
        return view('auth.login');
    }

    public function add()
    {
        return view('auth.register');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['password'] = $this->hash($request->get('password'));

        if ($request->has('subscribed')) $data['subscribed'] = true;
        else $data['subscribed'] = false;

        $this->userService->create($data);
        return redirect()->route('auth.index')->with('success', 'You are successfuly registered');
    }

    public function login(StoreLoginRequest $request)
    {
        $rember = false;
        $data = $request->validated();

        if ($request->has('rember')) $rember = true;

        if (Auth::attempt($data, $rember)) {
            $request->session()->regenerate();
            return redirect()->intended('');
        }
        return back()->withErrors(["email" => 'Credintals not correct.'])->onlyInput("email");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
