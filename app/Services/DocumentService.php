<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class DocumentService
{	
	/**
	 * Create a new document
	 *
	 * @param  array $attributes
	 * @return \App\Models\Document
	 */
	public function createDocument(array $attributes): Document|FileNotFoundException
	{
		$attributes['file_name'] = str_replace(' ', '_', $attributes['file_name']);
		$document = $attributes['file'];
		$extension = '.' . $document->extension();
		$path = $attributes['file_name'] . $extension;
		$document->storeAs('documents', $path);

		if (!Storage::exists('documents/' . $path))
			return new FileNotFoundException('An error occured while uploading the document');
		
		$attributes['extension'] = $extension;
		$attributes['path'] = 'documents/' . $path;
		unset($attributes['file']);

		return Document::create($attributes);
	}
	
	/**
	 * Delete specified document
	 *
	 * @param  \App\Models\Document $document
	 * @return bool
	 */
	public function deleteDocument(Document $document): bool
	{
		if (Storage::exists($document->path))
			Storage::delete($document->path);

		return $document->delete();
	}
}