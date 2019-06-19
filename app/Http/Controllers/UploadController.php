<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class UploadFileController extends Controller
{
    public function index()
    {

        return view('upload');
    }


     Function upload (Request $request)
     {
         $this -> validate($request, [
             'select_file'         =>  '
                  required|image||max:2048'
         ]);
         $image = $request ->file('select_file');
         $new_name = rang() . '.' .$image->
                 GetClientOriginalExtension();
         $image->move(public_path("images"), $new_name);
         return back()->with('sucess', 'Image Uploaded Successfully')
             ->with('path', $new_name);
     }

    public function store(Request $request) {

        $file = $request->file('file');

        $uploadedFile = $file->storeAs('uploaded', 'downloaded.'.$file->extension(), 'public_uploads');

        $request->session()->flash('upload_message_ok', 'Upload OK');

        return view('upload')
            ->with('uploadedFile', $uploadedFile);
    }
}
