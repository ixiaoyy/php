<?php

namespace core\database\model;

class Model
{
    // 绑定的数据库连接
    protected $connection;

    protected $table;

    protected $paimaryKey; // 主键
    protected $timestamps = true; // 是否自动维护时间字段

    /*
     * $original 原值
     * $attribute 原值的复制
     */
    protected $original;
    protected $attribute;

    public function __construct()
    {
        // 当前模型定一个数据库连接
        $this->connection = \App::getContainer()->get('db')->connection(
            $this->connection
        );
    }

    // 获取表名称
    public function getTable()
    {
        if($this->table) {
            return $this->table;
        }

        $class_name = get_class($this);
        $class_arr = explode('\\', $class_name);

        $table = lcfirst(end($class_arr));

        return $table . 's';
    }

    public function setOriginalValue($key, $val)
    {
        if(!$this->original) $this->original = new \stdClass();
        $this->original->$key = $val;
    }

    public function setAttribute($key, $val)
    {
        if(!$this->attribute) $this->attribute = new \stdClass();
        $this->attribute->$key = $val;
    }

    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    // 属性同步 original
    public function syncOriginal()
    {
        $this->attribute = $this->original;
    }

    /*
     * 返回用户改过的数据
     * @return array
     * @example ['id' => 3, 'user_id' => '3']
     */
    public function diff()
    {
        $diff = [];
        if ($this->attribute == $this->original) return $diff;

        foreach ($this->original as $origin_key => $origin_val) {
            if ($this->attribute->$origin_key != $origin_val) {
                $diff[$origin_key] = $this->attribute->$origin_key;
            }
        }

        return $diff;
    }

    public function __get($name)
    {
        return $this->attribute->name;
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static())->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        return (new Builder(
            $this->connection->newBuilder()
        ))
            ->setModel($this)
            ->$name(...$arguments);
    }
}