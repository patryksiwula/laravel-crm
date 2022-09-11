<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $documents = Document::with('user')->paginate(15);

		return view('documents.list', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $this->authorize('create-documents');

		return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentRequest $request, DocumentService $documentService): RedirectResponse
    {
        $this->authorize('create-documents');
		$documentService->createDocument($request->validated());

		return redirect()->route('documents.index')
			->with('action', __('actions.document_created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
	 * @param  \App\Services\DocumentService $documentService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Document $document, DocumentService $documentService): RedirectResponse
    {
        $this->authorize('delete-documents');
		$documentService->deleteDocument($document);

		return redirect()->route('documents.index')
			->with('action', __('actions.document_deleted'));
    }
	
	/**
	 * Download the specified document.
	 *
	 * @param  \App\Models\Document $document
	 * @return \Symfony\Component\HttpFoundation\StreamedResponse
	 */
	public function download(Document $document): StreamedResponse
	{
		return Storage::download($document->path);
	}
}
