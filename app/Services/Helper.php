<?php 

use Illuminate\Validation\Validator; 
use Illuminate\Support\Facades\Log;

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