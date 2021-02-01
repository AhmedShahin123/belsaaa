<?php

Breadcrumbs::for('admin.token.index', function ($trail) {
    $trail->push(__('labels.backend.token.management'), route('admin.token.index'));
});

Breadcrumbs::for('admin.token.show', function ($trail, $id) {
    $trail->parent('admin.token.index');
    $trail->push(__('menus.backend.token.view'), route('admin.token.show', $id));
});
