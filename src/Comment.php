<?php

namespace Ptrml\Polycomments;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CommentableInterface
{
    use Commentable;

    protected $table = 'polycomments';
    public $timestamps = true;

    protected $fillable = ["user_id","body"];

    function comment()
    {
        return $this->morphTo();
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delete()
    {
        $this->body = "-";
        $this->user_id = null;
        $this->deleted = 1;

        $this->update();
    }

    public function remove()
    {

        $comments = $this->comments;

        foreach ($comments as $comment)
        {
            $comment->delete();
        }

        $this->delete();
    }

    public function isDeleted()
    {
        if($this instanceof Comment)
        {
            return ($this->deleted == true);
        }
        else
            return false;
    }

    public function isDeletable()
    {
        return ($this->user_id == $this->getLoggedInUserId() && !$this->isDeleted());
    }

    /**
     * @return string
     */
    function getCommentAuthor()
    {
        try
        {
            return ($this->user->name);
        }
        catch (\Exception $e)
        {
            return "Unknown";
        }
    }

    /**
     * @return int
     */
    function getCommentAuthorId()
    {
        return ($this->user_id);
    }

}
