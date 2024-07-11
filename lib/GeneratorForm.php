<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';
class GeneratorForm extends BaseGenerator {

    const DIR_DEFAULT = "app/Forms";

    public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
        $targetName = $this->args[2];

        $arg = $this->getArgumentPath($targetName,self::DIR_DEFAULT);

        $targetDir = $arg['targetDir'];
        $namespace = $arg['namespace'];

        $targetFilename = $targetDir.'/'.$targetName.'FormFactory';

        $placeholders = [
            '{FormName}' => $targetName,
            '{formName}' => strtolower($targetName),
            '{namespace}' => ucfirst(str_replace('/','\\',$namespace)),
        ];

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{FormName}FormFactory.php', $targetFilename.'.php', $placeholders);
    }
}