<?php
chdir(__DIR__);

use PHPUnit\Framework\TestCase;

spl_autoload_register(function (string $class) {
    $path = "../library/".$class.".php";
    if (file_exists($path)) {
        include $path;
    }
});

class CheckPHPTest extends TestCase {
    
    public function testExtensions() {
        $ext = new Extensions(["gd", "noexten"]);
        $ext->findRecommends();

        $gd = $ext->review["gd"];
        $this->assertEquals($gd->name, "gd");
        $this->assertTrue($gd->exist);
        $this->assertNotNull($gd->version);

        $noexten = $ext->review["noexten"];
        $this->assertEquals($noexten->name, "noexten");
        $this->assertFalse($noexten->exist);
        $this->assertEquals($noexten->version, "-");
        $this->assertNotNull($noexten->msg);
    }

    public function testConstruct() {
        $ch = new CheckPHP("t-rules.json");
        $this->assertEquals($ch->getVar("minVersion"), "5.5.0");
        $this->assertEquals($ch->getVar("recomm"),
            [
                "ftp",
                "memcache",
                "zip",
                "CURL"
            ]);
    }

    public function testCheckFuncs() {
        $ch = new CheckPHP("t-rules.json");
        $ch->checkFuncs();
        
        $fun = $ch->info["funcs"]["nofunc"];
        $this->assertEquals($fun->name, "nofunc");
        $this->assertFalse($fun->able);
    }

    public function testCheckNeeds() {
        $ch = new CheckPHP("t-rules.json");
        $ch->checkNeeds();

        
        $exts = $ch->info["needs"];
        $this->assertCount(4, $exts);
        $ext = $exts["noexten"];
        $this->assertNotNull($ext->msg);
        $this->assertFalse($ext->exist);

        $this->assertEquals($ch->errors, 1);
    }
}