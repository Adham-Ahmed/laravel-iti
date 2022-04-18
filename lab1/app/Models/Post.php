<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments() {
        return $this->morphMany(Comment::class, 'commentable')->withTrashed();
    }
    public function getHumanReadableDateAttribute(): string
    {
       return  Carbon::parse($this->created_at)->format('l jS \\of F Y h:i:s A');
    }

}
