<?php

namespace App\Http\Controllers;

use App\Events\DownloadFile;
use App\Http\Requests\MediaRequest;
use App\Models\Media;
use App\services\IPGeolocation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
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

    public function showFile(Media $media, $filename)
    {
        if (!Storage::disk('local')->exists($filename)) {
            abort(404);
        }

        $path = Storage::disk('local')->path($filename);
        $file = Storage::disk('local')->get($filename);
        $type = Storage::mimeType($path);

        return Response::make(content: $file, headers: ['Content-Type' => $type, 'Content-Length' => filesize($path)]);
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

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $data['file'] = Media::uploadFile($request->file('file'));
        }

        $data['code'] = Str::random(10);
        $media = Media::create($data);

        return redirect()->route('medias.index')->with('success', "Media {$media->title} added successfully.");
    }

    public function downloadForm(Request $request, Media $media): Renderable
    {
        $ip = $request->ip() != '127.0.0.1' ?: '100.128.0.0';
        $geo = IPGeolocation::getInfo($ip);
        $link = URL::signedRoute('medias.download', ['media' => $media]);

//        dd($link);
        return view('medias.download', compact('media', 'link', 'geo'));
    }

    public function download(Request $request, Media $media)
    {
        if ($media->file && Storage::disk('local')->exists($media->file)) {

            event(new DownloadFile($media));
            return response()->download(Storage::disk('local')->path($media->file));
        }

        return redirect()->back()->with('error', 'Something Error.');
    }

    public function destroy($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return back()->with('error', 'Something error.');
        }

        $media->delete();
        Media::DeleteFile($media->file);
        return Redirect::back()->with('success', "Media with title {$media->title} deleted successfully.");
    }
}
