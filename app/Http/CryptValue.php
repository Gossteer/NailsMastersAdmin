<?php

namespace App\Http;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class CryptValue
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    static public function encrypting($value)
    {
        return Crypt::encryptString($value);
    }

    static public function decrypting($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $e;
        }
    }
}
