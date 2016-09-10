<?php
/**
 * Created by PhpStorm.
 * User: pepo123
 * Date: 9/9/16
 * Time: 1:16 PM
 */

namespace Ptrml\Polycomments;


use Illuminate\Support\Facades\Auth;

trait Commentable
{

    /**
     * Fetch all comments for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    function comments()
    {
        return $this->morphMany(Comment::class,'comment');
    }

    /**
     * Have the authenticated user comment on the model.
     *
     * @return void
     */
    function addComment($body)
    {
        $this->comments()->save(new Comment(["user_id"=> auth()->id(),"body"=>$body]));
    }

    /**
     * Determine if the model is commented on by the given user.
     *
     * @param  User $user
     * @return boolean
     */
    public function isCommentedOnBy(User $user)
    {
        return $this->comments()
            ->where('user_id', $user->id)
            ->exists();
    }




}