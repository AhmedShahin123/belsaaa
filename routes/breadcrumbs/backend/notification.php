<?php

Breadcrumbs::for('admin.notification.index', function ($trail) {
    $trail->push(__('labels.backend.notification.management'), route('admin.notification.index'));
});

Breadcrumbs::for('admin.notification.show', function ($trail, $id) {
    $trail->parent('admin.notification.index');
    $trail->push(__('menus.backend.notification.view'), route('admin.notification.show', $id));
});
