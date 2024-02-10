<?php

namespace App\Http\Services\Users;

use App\Models\User;

class UserService
{
  public function find(int $id): mixed
  {
    $user = User::query()->findOrFail($id);
    return $user;
  }

  public function create(array $userDto): mixed
  {
    $user = User::query()->create($userDto);
    return $user;
  }
}
