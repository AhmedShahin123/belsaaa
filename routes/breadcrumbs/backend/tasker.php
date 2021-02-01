<?php

Breadcrumbs::for('admin.tasker.index', function ($trail) {
    $trail->push(__('labels.backend.tasker.management'), route('admin.tasker.index'));
});

Breadcrumbs::for('admin.tasker.show', function ($trail, $id) {
    $trail->parent('admin.tasker.index');
    $trail->push(__('menus.backend.tasker.view'), route('admin.tasker.show', $id));
});

Breadcrumbs::for('admin.tasker.create', function ($trail) {
    $trail->parent('admin.tasker.index');
    $trail->push(__('menus.backend.tasker.create'), route('admin.tasker.create'));
});

Breadcrumbs::for('admin.tasker.edit', function ($trail, $id) {
    $trail->parent('admin.tasker.index');
    $trail->push(__('menus.backend.tasker.edit'), route('admin.tasker.edit', $id));
});
