<?php

namespace App\Http\Controllers;

use App\Models\UrlBank;
use Ariaieboy\LaravelSafeBrowsing\Facades\LaravelSafeBrowsing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ShortenerController extends Controller
{
    public function index ()
    {
        return view('welcome');
    }

    public function create (Request $request)
    {
        $request->validate([
            'url' => 'required|url|min:4|max:240'
        ]);

        try {
            $result = LaravelSafeBrowsing::isSafeUrl($request->post('url'), true);
            $result = is_string($result) ? 'The given url is '.Str::lower($result) : $result;
        } catch (\Exception $exception) {
            $result = $exception->getMessage();
        }

        if(!is_bool($result)) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'url' => [$result]
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $url = rtrim($request->post('url'), '/');
        $data = UrlBank::findByUrl($url);
        if(!$data) {
            $data = UrlBank::create([
                'url' => $url,
                'hash' => UrlBank::getUniqueHash()
            ]);
        }
        return response()->json([
            'message' => 'Shortener url has been created',
            'short_url' => route('short_url', ['hash' => $data->hash]),
            'original_url' => $url
        ]);
    }

    public function view ($hash)
    {
        $data = UrlBank::findByHash(Str::lower($hash));
        return redirect()->away($data->url);
    }
}
