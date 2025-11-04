<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Repositories\RepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ArticleRepository;
use App\Models\Product;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register repositories
        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository(new Product());
        });

        $this->app->bind(ArticleRepository::class, function ($app) {
            return new ArticleRepository(new Article());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define Gates for authorization
        // Since role-based access is already handled by middleware,
        // these Gates check if the user has the appropriate roles
        
        // Helper function to check if user has any of the given roles
        $hasAnyRole = function ($user, array $roles) {
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return true;
                }
            }
            return false;
        };

        // Product permissions
        Gate::define('view products', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('create products', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('edit products', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('delete products', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });

        // Article permissions
        Gate::define('view articles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin', 'Marketing']);
        });
        
        Gate::define('create articles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin', 'Marketing']);
        });
        
        Gate::define('edit articles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin', 'Marketing']);
        });
        
        Gate::define('delete articles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin', 'Marketing']);
        });

        // User permissions
        Gate::define('view users', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('create users', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('edit users', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('delete users', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });

        // Role permissions
        Gate::define('view roles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('create roles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('edit roles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('delete roles', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });

        // Chatbot permissions
        Gate::define('view chatbot', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('create chatbot', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('edit chatbot', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('delete chatbot', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });

        // Contact permissions
        Gate::define('view contacts', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('edit contacts', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
        
        Gate::define('delete contacts', function ($user) use ($hasAnyRole) {
            return $hasAnyRole($user, ['Super Admin', 'Admin']);
        });
    }
}
