<?php

namespace App\Services;

use App\Models\Option;
use App\Models\ShorterLink;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;

class ShortLinkService
{
    public function store($request)
    {
        DB::beginTransaction();
        $link = new ShorterLink;
        $link->long_link = $request->long_link;
        $link->key = $this->linkKey();
        $link->save();
        DB::commit();
        return $link;
    }

    public function linkKey()
    {
        $option = Option::where('key', 'short_link_last_id')->first();
        $hashids = new Hashids('shorter link secret', 9);
        $key = $hashids->encode($option->value);
        $option->value += 1;
        $option->save();
        return $key;
    }
}
