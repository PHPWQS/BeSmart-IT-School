<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Hash;

trait AuthTrait
{
  protected function hash(string $pwd): string
  {
    return Hash::make($pwd);
  }
}