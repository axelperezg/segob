<?php

namespace App\Http\Controllers;

use App\Http\Resources\MexicoNewsResource;
use App\Models\MexicoNews;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MexicoNewsController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('MexicoNews');
    }
}
