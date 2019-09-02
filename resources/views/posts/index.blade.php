@extends ('layouts.app')

@section('content')
<section class="container">
    <h1 class="title m-b-md">
        Posts
    </h1>
</section>

<post-list :posts='@json($posts)'></post-list>
@endsection