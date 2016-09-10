{!! Form::open(['route' => [$polycomments_route,$polycomments_subject->id]]) !!}
{!! Form::text('body',null,['class' => 'form-control']) !!}
{!! Form::submit('Add comment',['class' => 'btn btn-sm btn-default pull-right']) !!}
<div style="width:100%;clear:both"></div>
{!! Form::close() !!}
<hr>
@foreach($polycomments_subject->comments as $polycomment)
    @include('polycomments::polycomments_')
@endforeach