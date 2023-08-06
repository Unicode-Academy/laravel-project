<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    private $middlewares = [

    ];

    private $commands = [

    ];

    public function bindingRepository()
    {
        //User Repository
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        //Categories Repository
        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class
        );

        //Courses Repository
        $this->app->singleton(
            CoursesRepositoryInterface::class,
            CoursesRepository::class
        );

        //Teacher Repository
        $this->app->singleton(
            TeacherRepositoryInterface::class,
            TeacherRepository::class
        );
    }

    public function boot()
    {
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerModule($module);
            }
        }
    }

    public function register()
    {
        //Configs
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
            }
        }

        //Middleware
        $this->registerMiddlewares();

        //Commands
        $this->commands($this->commands);

        //Repository
        $this->bindingRepository();
    }

    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    //registerModule
    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/{$module}";

        //Khai báo Routes

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'web'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/web.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/web.php');
            }
        });

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'api', 'prefix' => 'api'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/api.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/api.php');
            }
        });

        //Khai báo migrations
        if (File::exists($modulePath . '/migrations')) {
            $this->loadMigrationsFrom($modulePath . '/migrations');
        }

        //Khai báo languages
        if (File::exists($modulePath . '/resources/lang')) {
            $this->loadTranslationsFrom($modulePath . '/resources/lang', strtolower($module));

            $this->loadJSONTranslationsFrom($modulePath . '/resources/lang');
        }

        //Khai báo views
        if (File::exists($modulePath . '/resources/views')) {
            $this->loadViewsFrom($modulePath . '/resources/views', strtolower($module));
        }

        //Khai báo helpers
        if (File::exists($modulePath . '/helpers')) {
            $helperList = File::allFiles($modulePath . '/helpers');
            if (!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathName();
                    require $file;
                }
            }
        }
    }

    //register configs
    private function registerConfig($module)
    {
        $configPath = __DIR__ . '/' . $module . '/configs';

        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles($configPath));

            foreach ($configFiles as $config) {
                $alias = basename($config, '.php');

                $this->mergeConfigFrom($configPath . '/' . $config, $alias);
            }
        }
    }

    //register middlewares
    private function registerMiddlewares()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}
