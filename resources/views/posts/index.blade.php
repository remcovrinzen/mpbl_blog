@extends ('layouts.app')

@section('content')

{{ Breadcrumbs::render('posts') }}

<div class="columns">
    <div class="column is-one-quarter">
        <post-filter :post-categories='@json($postCategories)'></post-filter>
    </div>

    <div class="column is-three-quarters">
        <div class="level">
            <!-- Left side -->
            <div class="level-left">
                <div class="level-item">
                    <p class="subtitle is-5">
                        <h1 class="title m-b-md">
                            Posts
                        </h1>
                    </p>
                </div>
            </div>

            <!-- Right side -->
            <div class="level-right">
                <p class="level-item"><strong>{{ $numberOfPosts }}</strong>&nbsp; resultaten</p>
                <p class="level-item">
                    Sorteren op: &nbsp;
                    <post-sort></post-sort>
                </p>
            </div>
        </div>
        <post-list :posts='@json($pagerPosts->items())'></post-list>
        {{ $pagerPosts->links()}}
    </div>
</div>
@endsection