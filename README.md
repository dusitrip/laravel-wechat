## 描述
这个是基于`Laravel`框架的微信公众号组件
## 安装

```shell
$ composer require pengguangsheng/laravel-wechat:master-dev
```

## 配置文件发布
```shell
php artisan vendor:publish --provider="PengGuangSheng\LaravelWechat\Providers\WeChatServiceProvider"
```

## 备注
`Laravel` 应用
在 `config/app.php` 注册 `ServiceProvider` 和 `Facade` （`Laravel` 5.5 以上无需手动注册）
```
'providers' => [
    // ...
    PengGuangSheng\LaravelWechat\WeChatServiceProvider::class
]
```
然后再浏览器中访问的路由如下 http://localhost/swechat
```
Route::any('/', 'WeChatController@index')->middleware('swechat.check');
```