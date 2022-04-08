<?php

namespace PengGuangSheng\LaravelWechat;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WeChatServiceProvider extends ServiceProvider
{
    protected $routeMiddleware = [
        'swechat.check' => \PengGuangSheng\LaravelWechat\Http\Middleware\SWeChatCheck::class
    ];
    protected $middlewareGroups = [];
    protected $commands = [
        Console\Commands\ControllerMakeCommand::class

    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/swechat.php', 'swechat');
        // 服务提供者加载中间件
        $this->registerRouteMiddleware();
        $this->registerPublishing();
    }

    public function boot()
    {
        // 服务提供者注册路由
        $this->registerRoutes();
        // 服务提供者注册试图
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'swechat');

        // 发布命令
        $this->commands($this->commands);
    }

    protected function registerPublishing()
    {
        // php artisan vendor:publish --provider="PengGuangSheng\LaravelWechat\Providers\WeChatServiceProvider"
        if ($this->app->runningInConsole()) {
            // 可以发布配置文件到指定目录
            $this->publishes([
                __DIR__ . './Config' => config_path()
            ], 'swechat');
        }
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }

    private function routeConfiguration()
    {
        return ['namespace' => 'PengGuangSheng\LaravelWechat\Http\Controllers', 'prefix' => 'swechat',];
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }
}
