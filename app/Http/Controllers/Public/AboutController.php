<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $allContents = WebsiteContent::all();
        $contents = [];
        foreach ($allContents as $c) {
            $contents[$c->section][$c->key] = $c->value;
        }

        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.about', compact('contents', 'settings'));
    }
}
