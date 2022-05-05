<?php

namespace ConsulConfigManager\Consul\ACL\Providers;

use Illuminate\Support\Facades\Route;
use ConsulConfigManager\Consul\ACL\Http;
use ConsulConfigManager\Consul\ACL\Commands;
use ConsulConfigManager\Consul\ACL\UseCases;
use ConsulConfigManager\Consul\ACL\Interfaces;
use ConsulConfigManager\Consul\ACL\Presenters;
use ConsulConfigManager\Consul\ACL\Projectors;
use Spatie\EventSourcing\Facades\Projectionist;
use ConsulConfigManager\Consul\ACL\Repositories;
use ConsulConfigManager\Consul\ACL\ConsulACLDomain;
use ConsulConfigManager\Domain\DomainServiceProvider;
use ConsulConfigManager\Consul\ACL\Services\AccessControlListService;

/**
 * Class ConsulACLServiceProvider
 * @package ConsulConfigManager\Consul\ACL\Providers
 */
class ConsulACLServiceProvider extends DomainServiceProvider
{
    /**
     * List of commands provided by package
     * @var array
     */
    protected array $packageCommands = [
        Commands\PolicySync::class,
        Commands\RoleSync::class,
    ];

    /**
     * List of repositories provided by package
     * @var array
     */
    protected array $packageRepositories = [
        Interfaces\PolicyRepositoryInterface::class     =>  Repositories\PolicyRepository::class,
        Interfaces\RoleRepositoryInterface::class       =>  Repositories\RoleRepository::class,
        Interfaces\TokenRepositoryInterface::class      =>  Repositories\TokenRepository::class,
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->registerConfiguration();
        parent::register();
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->offerPublishing();
        $this->registerMigrations();
        $this->registerCommands();
        parent::boot();
    }


    /**
     * Register package configuration
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'consul.acl'
        );
    }

    /**
     * Register package migrations
     * @return void
     */
    protected function registerMigrations(): void
    {
        if (ConsulACLDomain::shouldRunMigrations()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    /**
     * Register package routes
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (ConsulACLDomain::shouldRegisterRoutes()) {
            Route::prefix(config('consul.acl.prefix'))
                ->middleware(config('consul.acl.middleware'))
                ->group(function (): void {
                    $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
                });
        }
    }

    /**
     * Register package commands
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->packageCommands);
        }
    }

    /**
     * Offer resources for publishing
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php'        =>  config_path('consul/acl.php'),
            ], ['ccm-consul-acl-configuration', 'ccm-consul-acl']);
            $this->publishes([
                __DIR__ . '/../../database/migrations'      =>  database_path('migrations'),
            ], ['ccm-consul-acl-migrations', 'ccm-consul-acl']);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerFactories(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function registerRepositories(): void
    {
        foreach ($this->packageRepositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerInterceptors(): void
    {
        $this->registerPolicyInterceptors();
        $this->registerRoleInterceptors();
        $this->registerTokenInterceptors();
    }

    private function registerPolicyInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Policy\List\PolicyListInputPort::class,
            UseCases\Policy\List\PolicyListInteractor::class,
            Http\Controllers\Policy\PolicyListController::class,
            Presenters\Policy\PolicyListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Policy\Get\PolicyGetInputPort::class,
            UseCases\Policy\Get\PolicyGetInteractor::class,
            Http\Controllers\Policy\PolicyGetController::class,
            Presenters\Policy\PolicyGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Policy\Create\PolicyCreateInputPort::class,
            UseCases\Policy\Create\PolicyCreateInteractor::class,
            Http\Controllers\Policy\PolicyCreateController::class,
            Presenters\Policy\PolicyCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Policy\Update\PolicyUpdateInputPort::class,
            UseCases\Policy\Update\PolicyUpdateInteractor::class,
            Http\Controllers\Policy\PolicyUpdateController::class,
            Presenters\Policy\PolicyUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Policy\Delete\PolicyDeleteInputPort::class,
            UseCases\Policy\Delete\PolicyDeleteInteractor::class,
            Http\Controllers\Policy\PolicyDeleteController::class,
            Presenters\Policy\PolicyDeleteHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Policy\Autocomplete\PolicyAutocompleteInputPort::class,
            UseCases\Policy\Autocomplete\PolicyAutocompleteInteractor::class,
            Http\Controllers\Policy\PolicyAutocompleteController::class,
            Presenters\Policy\PolicyAutocompleteHttpPresenter::class,
        );
    }

    private function registerRoleInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Role\List\RoleListInputPort::class,
            UseCases\Role\List\RoleListInteractor::class,
            Http\Controllers\Role\RoleListController::class,
            Presenters\Role\RoleListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Get\RoleGetInputPort::class,
            UseCases\Role\Get\RoleGetInteractor::class,
            Http\Controllers\Role\RoleGetController::class,
            Presenters\Role\RoleGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Create\RoleCreateInputPort::class,
            UseCases\Role\Create\RoleCreateInteractor::class,
            Http\Controllers\Role\RoleCreateController::class,
            Presenters\Role\RoleCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Update\RoleUpdateInputPort::class,
            UseCases\Role\Update\RoleUpdateInteractor::class,
            Http\Controllers\Role\RoleUpdateController::class,
            Presenters\Role\RoleUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Delete\RoleDeleteInputPort::class,
            UseCases\Role\Delete\RoleDeleteInteractor::class,
            Http\Controllers\Role\RoleDeleteController::class,
            Presenters\Role\RoleDeleteHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Role\Autocomplete\RoleAutocompleteInputPort::class,
            UseCases\Role\Autocomplete\RoleAutocompleteInteractor::class,
            Http\Controllers\Role\RoleAutocompleteController::class,
            Presenters\Role\RoleAutocompleteHttpPresenter::class,
        );
    }

    private function registerTokenInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\Token\List\TokenListInputPort::class,
            UseCases\Token\List\TokenListInteractor::class,
            Http\Controllers\Token\TokenListController::class,
            Presenters\Token\TokenListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Token\Get\TokenGetInputPort::class,
            UseCases\Token\Get\TokenGetInteractor::class,
            Http\Controllers\Token\TokenGetController::class,
            Presenters\Token\TokenGetHttpPresenter::class,
        );


        $this->registerInterceptorFromParameters(
            UseCases\Token\Create\TokenCreateInputPort::class,
            UseCases\Token\Create\TokenCreateInteractor::class,
            Http\Controllers\Token\TokenCreateController::class,
            Presenters\Token\TokenCreateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Token\Update\TokenUpdateInputPort::class,
            UseCases\Token\Update\TokenUpdateInteractor::class,
            Http\Controllers\Token\TokenUpdateController::class,
            Presenters\Token\TokenUpdateHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\Token\Delete\TokenDeleteInputPort::class,
            UseCases\Token\Delete\TokenDeleteInteractor::class,
            Http\Controllers\Token\TokenDeleteController::class,
            Presenters\Token\TokenDeleteHttpPresenter::class,
        );
    }

    /**
     * @inheritDoc
     */
    protected function registerServices(): void
    {
        $this->app->bind(Interfaces\AccessControlListServiceInterface::class, AccessControlListService::class);
    }

    /**
     * @inheritDoc
     */
    protected function registerReactors(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function registerProjectors(): void
    {
        Projectionist::addProjectors([
            Projectors\PolicyProjector::class,
            Projectors\RoleProjector::class,
            Projectors\TokenProjector::class,
        ]);
    }
}
