@extends('layout')
@section('title','| Edit Blog Post')

@section('content')

	<div class="container">
		{!!Form::model($post, ['route' => ['posts.update', $post->id],'method'=>'PUT'])!!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:', ["class"=>'form-spacing-top'])}}
			{{ Form::text('title',null,["class"=>'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', ["class"=>'form-spacing-top'])}}
			{{ Form::text('slug',null,["class"=>'form-control']) }}

			{{ Form::label('category_id', 'Category:', ["class"=>'form-spacing-top'])}}
			{{ Form::select('category_id',$categories,null,["class"=>'form-control'] ) }}

			{{Form::label('tag','Tags:', array('class'=>'form-spacing-top'))}}
			<br>
			<select class="form-control js-example-basic-multiple" multiple="multiple" name="tags[]">
				@foreach($tags as $tag)
					<option value="{{$tag->id}}">{{ $tag->name }}</option>
				@endforeach
			</select>

			{{ Form::label('body', 'Body:', ["class"=>'form-spacing-top'])}}
			{{ Form::textarea('body',null,["class"=>'form-control']) }}
		</div>
		<div class=col-md-4>
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia',strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
					{!! Html::linkRoute('posts.show','Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
					{{Form::submit('Save Changes', ['class'=>'btn btn-success btn-block'])}}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	<script type="text/javascript">
        $(".js-example-basic-multiple").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
	</script>
@endsection

