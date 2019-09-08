@extends ('layouts.app')

@section('content')

{{ Breadcrumbs::render('posts') }}

<div class="columns">
    <div class="column is-one-quarter">
        <post-filter :post-categories='@json($postCategories)'></post-filter>
    </div>

    <div class="column is-three-quarters">
        <section class="container">
            <h1 class="title m-b-md">
                Posts
            </h1>
        </section>

        <post-list :posts='@json($posts)'></post-list>
    </div>
</div>
@endsection