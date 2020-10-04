<?php
class Extensions {
    
    private $exts   = [];
    public  $review = [];
    public  $errors = 0;
    
    public function __construct(array $exts) {
        $this->exts = $exts;
    }

    private function extExist(string $ext, array $res=[]) {
        $ext = strtolower($ext);
        $features = new stdClass();

        try {
            $r = new ReflectionExtension($ext);
        } catch ( ReflectionException $re) {
            $features->name = $ext;
            $features->version = "-";
            $features->msg = $re->getMessage(); 
            $features->exist = false;
            $res[$ext] = $features; 
            return $res;
        }
    
        if (isset($res[$ext])) {
            return $res;
        }
    
        $features->name = $r->getName();
        $features->version = $r->getVersion();
        $features->exist = true;
        $res[$ext] = $features;
    
        $ds = $r->getDependencies();
    
        if ($ds != []) {
            foreach ($ds as $name => $need) {
                if ($need == "Required") {
                    $res = $this->extExist($name, $res);
                }
            }
        }

        return $res;
    }
    
    public function findRecommends() {

        foreach ($this->exts as $ext) {
            $this->review = $this->extExist($ext, $this->review);
        }

        return $this;
    }

    public function findNeeds() {
        $this->findRecommends();

        foreach ($this->review as $item) {
            if ($item->exist === false) {
                $this->errors++;
            }
        }

        return $this;
    }
}
