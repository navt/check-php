<?php
class CheckPHP {

    private $minVersion; // минимально требуемая версия PHP
    private $funcs;      // необходимые функции 
    private $exts;       // требуемые расширения
    private $recomm;     // рекомендованные расширения

    public $info = [];
    public $errors = 0;

    public function __construct(string $path="rules.json") {
        $s = file_get_contents($path);

        if ($s === false) {
            throw new InvalidArgumentException("Нет файла правил по пути: {$path}");
        }

        $rules = json_decode($s);
        
        foreach ($rules as $key => $value) {
            $this->$key = $value;
        }
    }
    // проверка версии PHP
    public function checkVersion() {
        $php = new stdClass();
        $php->version = implode('.', [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, PHP_RELEASE_VERSION]);
        $php->minreq = $this->minVersion;

        if (version_compare(PHP_VERSION, $this->minVersion, '>=') === false) {
            $this->errors++;
            $php->valid = false;
        } else {
            $php->valid = true;
        }

        $this->info["php"] = $php;
        return $this;
    }
    
    // проверка требуемых функций PHP
    public function checkFuncs() {
        $functions = [];

        foreach ($this->funcs as $func) {
            $features = new stdClass();
            $features->name = $func;

            if (is_callable($func)) {
                $features->able = true;
            } else {
                $features->able = false;
                $this->errors++;
            }

            $functions[$func] = $features;
            $features = null; 
        }
        
        $this->info["funcs"] = $functions;
        return $this;
    }

    // проверка требуемых расширений
    public function checkNeeds() {
        $n = new Extensions($this->exts);
        $this->info["needs"] = $n->findNeeds()->review;
        $this->errors += $n->errors;
        $this->info["errors"] = $this->errors;
        return $this;
    }

    // проверка рекомендованных расширений
    public function checkRecoms() {
        $r = new Extensions($this->recomm);
        $this->info["recomm"] = $r->findRecommends()->review;
        return $this;
    }

    public function getVar(string $name="") {
        return isset($this->$name) ? $this->$name : null;
    }
}
