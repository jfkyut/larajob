<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected function scopeFilter($query, array $filters) {

        if($filters['tag'] ?? false) {

            $query->where('tags', 'like', '%' . $filters['tag'] . '%');

        }

        if($filters['search'] ?? false) {

            $query
            ->where('title', 'like', '%' . $filters['search'] . '%')
            ->orWhere('description', 'like', '%' . $filters['search'] . '%')
            ->orWhere('tags', 'like', '%' . $filters['search'] . '%')
            ->orWhere('company', 'like', '%' . $filters['search'] . '%')
            ->orWhere('location', 'like', '%' . $filters['search'] . '%');
        }
    }

    protected $fillable = [
        'company',
        'title',
        'tags',
        'email',
        'location',
        'logo',
        'website',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
