<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Agencie extends Model
{
    protected $fillable = [
        'name', 'about', 'link'
    ];

    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function latest_news()
    {
        return $this->news->where('created_at','>=', Carbon::today());
    }
}
