<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['user', 'category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['user'] ?? false, function ($query, $user) {
            $query->whereHas('user', function ($query) use ($user) {
                $query->where('username', $user);
            });
        });
    }

    public function scopePersonalFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
    }

    public function scopePostFilterCategory($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });
    }

    public function scopeExploreFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            })
            ->where('visibility', 'Public');
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
