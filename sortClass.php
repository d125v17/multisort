<?php

class MultiSort
{
    private $field;
    private $sort;

    public function __construct($field = false, $sort = 'asc') {
        $this->field = $field;
        $this->sort = $sort === 'asc' ? true : false;
    }

    public function mergeSort($array) {
        if (count($array) <= 1) {
            return $array;
        } else {
        $q = (int) (count($array) / 2);
        return $this->merge($this->mergeSort(array_slice($array, 0, $q)), $this->mergeSort(array_slice($array, $q)));
        }
    }

    private function merge($leftMas, $rightMas) {
        $field = $this->field;
        $sort = $this->sort;
        $twoMasCount = count($leftMas) + count($rightMas);
        $l = 0;
        $r = 0;
        $mas = [];
        for ($i = 0; $i < $twoMasCount; $i++) {
            $left = $l < count($leftMas) ? $this->getValue($leftMas[$l], $field) : 0;
            $right = $r < count($rightMas) ? $this->getValue($rightMas[$r], $field) : 0;
            if ($l == count($leftMas)) {
                $mas[] = $rightMas[$r];
                $r++;
            } elseif ($r == count($rightMas)) {
                $mas[] = $leftMas[$l];
                $l++;
            } elseif ($left <= $right && $sort) {
                $mas[] = $leftMas[$l];
                $l++;
            } elseif ($left > $right && $sort == false) {
                $mas[] = $leftMas[$l];
                $l++;
            } elseif($left > $right && $sort){
                $mas[] = $rightMas[$r];
                $r++;
            } elseif($left <= $right && $sort == false) {
                $mas[] = $rightMas[$r];
                $r++;
            }
        }
        return $mas;
    }

    private function getValue($item, $field)
    {
        if (!$field) {
            return $item;
        }
        if (is_array($item)) {
            return $item[$field];
        }
        return $item->$field;
    }
}