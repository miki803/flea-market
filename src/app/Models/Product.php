<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'condition',
        'category',
        'image',
        'brand',
        ];

        // 出品者
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // コメント
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
    // 購入履歴
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    // お気に入り
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    public function getIsSoldAttribute(): bool
    {
        return $this->purchases()->exists();
    }
}
