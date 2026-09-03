<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function item() {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function submissions() {
        return $this->hasMany(Submissions::class, 'asset_id');
    }

    public function depreciations() {
        return $this->hasMany(Depreciations::class, 'asset_id');
    }
}