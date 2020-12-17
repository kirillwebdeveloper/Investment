<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;

class InformationController extends Controller
{
    public function policy()
    {
        SEOMeta::setTitle('Policy');

        return view('information.policy');
    }

    public function aboutAs()
    {
        SEOMeta::setTitle('Om oss | Investeraravdrag.se');

        return view('information.about_us');
    }

    public function terms()
    {
        SEOMeta::setTitle('Terms');

        return view('information.terms');
    }

    public function corporate()
    {
        SEOMeta::setTitle('Corporate');

        return view('information.corporate');
    }

    public function privatePage()
    {
        SEOMeta::setTitle('Private');

        return view('information.private');
    }
}
