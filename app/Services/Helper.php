<?php 

use Illuminate\Validation\Validator;

function messageValidation(Validator $validator): string 
{
    $errors = $validator->errors()->getMessages();
    $content = array_values($errors);
    $message = $content[0][0];
    return $message; 
}

function randomCode(?int $long = 8): string
{
    $text = '0123456789abcdefghijklmnopqrstuvwxyzñQWERTYUIOPÑLKJHGFDSAZXCVBNM';
    $code  =  '';
    for($i =0; $i < $long; $i++){
        $code .= $text[random_int(0, strlen($text) - 1)];
    }
    return $code;
}

function transactionCode($prefix = null, $a = 1664525, $c = 1013904223, $m = 2 **32)
{
    $seed = round(microtime(true)*1000);
    $code = ($a*$seed + $c) % $m;
    if(strlen($code) < 10){
        $code = str_pad($code, 10, '0', STR_PAD_LEFT);
    }
    $code = base64_encode($code);
    return !is_null($prefix) ?  $prefix . '-' . $code :  $code;
}