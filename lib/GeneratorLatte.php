<?php
namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';
class GeneratorLatte extends BaseGenerator {
    const DIR_DEFAULT = "app/UI";

    public function __construct()
    {
       parent::__construct();
    }
    public function run(): void
    {
        $targetName = $this->args[2];

        if(isset($this->args[3]) && str_contains($this->args[3],"--path=") ) {
            $targetPath = str_replace("--path=","",$this->args[3]);
            $targetDir = $this->absolute_path . $targetPath;
        }
        else {
            echo "WARNING: You must specify the --path parameter as the path to the presenter!!!";
            echo "\n\n";
            exit(1);
        }

        $placeholders = [
            '{LatteName}' => $targetName,
            '{latteName}' => strtolower($targetName),
        ];

        // GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/latte/default.latte', $targetDir . '/'.$targetName.'.latte', $placeholders);
    }

}