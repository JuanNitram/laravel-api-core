<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mediable;

class BaseModel extends Model
{
    use Mediable;

    protected $appends = ['medias', 'thumb'];

    protected $hidden = ['media'];

    public function getMediasAttribute()
    {
        $collection = collect($this->media)->groupBy('tag');

        foreach($collection as $key => $group){
            $aux = $group->groupBy('type');
            $collection[$key] = $aux;
        }

        return $collection;
    }

    public function getThumbAttribute()
    {
        return $this->media->where('type', 'thumb')->first();
    }
}
