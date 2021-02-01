<?php

Breadcrumbs::for('admin.settings.index', function ($trail) {
    $trail->push(__('labels.backend.settings.management'), url('/admin/settings'));
});
