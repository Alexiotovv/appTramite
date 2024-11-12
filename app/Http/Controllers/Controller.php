<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Exception;

abstract class Controller
{
    public function LogError(string $class, Exception $e,  string $function)
    {   
        Log::error($class . ', '.  $function . ':' . $e->getMessage());
    }
}