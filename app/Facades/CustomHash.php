<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


class CustomHash extends Facade {
  protected static function getFacadeAccessor() { return 'customHash'; }
}
