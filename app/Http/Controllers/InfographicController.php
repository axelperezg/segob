<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Models\Document;
use Illuminate\Http\Request;

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

        return view('pages.infographics.index', [
            'infographics' => $infographics,
            'filters' => $filters,
            'documentSections' => \App\Models\DocumentSection::all(),
        ]);
    }
} 