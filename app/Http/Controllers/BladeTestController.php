<?php

namespace App\Http\Controllers;

class BladeTestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('pages.blade-test', [
            'title' => 'Blade Test Page',
            'testData' => [
                'message' => 'Hello from Blade!',
                'items' => ['Item 1', 'Item 2', 'Item 3'],
            ],
        ]);
    }
}
