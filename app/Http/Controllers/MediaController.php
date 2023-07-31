<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Models\Media;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MediaController extends Controller
{

    public function index()
    {
        $medias = Media::query()->get();
//dd($medias);
        return view('medias.index', compact('medias'));
    }

    public function create()
    {
        return view('medias.add', ['media' => new Media]);
    }

    public function edit(Media $media)
    {
       return view('medias.edit', compact('media'));
    }

    public function store(MediaRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file') && $request->file('file')->isValid()){
           $data['file'] = Media::uploadFile($request->file('file'));
        }

         $data['code'] = Str::random(10);
        $media = Media::create($data);

        return redirect()->route('medias.index')->with('success', "Media {$media->title} added successfully.");
    }

    public function update(MediaRequest $request, Media $media)
    {

    }

    public function downloadForm(Request $request, Media $media): Renderable
    {
        $link = URL::signedRoute('medias.download', ['media' => $media]);

//        dd($link);
       return view('medias.download', compact('media', 'link'));
    }

    public function download(Request $request, Media $media)
    {
        if($media->file && Storage::disk('uploads')->exists($media->file)){
            return response()->download(Storage::disk('uploads')->path($media->file));
        }

        return redirect()->back()->with('error', 'Something Error.');
    }

    public function destroy($id)
    {
        $media = Media::find($id);

        if(!$media){
           return back()->with('error', 'Something error.');
        }

        $media->delete();
        Media::DeleteFile($media->file);
        return Redirect::back()->with('success', "Media with title {$media->title} deleted successfully.");
    }
}