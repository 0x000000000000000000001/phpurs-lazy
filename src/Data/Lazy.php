<?php

$exports['force'] = function($l) {
    return $l(null);
};

$exports['defer'] = function($f) {
    $v = null;
    $done = false;
    return function(...$args) use ($f, &$v, &$done) {
        if ($done) return $v;
        $v = $f(...$args);
        $done = true;
        return $v;
    };
};

return $exports;
