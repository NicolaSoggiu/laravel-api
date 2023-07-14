<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger {
    public static function slugger($string) { 

        $baseSlug = Str::slug($string); 
        $i = 1;

        $slug = $baseSlug;
        while (self::where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++; // 2
        }
        
        return $slug;
    }
}