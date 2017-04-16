<ul class="list-group">
	@if(count($links))
		@foreach($links as $link)
			<li class="list-group-item CommunityLink">
				<form method="POST" action="/vote/{{ $link->id }}">
					{{ csrf_field() }}
					<button class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-default' }}">
						{{ $link->votes->count() }}
					</button>
				</form>

				<a href="community/{{ $link->channel->slug }}" class="label label-default" style="background-color:{{ $link->channel->color }}">
					{{ $link->channel->title }}
				</a>
				<a href="{{ $link->link }}" target="_blank">
					{{ $link->title }}
				</a>
				<small>
					contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}
				</small>
			</li>
		@endforeach
	@else
		<li class="links__link">No Contributions yet.</li>
	@endif
</ul>
{{ $links->links() }}