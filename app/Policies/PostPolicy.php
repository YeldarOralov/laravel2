<?php

namespace App\Policies;

use App\Models\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Carbon\Carbon;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Post $post)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Post $post)
    {
        $created = new Carbon($post->created_at);
        $now = Carbon::now();

        if($created->diff($now)->days < 1){
            return $user->id == $post->user_id;
        }
        return false;
    }

    public function delete(User $user, Post $post)
    {
        $created = new Carbon($post->created_at);
        $now = Carbon::now();

        if($created->diff($now)->days < 1){
            return $user->id == $post->user_id;
        }
        return false;
    }

}
