<?php
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