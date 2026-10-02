<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    protected $fillable = [ 
        'category_id',
        'code',
        'title',
        'description',
        'location',
        'capacity',
        'activity_date',
        'start_at',
        'end_at',
        'status',
    ]; 
 
    protected function casts(): array 
    { 
        return [ 
            'activity_date' => 'date', 
            'start_at'      => 'datetime',
            'end_at'        => 'datetime',
        ]; 
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
