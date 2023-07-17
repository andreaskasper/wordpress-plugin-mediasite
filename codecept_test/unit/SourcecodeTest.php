<?php

class SourcecodeTest extends \Codeception\Test\Unit
{
	/**
	  * @var \UnitTester
	  */
	protected $tester;
	
	/**
    * @dataProvider AllPHPFilesProvider
    */
    public function testSyntax($file) {
        exec('php -l ".$file."', $out, $a);
		$this->assertEquals(0, $a, "Die Datei".$file." hat einen Syntaxfehler: ".$out[0]);
    }
    
    /**
    * @dataProvider AllJSONFilesProvider
    */
    public function testJSON($file) {
        $json = json_decode(file_get_contents($file), true);
        $this->assertNotNull($json, "Die Datei".$file." hat einen Syntaxfehler");
		$this->assertNotEmpty($json, "Die Datei".$file." hat einen Syntaxfehler");
	}
	

	/**
     * @return array
     */
    public function AllPHPFilesProvider() 
    {
        $out = array();

        $dirs = array(dirname(dirname(__DIR__))."/");
        $i = 0;
        while (isset($dirs[$i])) {
            $dir = $dirs[$i];
            $files = scandir($dir);
            foreach ($files as $file) {
                if (substr($file,0,1) == ".") continue;
                if (is_dir($dir.$file)) $dirs[] = $dir.$file."/";
                elseif (substr($file,-4) == ".php") $out[substr($dir.$file, strlen($dirs[0]), 9999)] = [$dir.$file];
            }
            $i++;
        }

        return $out;
    }

    /**
     * @return array
     */
    public function AllJSONFilesProvider() 
    {
        $out = array();

        $dirs = array(dirname(dirname(__DIR__))."/");
        $i = 0;
        while (isset($dirs[$i])) {
            $dir = $dirs[$i];
            $files = scandir($dir);
            foreach ($files as $file) {
                if (substr($file,0,1) == ".") continue;
                if (is_dir($dir.$file)) $dirs[] = $dir.$file."/";
                elseif ((substr($file,-5) == ".json" OR substr($file,-5) == ".i18n") AND strpos($dir.$file, "codecept_test/_output/report.json") === FALSE) $out[substr($dir.$file, strlen($dirs[0]), 9999)] = [$dir.$file];
            }
            $i++;
        }

        return $out;
    }


}
