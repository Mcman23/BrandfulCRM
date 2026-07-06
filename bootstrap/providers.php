<?php
return [
    // Explicitly registered (not deferred) so third-party providers that
    // eagerly resolve the 'auth' binding during boot() - like
    // tymon/jwt-auth's LaravelServiceProvider - can find it.
    Illuminate\Auth\AuthServiceProvider::class,
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
];
