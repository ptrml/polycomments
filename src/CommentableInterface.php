<?php
/**
 * Created by PhpStorm.
 * User: pepo123
 * Date: 9/9/16
 * Time: 1:09 PM
 */

namespace Ptrml\Polycomments;


interface CommentableInterface
{
    function addComment($body);
}