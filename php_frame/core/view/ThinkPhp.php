<?php

namespace core\view;

// tp 的模板引擎
use think\Template;

class ThinkPhp implements ViewInterface
{
    protected $template;
    public function init()
    {
        $config = \App::getContainer()->get('config')->get('view');
        $this->template = new Template([
           'view_path' => $config['view_path'],
            'cache_path' => $config['cache_path']
        ]);
    }

    public function render($path, array $params = [])
    {
        $this->template->assign($params);
        $path = str_replace('.','/',$path);
        return $this->template->fetch($path);
    }
}