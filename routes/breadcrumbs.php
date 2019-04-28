<?php

// Index
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Home', route('index'));
});

// Index > Posts
Breadcrumbs::for('posts', function ($trail) {
    $trail->parent('index');
    $trail->push('Posts', route('posts'));
});
