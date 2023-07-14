<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}