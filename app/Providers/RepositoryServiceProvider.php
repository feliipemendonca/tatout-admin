<?php

namespace App\Providers;

use App\Repository\AvailabilityRepository;
use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\CompanyRepository;
use App\Repository\Interfaces\AvailabilityRepositoryInterface;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use App\Repository\Interfaces\ProductPriceRepositoryInterface;
use App\Repository\Interfaces\ProductRepositoryInterface;
use App\Repository\Interfaces\ReserveRepositoryInterface;
use App\Repository\Interfaces\RoleRepositoryInterface;
use App\Repository\Interfaces\TypeProductRepositoryInterface;
use App\Repository\PermissionRepository;
use App\Repository\ProductRepository;
use App\Repository\ReserveRepository;
use App\Repository\RoleRepository;
use App\Repository\TypeProductRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class, UserRepository::class
        );
        $this->app->bind(
            CompanyRepositoryInterface::class, CompanyRepository::class
        );
        $this->app->bind(
            TypeProductRepositoryInterface::class, TypeProductRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class, ProductRepository::class
        );

        $this->app->bind(
            ProductPriceRepositoryInterface::class, ProductRepository::class
        );

        $this->app->bind(
            AvailabilityRepositoryInterface::class, AvailabilityRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class, RoleRepository::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class, PermissionRepository::class
        );

        $this->app->bind(
            ReserveRepositoryInterface::class, ReserveRepository::class
        );
    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
