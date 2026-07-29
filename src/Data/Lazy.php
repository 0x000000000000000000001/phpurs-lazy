<?php

class Phpurs_Lazy {
    private $f;
    private $v;
    private $done = false;
    public function __construct($f) {
        $this->f = $f;
    }
    public function __invoke(...$args) {
        if ($this->done) return $this->v;
        $this->v = ($this->f)(...$args);
        $this->done = true;
        return $this->v;
    }
}

$exports['force'] = function($l) {
    $__num = \func_num_args();
    $res = $l(null);
    if ($__num > 1) {
        return $res(...\array_slice(\func_get_args(), 1));
    }
    return $res;
};

$exports['defer'] = function($f) {
    return new Phpurs_Lazy($f);
};

return $exports;
