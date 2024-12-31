<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dependency;
use Illuminate\Http\JsonResponse;

class DependencyListController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $dependencies = Dependency::select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($dependencies);
    }
}
