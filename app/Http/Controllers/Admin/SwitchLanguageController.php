<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SwitchLanguageController extends Controller
{
    public function __invoke(String $lang)
    {
        if (in_array($lang, ['en', 'np', 'hi'])) {
            session(['locale' => $lang]);
        }
        return back();
    }

}
