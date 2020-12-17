<?php

namespace App\Service\TokenGenerator;

class SimpleToken
{
    static public function generateToken()
    {
        return md5(rand(1, 10) . microtime());
    }
}
