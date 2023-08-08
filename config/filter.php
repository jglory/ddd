<?php

return [
    'sensitive-information' => [
        \App\Domains\User\Dtos\User::class => ['password', 'rememberToken',],
    ],
];
