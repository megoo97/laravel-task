<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'description', 'releaseDate', 'rate','agencie_id'
    ];

    public function agencie()
    {
        return $this->belongsTo('App\Agencie');
    }


}
