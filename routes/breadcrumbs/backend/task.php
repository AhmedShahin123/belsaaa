<?php

Breadcrumbs::for('admin.task.index', function ($trail) {
    $trail->push(__('labels.backend.task.management'), route('admin.task.index'));
});

Breadcrumbs::for('admin.task.show', function ($trail, $id) {
    $trail->parent('admin.task.index');
    $trail->push(__('menus.backend.task.view'), route('admin.task.show', $id));
});

Breadcrumbs::for('admin.task.edit', function ($trail, $id) {
    $trail->parent('admin.task.index');
    $trail->push(__('menus.backend.task.edit'), route('admin.task.edit', $id));
});

Breadcrumbs::for('admin.task.create', function ($trail) {
    $trail->parent('admin.task.index');
    $trail->push(__('menus.backend.task.create'), route('admin.task.create'));
});
