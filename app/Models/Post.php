<?php

namespace App\Models;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','media_type','media_path','content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes()
{
    return $this->hasMany(Like::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}
 public function originalPost()
{
    return $this->belongsTo(Post::class, 'shared_post_id');
}

public function extractHashtags(): array
    {
        $text = $this->content ?? '';
        preg_match_all('/#([\pL\pN_]+)\b/u', $text, $matches);
      
        return $matches[1] ?? [];
    }
public function tags()
{
    return $this->belongsToMany(Tag::class);
}



}
