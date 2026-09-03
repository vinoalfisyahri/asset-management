<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'submissions';
    public function asset() {
        return $this->belongsTo(Assets::class);
    }
}
