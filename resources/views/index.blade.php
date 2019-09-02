@extends ('layouts.app')

@section('content')
    <div class="columns">
        @foreach ($posts as $post) 
            <div class="column">
                <post-teaser :post='@json($post)'></post-teaser>
            </div>
        @endforeach
    </div>
@endsection 