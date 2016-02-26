<?php
use VoidMain;
require_once('../src/func.php');

// $sayJames = partial(function ($a, $b) {
//     return "Hi, I'm $a $b\n";
// }, "James");

// echo $sayJames("Bond");

function testFunc ($a, $b, $c) {
    echo "$a $b $c\n";
};
$curriedTestFunc = VoidMain\FnPHP\curry("testFunc");
$say = $curriedTestFunc("say");
$sayHello = $say("hello");
$sayHello("world");
$curriedTestFunc("say", "test", "all");
$newSayHello = $curriedTestFunc("say", "hello");
$newSayHello("world");


function sum($a, $b, $c) {
    return $a + $b + $c;
}

$curriedSum = VoidMain\FnPHP\curry("sum");
$sum1 = $curriedSum(1);
$sum1And2 = $sum1(2);
echo "Sum to 3 is " . $sum1And2(3);