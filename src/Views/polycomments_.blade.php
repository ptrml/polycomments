

<div style="margin-left:10px;margin-right:-3px;margin-top:-3px;border-style: solid; padding: 20px;">
    @if($polycomment->isDeletable())
        {!! Form::open(['route' => ['polycomments.delete',$polycomment->id],'method' => 'DELETE']) !!}
        {!! Form::submit('x',['class' => 'btn btn-xs btn-danger pull-right']) !!}
        {!! Form::close() !!}
    @endif
    {{$polycomment->getCommentAuthor()}}
    {{$polycomment->body}}
    <hr>
    {!! Form::open(['route' => ['polycomments.comment',$polycomment->id]]) !!}
        {!! Form::text('body',null,['class' => 'form-control']) !!}
        {!! Form::submit('Add comment',['class' => 'btn btn-sm btn-default pull-right']) !!}
        <div style="width:100%;clear:both"></div>
    {!! Form::close() !!}


    {{--We need this under the form because this changes $comment--}}
    @foreach($polycomment->comments as $polycomment)
        @include('polycomments::polycomments_')
    @endforeach
</div>

