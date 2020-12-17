<?php

namespace App\Http\Controllers;

use App\Entity\User;
use Artesaos\SEOTools\Facades\SEOMeta;

class HomeController extends Controller
{
    public function home()
    {
        SEOMeta::setTitle('Investeraravdrag - 15% tillbaka på din investering');

        return view('home.home');
    }
}
