<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution',
        'description',
        'requirements',
        'open_date',
        'close_date',
        'application_link',
        'type',
        'category',
        'quota',
    ];

    protected $casts = [
        'open_date' => 'datetime',
        'close_date' => 'datetime',
    ];

    public function isActive(): bool
    {
        return today()->between($this->open_date, $this->close_date);
    }

    public function daysUntilClose(): int
    {
        return today()->diffInDays($this->close_date, false);
    }

    public function savedBy()
    {
        return $this->hasMany(SavedScholarship::class);
    }
}

