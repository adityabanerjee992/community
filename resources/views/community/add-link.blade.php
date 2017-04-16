@if(Auth::check())
<div class="col-md-4">
	<h3>Contribute a Link</h3>

	<div class="panel panel-default">
		<div class="panel-body">
			<form action="/community" method="POST">
			    {{ csrf_field() }}

			    <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : ''}}">
					<label for="channel">Channel</label>
					<select class="form-control" name="channel_id">
					<option selected disabled>Pick a channel....</option>
					@foreach($channels as $channel)
						<option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>
							{{ $channel->title }}
						</option>
					@endforeach
					</select>
					{!! $errors->first('channel_id', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="What is the title of your article ?">
					{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
					<label for="link">Link</label>
					<input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="What is the URL to your article ?">
					{!! $errors->first('link', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Contribute Link</button>
				</div>
			</form>
		</div>
	</div>
	
</div>
@else
please sign in....
@endif