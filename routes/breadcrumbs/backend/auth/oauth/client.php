<?php

Breadcrumbs::for('admin.client.index', function ($trail) {
    $trail->push(__('labels.backend.client.management'), route('admin.client.index'));
});

Breadcrumbs::for('admin.client.show', function ($trail, $id) {
    $trail->parent('admin.client.index');
    $trail->push(__('menus.backend.client.view'), route('admin.client.show', $id));
});
