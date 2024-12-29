<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'lat',
        'lon',
    ];

    /**
     * Get the user that owns the location.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}