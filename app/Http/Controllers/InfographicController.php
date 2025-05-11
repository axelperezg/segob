<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InfographicController extends Controller
{
    public function index(Request $request)
    {
        $infographics = Document::query()
            ->where('type', DocumentTypeEnum::INFOGRAPHIC)
            ->searchByName(request('title'))
            ->searchByDocumentSection(request('document_section'))
            ->orderByDesc('published_at')
            ->paginate(12)
            ->appends($request->all());
            
        $filters = [
            'name' => request('title', ''),
            'document_section' => request('document_section', ''),
        ];

        return Inertia::render('Infographics/Index', [
            'infographics' => DocumentResource::collection($infographics),
            'filters' => $filters,
        ]);
    }
} 