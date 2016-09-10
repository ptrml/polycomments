<?php
/**
 * Created by PhpStorm.
 * User: pepo123
 * Date: 9/9/16
 * Time: 5:56 PM
 */

namespace Ptrml\Polycomments;


use Illuminate\Http\Request;

class Commenter
{
    public static function comment(CommentableInterface $commentable,Request $request)
    {
        $commentable->addComment($request->input("body"));

        return $commentable;
    }

    public static function delete(Comment $commentable)
    {
        $commentable->delete();

        return $commentable;
    }
}