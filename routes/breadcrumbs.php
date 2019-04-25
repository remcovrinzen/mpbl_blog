<?php

// Index
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Home', route('index'));
});

// Index > Recensies
Breadcrumbs::for('recensies', function ($trail) {
    $trail->parent('index');
    $trail->push('Recensies', route('recensies'));
});
