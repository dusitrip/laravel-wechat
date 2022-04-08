<?php

namespace PengGuangSheng\LaravelWechat\Console\Commands;

//use Illuminate\Console\Command;
use Illuminate\Routing\Console\ControllerMakeCommand as Command;
use Illuminate\Support\Str;

class ControllerMakeCommand extends Command
{
//    protected $signature = 'swechat-make:controller';
    protected $name = 'swechat-make:controller';
    protected $description = '这个是组件中的创建Controller的命令';
    protected $namespace = 'PengGuangSheng\LaravelWechat\Http\Controllers';
//    public function __construct()
//    {
//        parent::__construct();
//    }

//    public function handle()
//    {
//        //
//    }

    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');
        return $this->namespace.'\\'.$name;
    }
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return app()->basePath()."\\vendor\pengguangsheng\laravel-wechat\\".str_replace('\\', '/', $name).'.php';
    }
    protected function rootNamespace(){
        return 'PengGuangSheng\\LaravelWechat\\';
    }
}
