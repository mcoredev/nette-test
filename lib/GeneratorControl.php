<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
class GeneratorControl {

    const DIR_DEFAULT = "app/Control";
    protected $args;
    protected $path;
    protected $templateDirectory;

    public function __construct()
    {
        $this->path = __DIR__ . '/../';
    }

    public function setArguments($args = null)
    {
        $this->args = $args;
    }

    public function setTemplateDirectory($path = null)
    {
        $this->templateDirectory = $path;
    }

    public function getTemplateDirectory()
    {
        return $this->templateDirectory;
    }
    public function run(): void
    {
        $path = $this->path . self::DIR_DEFAULT;

        $targetName = $this->args[2];

        $targetPath = (str_contains($targetName,'/')) ? $targetName : self::DIR_DEFAULT;

        if(isset($this->args[3]) && str_contains($this->args[3],"--path=") ) {
            $targetPath = str_replace("--path=","",$this->args[3]);
            $path = $this->path . $targetPath;
        }
        $placeholders = [
            '{ControlName}' => $targetName,
            '{controlName}' => lcfirst($targetName),
            '{path}' => ucfirst(str_replace('/','\\',$targetPath)).'\\'.$targetName,
        ];

        $targetDir = $path . '/' . $targetName;

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ControlName}/Control.php', $targetDir.'/Control.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ControlName}/ControlFactory.php', $targetDir.'/ControlFactory.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ControlName}/default.latte', $targetDir.'/default.latte', $placeholders);
    }
}