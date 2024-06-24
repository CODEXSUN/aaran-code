<?php

namespace Aaran\Sundar\Models\Share;

use Aaran\Sundar\Database\factories\ShareTradesFactory;
use Illuminate\Database\Eloquent\Model;

class StockName extends Model
{

    protected $guarded=[];
    public $timestamps = false;

    protected static function newFactory(): ShareTradesFactory
    {
        return new ShareTradesFactory();
    }
    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }
}
