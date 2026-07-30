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

$exports['force'] = function($l) { return $l(null); };

$exports['defer'] = function($f) {
    return new Phpurs_Lazy($f);
};

return $exports;
