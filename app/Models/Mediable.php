<?php

namespace App\Models;

use Plank\Mediable\Mediable as BaseMediable;
use Illuminate\Database\Eloquent\Builder;

trait Mediable
{
   use BaseMediable;

   public function media()
   {
       return $this->morphToMany(config('mediable.model'), 'mediable')
           ->withPivot('tag', 'order')
           ->orderBy('order');
   }

}
