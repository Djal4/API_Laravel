<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileStoreRequest;
use App\Models\Intern;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FileController extends Controller
{
    /**
     * Store Intern's CV in storage.
     * 
     * @param App\Http\Requests\FileStoreRequest $request
     * @param int $id
     * @param string $path
     */
    public function store(FileStoreRequest $request,$id,$path='')
    {
        $name=Storage::put($path,$request->file('file'));
        $intern=Intern::find($id);
        $intern->update(['cv'=>$name,'path'=>$path]);
    }
    /**
     * Show Intern's CV in storage.
     *
     * @param int $id
     */
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
