<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Collaboration extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }


}
