<?php
/**
 * Created by PhpStorm.
 * User: pepo123
 * Date: 9/9/16
 * Time: 1:16 PM
 */

namespace Ptrml\Polycomments;


use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

trait Commentable
{

    /**
     * Fetch all comments for the instance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    function comments()
    {
        return $this->morphMany(Comment::class,'comment');
    }

    /**
     * Boot the soft taggable trait for a model.
     *
     * @return void
     */
    public static function bootCommentable()
    {
        if(static::removeCommentsOnDelete()) {
            static::deleting(function($model) {
                $model->removeComments();
            });
        }
    }

    /**
     * Fetch records that are commented by a given user.
     * Post::whereCommentedOnBy($user_id)->get();
     */
    public function scopeWhereCommentedOnBy($query,$user_id=null)
    {
        if(is_null($user_id)) {
            $user_id = $this->getLoggedInUserId();
        }

        return $query->whereHas('comments', function($q) use($user_id) {
            $q->where('user_id', '=', $user_id);
        });
    }


    /**
     * Remove linked comments when deleted
     * @return bool
     */
    public static function removeCommentsOnDelete()
    {
        return true;
    }

    /**
     * Have the authenticated user comment on the model.
     *
     * @return void
     */
    function addComment($body,$user_id = null)
    {
        if(is_null($user_id))
        {
            $user_id = $this->getLoggedInUserId();
        }

        $this->comments()->save(new Comment(["user_id"=> $user_id,"body"=>$body]));
    }


    /**
     * Determine if the model is commented on by the given user.
     *
     * @param $user_id
     * @return mixed
     */
    public function isCommentedOnBy($user_id)
    {
        return $this->comments()
            ->where('user_id', $user_id)
            ->exists();
    }


    /**
     *Actually removes comments from current model (from db)
     */
    public function removeComments()
    {
        $comments = $this->comments();

        foreach ($comments as $comment)
        {
            $comment->remove();
        }

    }

    /**
     * Fetch the logged in user id
     * @return integer
     */
    public function getLoggedInUserId()
    {
        return auth()->id();
    }




}