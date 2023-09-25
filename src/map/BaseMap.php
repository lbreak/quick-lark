<?php

namespace lbreak\QuickLark\map;

class BaseMap
{
    private $data = [];
    private static $_instance = [];
    public function __construct(array $data)
    {
        $this->processData($data);
    }

    /**
     * @param array $data
     * @return static
     */
    public static function init(array $data): self
    {
        if(isset(self::$_instance[static::class]) && self::$_instance[static::class] instanceof static){
            self::$_instance[static::class]->processData($data);
            return self::$_instance[static::class];
        }
        self::$_instance[static::class] = new static($data);
        return self::$_instance[static::class];
    }

    public function processData(array $data) {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->data[$key] = $value;
                $this->$key = $value;
            }
        }
    }

    /**
     * 获取属性
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * 设置属性
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        $this->{$name} = $value;
        return $this->{$name};
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
//        $classRef = new \ReflectionClass($this);
//        $properties = $classRef->getProperties();
//        $values = [];
//        foreach ($properties as $property) {
//            // 为了兼容反射私有属性
//            $property->setAccessible(true);
//
//            // 将得到的类属性同具体的实例绑定解析，获得实例上的属性值
//            $values[$property->getName()] = $property->getValue($this);
//        }

        return $this->data;
    }
}