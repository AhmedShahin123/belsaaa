<?php

Breadcrumbs::for('admin.employer.index', function ($trail) {
    $trail->push(__('labels.backend.employer.management'), route('admin.employer.index'));
});

Breadcrumbs::for('admin.employer.show', function ($trail, $id) {
    $trail->parent('admin.employer.index');
    $trail->push(__('menus.backend.employer.view'), route('admin.employer.show', $id));
});

Breadcrumbs::for('admin.employer.create', function ($trail) {
    $trail->parent('admin.employer.index');
    $trail->push(__('menus.backend.employer.create'), route('admin.employer.create'));
});

Breadcrumbs::for('admin.employer.edit', function ($trail, $id) {
    $trail->parent('admin.employer.index');
    $trail->push(__('menus.backend.employer.edit'), route('admin.employer.edit', $id));
});
