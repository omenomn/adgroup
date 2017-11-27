<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\Note\UpdateRequest;

class NotesController extends Controller
{
  public function index()
  {
  	$notes = Note::orderBy('id', 'desc')->get();

  	$notes = $notes->map(function($item) {

  		return [
  			'id' => $item->id,
  			'body' => $item->body,
  			'update_url' => $item->update_url,
  			'destroy_url' => $item->destroy_url,
  			'editMode' => false,
  		];
  	});

  	return view('notes.index', compact('notes'));
  }

  public function store()
  {
  	try {
	  	$note = Note::create([
	  		'body' => null,
	  	]);  		
  	} catch (\Exception $e) {
  		return response()
            ->json([
            	'error_message' => $e->getMessage(),
            ], 500);
  	}

  	return response()
            ->json([
            	'id' => $note->id,
            	'body' => $note->body,
            	'update_url' => $note->update_url,
            ], 200);
  }  

  public function update(UpdateRequest $request, $id)
  {
  	$note = Note::find($id);

  	if (!$note)
	  	return response()
	            ->json([
	            	'error_message' => 'Note is not exists',
	            ], 422);

  	try {
	  	$note->update([
	  		'body' => $request->body,
	  	]);  		
  	} catch (\Exception $e) {
  		return response()
            ->json([
            	'error_message' => $e->getMessage(),
            ], 500);
  	}

  	return response()
            ->json([
            	'success_message' => 'Note is updated',
            ], 200);
  }

  public function destroy($id)
  {
  	$note = Note::find($id);

  	if (!$note)
	  	return response()
	            ->json([
	            	'error_message' => 'Note is not exists',
	            ], 422);
  	try {
	  	$note->delete();  		
  	} catch (\Exception $e) {
  		return response()
            ->json([
            	'error_message' => $e->getMessage(),
            ], 500);
  	}

  	return response()
            ->json([
            	'success_message' => 'Note is deleted',
            ], 200);
  }
}
