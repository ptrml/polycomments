<?php

namespace Ptrml\Polycomments;

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

    public function delete()
    {
        /*
        $comments = $this->comments;

        foreach ($comments as $comment)
        {
            $comment->delete();
        }

        $this->delete();
        */

        $this->body = "-";
        $this->deleted = 1;

        $this->update();
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
        return ($this->user_id == auth()->id() && !$this->isDeleted());
    }

    /**
     * @return string
     */
    function getCommentAuthor()
    {
        try
        {
            return ($this->user);
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
