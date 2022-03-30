<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function isLastWeek()
    {
        return $this->is(Week::orderBy('id', 'desc')->first());
    }
}
