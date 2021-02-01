<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
require __DIR__.'/task.php';
require __DIR__.'/employer.php';
require __DIR__.'/tasker.php';
require __DIR__.'/city.php';
require __DIR__.'/skill.php';
require __DIR__.'/notification.php';
require __DIR__.'/settings.php';
require __DIR__.'/contact_category.php';
