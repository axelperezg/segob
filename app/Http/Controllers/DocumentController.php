<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function __invoke(Request $request)
    {
        $documents = Document::query()
            ->searchByName(request('title'))
            ->searchByDocumentSection(request('document_section'))
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString(); 

        $filters = [
            'name' => request('title', ''),
            'document_section' => request('document_section', ''),
        ];

        return Inertia::render('Documents/Index', [
            'documents' => DocumentResource::collection($documents),
            'filters' => $filters,
        ]);
    }
} 