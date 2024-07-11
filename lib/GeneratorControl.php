<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';

class GeneratorControl extends BaseGenerator {

    const DIR_DEFAULT = "app/Control";

    public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
        $targetName = $this->args[2];

        $arg = $this->getArgumentPath($targetName,self::DIR_DEFAULT);

        $targetDir = $arg['targetDir'].'/'.$targetName;
        $namespace = $arg['namespace'];

        $placeholders = [
            '{namespace}' => ucfirst(str_replace('/','\\',$namespace)),
        ];

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/Control/Control.php', $targetDir.'/Control.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/Control/ControlFactory.php', $targetDir.'/ControlFactory.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/Control/default.latte', $targetDir.'/default.latte', $placeholders);
    }
}