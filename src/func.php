<?php

namespace VoidMain\FnPHP;

use \ReflectionFunction;

function partial() {
    $args = func_get_args();
    $fn = array_shift($args);
    return function () use ($fn, $args) {
        $innerArgs = func_get_args();
        return call_user_func_array($fn, array_merge($args, $innerArgs));
    };
}

function pipe() {
    $args = func_get_args();
    return function () use ($args) {
        $idx = 0;
        $userArgs = func_get_args();
        $result = call_user_func_array($args[$idx], $userArgs);
        for ($idx = 1; $idx < count($args); $idx ++) {
            $result = call_user_func($args[$idx], $result);
        }
        
        return $result;
    };
}

function compose() {
    $args = array_reverse(func_get_args());
    return call_user_func_array("pipe", $args);
}

function curry($fn) {
    $reflectionFunc = new ReflectionFunction($fn);
    $paramsCount = count($reflectionFunc->getParameters());
    
    if (!function_exists("VoidMain\\FnPHP\\helper")) {
        function helper ($argsSoFar, $paramsCount, $fn) {
            return function () use ($argsSoFar, $paramsCount, $fn) {
                $newArgs = func_get_args();
                $wholeArgs = array_merge($argsSoFar, $newArgs);
                if (count($wholeArgs) >= $paramsCount) {
                    return call_user_func_array($fn, $wholeArgs);
                } else {
                    return helper($wholeArgs, $paramsCount, $fn);
                }
            };
        };        
    }
    
    return helper([], $paramsCount, $fn);
}
