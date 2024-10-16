<?php

namespace App\Observers;

class PostLikeObserver
{
    public function created(PostLike $postLike)
    {
        $postLike->post->increment('likes_count');
    }
    
    public function deleted(PostLike $postLike)
    {
        $postLike->post->decrement('likes_count');
    }
}
