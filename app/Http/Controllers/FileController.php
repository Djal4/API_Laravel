<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intern;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FileController extends Controller
{
    /**
     * Store Intern's CV in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param string $path
     */
    public function store(Request $request,$id,$path='')
    {
        $name=Storage::put($path,$request->file('file'));
        $intern=Intern::find($id);
        $intern->update(['cv'=>$name,'path'=>$path]);
    }
    public function show($id)
    {
        $intern=Intern::find($id);
        $path=$intern['path'].$intern['cv'];
        if(Storage::exists($path)){
            return Storage::download($path,'CV.pdf');
        }else{
            throw new FileNotFoundException;
        }
    }
}
