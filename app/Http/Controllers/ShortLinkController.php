<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkRequest;
use App\Models\ShorterLink;
use Illuminate\Http\Request;
use App\Services\ShortLinkService;

class ShortLinkController extends Controller
{
    public function store(ShortLinkRequest $request, ShortLinkService $shortLinkService)
    {
        $link = $shortLinkService->store($request);
        return response()->json($link, 200);
    }

    public function redirectToLink($key)
    {
        $link = ShorterLink::findOrFail($key);
        return redirect()->to($link->long_link);
    }
}
