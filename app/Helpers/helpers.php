<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('active')) {
  function active($params)
  {
    return Route::is($params) ? 'active' : '';
  }
}
