<?php

namespace App\Http\Controllers;

use App\Enums\Documents\DocumentTypeEnum;
use App\Models\Document;
use App\Models\DocumentSection;
use Illuminate\Http\Request;

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
            'title' => request('title', ''),
            'document_section' => request('document_section', ''),
        ];

        return view('pages.documents.index', [
            'documents' => $documents,
            'filters' => $filters,
            'documentSections' => DocumentSection::all(),
        ]);
    }

    public function show(Document $document)
    {
        $document->load(['posts', 'media']);

        // Check if we should use Blade
        if (config('migration.use_blade') || in_array('documents.show', config('migration.migrated_routes', []))) {
            return view(
}
