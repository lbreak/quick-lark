<?php

namespace lbreak\QuickLark\helper;

class ArrayHelper
{
    /**
     * @param array $array
     * @param array $fields
     * @return array
     */
    public static function unsetFields(array $array, array $fields): array
    {
        foreach ($fields as $field) {
            unset($array[$field]);
        }
        return $array;
    }

    /**
     * @param array $array
     * @param array $fields
     * @return array
     */
    public static function extruct(array $array, array $fields): array
    {
        $result = [];
        foreach ($fields as $field) {
            if (isset($array[$field])) {
                $result[$field] = $array[$field];
            }
        }
        return $result;
    }
}