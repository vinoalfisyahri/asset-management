<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function item() {
        return $this->belongsTo(Items::class);
    }

    public function submissions() {
        return $this->hasMany(Submissions::class);
    }

    public function depreciations() {
        return $this->hasMany(Depreciations::class);
    }
}
