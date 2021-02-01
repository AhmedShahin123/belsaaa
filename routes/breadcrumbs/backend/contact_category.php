<?php

Breadcrumbs::for('admin.contact_category.index', function ($trail) {
    $trail->push(__('labels.backend.contact_category.management'), route('admin.contact_category.index'));
});

Breadcrumbs::for('admin.contact_category.show', function ($trail, $id) {
    $trail->parent('admin.contact_category.index');
    $trail->push(__('menus.backend.contact_category.view'), route('admin.contact_category.show', $id));
});

Breadcrumbs::for('admin.contact_category.edit', function ($trail, $id) {
    $trail->parent('admin.contact_category.index');
    $trail->push(__('menus.backend.contact_category.edit'), route('admin.contact_category.edit', $id));
});
