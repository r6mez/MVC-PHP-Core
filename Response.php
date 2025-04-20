<?php 

namespace Ramez\PhpMvcCore;

class Response {
    public function setStatusCode(int $code){
        http_response_code($code);
    }

    public function redirect(string $path){
        header("location: $path");
    }
}