<?php

namespace lbreak\QuickLark\map;

class BaseMap
{
    private $data = [];
    public function __construct(array $data)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param array $data
     * @return static
     */
    public static function init(array $data): self
    {
        return (new static($data));
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