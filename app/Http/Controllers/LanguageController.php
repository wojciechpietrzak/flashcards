<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Fetch all available languages.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLanguages()
    {
        $languages = Language::all(['id', 'name', 'code']); // Fetch language id, name, and code
        return response()->json($languages); // Return as JSON
    }
}
