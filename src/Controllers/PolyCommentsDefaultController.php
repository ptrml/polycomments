<?php

namespace ptrml\polycomments\Controllers;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Ptrml\Polycomments\Comment;
use Ptrml\Polycomments\Commenter;

class PolyCommentsDefaultController extends Controller
{
    function commentComment(Request $request,$id)
    {

        $comment = Comment::find($id);

        Commenter::comment($comment,$request);

        return redirect("home");
    }

    function deleteComment($id_comment)
    {

        $comment = Comment::find($id_comment);

        if($comment->isDeletable())
        {
            Commenter::delete($comment);
        }

        return redirect("home");
    }



}
