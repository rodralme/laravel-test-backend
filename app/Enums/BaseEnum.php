<?php

namespace App\Enums;

use Illuminate\Support\Arr;

abstract class BaseEnum
{
    final private function __construct()
    {
    }

    /**
     * @return mixed
     */
    abstract public static function labels();

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function values()
    {
        $r = new \ReflectionClass(get_called_class());

        return $r->getConstants();
    }

    /**
     * @param $value
     * @return array|\ArrayAccess|mixed|string
     * @throws \ReflectionException
     */
    public static function getLabel($value)
    {
        if (empty($value)) {
            return '';
        }

        $r = new \ReflectionClass(get_called_class());
        $labels = Arr::dot($r->getMethod('labels')->invoke(null));

        return Arr::get($labels, $value);
    }

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getCombo()
    {
        $r = new \ReflectionClass(get_called_class());
        $labels = $r->getMethod('labels')->invoke(null);

        $combo = [];
        foreach ($labels as $key => $value) {
            $combo[] = ['value' => $key, 'label' => $value];
        }

        return $combo;
    }

    public static function toJSON()
    {
        $r = new \ReflectionClass(get_called_class());
        $consts = $r->getConstants() ?? [];

        $json = [];
        foreach ($consts as $const => $value) {
            $json[$const] = [
                'value' => $value,
                'label' => self::getLabel($value),
            ];
        }

        return $json;
    }
}
