<?php

use Illuminate\Support\Facades\Route;

Route::prefix('acl')->group(static function (): void {
    Route::prefix('policies')->group(static function (): void {
        Route::get('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyListController::class)
            ->name('domain.consul.acl.policies.list');

        Route::get('autocomplete', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyAutocompleteController::class)
            ->name('domain.consul.acl.policies.autocomplete');

        Route::post('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyCreateController::class)
            ->name('domain.consul.acl.policies.create');

        Route::get('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyGetController::class)
            ->name('domain.consul.acl.policies.get');

        Route::patch('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyUpdateController::class)
            ->name('domain.consul.acl.policies.update');

        Route::delete('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Policy\PolicyDeleteController::class)
            ->name('domain.consul.acl.policies.delete');
    });

    Route::prefix('roles')->group(static function (): void {
        Route::get('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleListController::class)
            ->name('domain.consul.acl.roles.list');

        Route::get('autocomplete', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleAutocompleteController::class)
            ->name('domain.consul.acl.roles.autocomplete');

        Route::post('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleCreateController::class)
            ->name('domain.consul.acl.roles.create');

        Route::get('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleGetController::class)
            ->name('domain.consul.acl.roles.get');

        Route::patch('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleUpdateController::class)
            ->name('domain.consul.acl.roles.update');

        Route::delete('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Role\RoleDeleteController::class)
            ->name('domain.consul.acl.roles.delete');
    });

    Route::prefix('tokens')->group(static function (): void {
        Route::get('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Token\TokenListController::class)
            ->name('domain.consul.acl.tokens.list');

        Route::post('', \ConsulConfigManager\Consul\ACL\Http\Controllers\Token\TokenCreateController::class)
            ->name('domain.consul.acl.tokens.create');

        Route::get('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Token\TokenGetController::class)
            ->name('domain.consul.acl.tokens.get');

        Route::patch('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Token\TokenUpdateController::class)
            ->name('domain.consul.acl.tokens.update');

        Route::delete('{accessor}', \ConsulConfigManager\Consul\ACL\Http\Controllers\Token\TokenDeleteController::class)
            ->name('domain.consul.acl.tokens.delete');
    });
});
