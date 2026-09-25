<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     protected $fillable = [ 
        'title', 
        'description', 
        'activity_date', 
        'category', 
        'status', 
    ]; 
 
    protected function casts(): array 
    { 
        return [ 
            'activity_date' => 'date', 
        ]; 
    }

    // Local scope untuk filter status
    public function scopeOfStatus(Builder $query, ?string $status): Builder
    {
        $valid = ['Planned', 'Ongoing', 'Done'];

        return $query->when(
            in_array($status, $valid),
            fn($q) => $q->where('status', $status)
        );
    }

    // Local scope untuk filter kategori
    public function scopeOfCategory(Builder $query, ?string $category): Builder
    {
        $valid = ['Workshop', 'Seminar', 'Praktikum'];

        return $query->when(
            in_array($category, $valid),
            fn($q) => $q->where('category', $category)
        );
    }
}
