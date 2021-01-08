<?php

namespace core\view;

use duncan3dc\Laravel\BladeInstance;

class Blade implements ViewInterface
{
    protected $template;
    public function init()
    {
        $config = \App::getContainer()->get('config')->get('view'); // 获取配置

        // 设置视图路径 和缓存路径 参见：duncan3dc/blade
        $this->template = new BladeInstance($config['view_path'], $config['cache_path']);
    }

    // 传递路径 和参数
    public function render($path, $params = [])
    {
        return $this->template->render($path, $params);
    }
}