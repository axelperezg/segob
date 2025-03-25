<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::query()
            ->whereIn('type', [
                DocumentTypeEnum::PRESENTATION,
                DocumentTypeEnum::PUBLICATION,
            ])
            ->searchByName(request('title'))
            ->searchByDocumentSection(request('document_section'))
            ->orderByDesc('published_at')
            ->paginate(12)
            ->appends($request->all());

        $filters = [
            'name' => request('title', ''),
            'document_section' => request('document_section', ''),
        ];

        return Inertia::render('Documents/Index', [
            'documents' => DocumentResource::collection($documents),
            'filters' => $filters,
        ]);
    }

    public function show(Document $document)
    {
        $document->load('posts');

        return Inertia::render('Documents/Show', [
            'document' => DocumentResource::make($document),
        ]);
    }
}
