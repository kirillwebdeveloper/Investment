<?php

namespace App\Http\Controllers\Admin\Options;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Options\AboutUsPageOptionRequest;
use App\Http\Requests\Admin\Options\FrontPageOptionRequest;
use App\Models\Option\AboutUsPageOption;
use App\Models\Option\FrontPageOption;
use App\Models\Option\PrivacyPageOption;
use App\Models\Option\TermsPageOption;
use App\Service\Option\Facades\Options;

class AdminOptionTermsPageController extends Controller
{
    public function options()
    {
        return view('admin.options.terms');
    }

    public function optionsPost(AboutUsPageOptionRequest $request)
    {
        $model = new TermsPageOption();

        $model->title = $request->input('title');
        $model->body  = $request->input('body');
        $model->auth  = $request->input('auth');

        Options::save($model);

        return redirect()->route('admin_options_terms');
    }
}
