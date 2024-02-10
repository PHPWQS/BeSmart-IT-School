<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'video',
        'course_id'
    ];

    protected $casts = [
        'course_id' => 'integer'
    ];

    protected static function booted()
    {
        self::deleted(function (Lesson $lesson) {
            Storage::disk('public')->delete($lesson->video);
        });
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
