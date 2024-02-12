<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel
{
  case Customer = 'customer';
  case Moderator = 'moderator';
  case Admin = 'admin';

  public function getLabel(): ?string
  {
    return $this->name;

    return match ($this) {
      self::Customer => 'Customer',
      self::Moderator => 'Moderator',
      self::Admin => 'Admin',
    };
  }
}
