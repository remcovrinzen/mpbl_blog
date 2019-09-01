@extends ('layouts.app')

@section('content')
    {{ Breadcrumbs::render('posts') }}

    <post-list :posts='@json($posts)'></post-list>
@endsection
