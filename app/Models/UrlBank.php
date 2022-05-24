<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UrlBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'hash',
        'traffic',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    /**
     * @return string
     */
    public static function getUniqueHash ()
    {
        $hash = Str::lower(generateHash());
        if(static::whereHash($hash)->exists())
            return self::getUniqueHash();
        return $hash;
    }

    /**
     * @param string $url
     * @return null|\Illuminate\Support\Collection
     */
    public static function findByUrl ($url)
    {
        return static::select('hash','expired_at')
            ->whereUrl($url)
            ->first();
    }

    /**
     * @param string $hash
     * @return \Illuminate\Support\Collection
     */
    public static function findByHash ($hash)
    {
        $item = static::select('id','url','traffic','expired_at')
            ->whereHash($hash)
            ->firstOrFail();
        $item->update([
            'traffic' => ($item->traffic+1)
        ]);
        return $item;
    }
}
