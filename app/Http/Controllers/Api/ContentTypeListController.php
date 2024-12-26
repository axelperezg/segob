<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Enums\Posts\ContentTypeEnum;

class ContentTypeListController extends Controller
{
    public function __invoke()
    {
        $contentTypes = collect(ContentTypeEnum::cases())->map(function ($type) {
            return [
                'id' => $type->value,
                'name' => $type->getLabel()
            ];
        });

        return response()->json($contentTypes);
    }
} 