<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageController extends Controller
{
    public function updateLanguage(Request $request)
    {
        $language = $request->input('language');
        if ($language === '/en/si') {
            $lng = 'si';
            session()->put('current_language', $lng);
            return response()->json(['success' => true]);
        }else {
            session()->forget('current_language');
            return response()->json(['success' => false]);
        }
    }
}
