<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Categories::class);
    }

    public function assets() {
        return $this->hasMany(Assets::class);
    }
}
