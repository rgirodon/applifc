<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadFileController extends Controller
{
    public function index() {
        
        return view('upload');
    }
    
    public function store(Request $request) {
        
        $file = $request->file('file');
        
        Log::info('File uploadé : '.$file);
        
        $uploadedFile = $file->storeAs('uploaded', 'downloaded.'.$file->extension(), 'public_uploads');
        
        Log::info('File sauvegardé : '.$uploadedFile);
        
        $request->session()->flash('upload_message_ok', 'Upload OK');
        
        return view('upload')
                ->with('uploadedFile', $uploadedFile);
    }
}
