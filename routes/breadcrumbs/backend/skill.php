<?php

Breadcrumbs::for('admin.skill.index', function ($trail) {
    $trail->push(__('labels.backend.skill.management'), route('admin.skill.index'));
});

Breadcrumbs::for('admin.skill.show', function ($trail, $id) {
    $trail->parent('admin.skill.index');
    $trail->push(__('menus.backend.skill.view'), route('admin.skill.show', $id));
});

Breadcrumbs::for('admin.skill.edit', function ($trail, $id) {
    $trail->parent('admin.skill.index');
    $trail->push(__('menus.backend.skill.edit'), route('admin.skill.edit', $id));
});
