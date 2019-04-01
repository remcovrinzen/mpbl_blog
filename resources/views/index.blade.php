@extends ('layouts.app')

@section('content')
    <div class="columns">
        @for ($i = 0; $i < 4; $i++) 
            <div class="column">
                <post-teaser></post-teaser>
            </div>
            @endfor 
    </div>
@endsection 