<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Plank\Mediable\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $table = 'media';

    protected $appends = ['full_url', 'tag', 'type'];

    protected $hidden = ['directory', 'disk', 'mime_type', 'aggregate_type', 'pivot'];

    public function getFullUrlAttribute()
    {
        return $this->getUrl();
    }

    public function getTagAttribute()
    {
        return $this->pivot->tag;
    }

    public function getTypeAttribute()
    {
        $type = Arr::last(explode('-',$this->filename));
        if(is_numeric($type)){
            $ex = explode('-',$this->filename);
            array_pop($ex);
            return Arr::last($ex);
        }
        return $type;
    }
}
