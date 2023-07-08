<?php

namespace Abd\Mvc\Console\Traits;

trait Pluralable
{
    public function plural($str)
    {
        $str = strtolower($str);
        $arr = str_split($str);
        $endF = isset($arr[count($arr) - 2]) ? $arr[count($arr) - 2] : "";
        $end = $arr[count($arr) - 1];
        if ($end === "y" && ($endF !== "a" && $endF !== "o" && $endF !== "i" && $endF !== "e" && $endF !== "u")) {
            array_pop($arr);
            $str = join("", $arr);
            $str = $str . "ies";
        } else if ($end === "s" || $end === "x" || $end === "z" || $end === "x" || $endF . $end === "ch" || $endF . $end === "sh") {
            $str = join("", $arr);
            $str = $str . "es";
        } else {
            $str = join("", $arr);
            $str = $str . "s";
        }
        return $str;
        // var_dump($str, $endF, $end);die;
    }
}
