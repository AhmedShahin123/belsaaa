<?php

Breadcrumbs::for('admin.city.index', function ($trail) {
    $trail->push(__('labels.backend.city.management'), route('admin.city.index'));
});

Breadcrumbs::for('admin.city.show', function ($trail, $id) {
    $trail->parent('admin.city.index');
    $trail->push(__('menus.backend.city.view'), route('admin.city.show', $id));
});

Breadcrumbs::for('admin.city.edit', function ($trail, $id) {
    $trail->parent('admin.city.index');
    $trail->push(__('menus.backend.city.edit'), route('admin.city.edit', $id));
});
