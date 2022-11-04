<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Language extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function switchLocale(Request $request)
    {
        $locale = $request->locale;
        \Session::put('locale',$locale);

        return redirect()->back();
    }
}
