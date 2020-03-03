<?php

//Маршрутизация
return [
    
    '~^accounts/(\d+)$~' => [\Account\Controllers\AccountController::class, 'view'],
    '~^accounts/(\d+)/edit$~' => [\Account\Controllers\AccountController::class, 'edit'],
    '~^accounts/(\d+)/delete$~' => [\Account\Controllers\AccountController::class, 'delete'],
    '~^accounts/add$~' => [\Account\Controllers\AccountController::class, 'add'],
    '~^accounts/create$~' => [\Account\Controllers\AccountController::class, 'create'],
    '~^$~' => [\Account\Controllers\MainController::class, 'main'],
];