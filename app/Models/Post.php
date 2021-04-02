<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'owner_id', 'main_page_id'];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function main_image() {
        return $this->hasOne(File::class, 'main_image_id');
    }
    public function tags() {
        return $this->hasMany(Tag::class, 'post_id');
    }
}
