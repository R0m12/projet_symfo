<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMmx720c\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMmx720c/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerMmx720c.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerMmx720c\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerMmx720c\App_KernelDevDebugContainer([
    'container.build_hash' => 'Mmx720c',
    'container.build_id' => 'af609c00',
    'container.build_time' => 1675082359,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMmx720c');
