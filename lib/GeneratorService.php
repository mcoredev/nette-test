<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';
class GeneratorService extends BaseGenerator {

    const DIR_DEFAULT = "app/Service";

    public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
        $targetName = $this->args[2];

        $path = $this->absolute_path . self::DIR_DEFAULT;

        $targetPath = self::DIR_DEFAULT;

        if(isset($this->args[3]) && str_contains($this->args[3],"--path=") ) {
            $targetPath = str_replace("--path=","",$this->args[3]);
            $path = $this->absolute_path . $targetPath;
        }
        $placeholders = [
            '{ServiceName}' => $targetName,
            '{serviceName}' => strtolower($targetName),
            '{namespace}' => ucfirst(str_replace('/','\\',$targetPath)),
        ];

        GeneratorUtils::createDirectory($path);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ServiceName}.php', $path.'/'.$targetName.'.php', $placeholders);
    }
}