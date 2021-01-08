<?php

namespace App;

use core\database\model\Model;

class User extends Model
{
    public function php()
    {
        echo "hello php";
    }

    public function sayPhp()
    {
        return "id={$this->attribute->id} 名字：{$this->attribute->nickname} 说：php真棒";
    }
}