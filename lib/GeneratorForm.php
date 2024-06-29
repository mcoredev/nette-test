<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
class GeneratorForm {

    const DIR_DEFAULT = "app/Forms";
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

        $targetPath = self::DIR_DEFAULT;

        if(isset($this->args[3]) && str_contains($this->args[3],"--path=") ) {
            $targetPath = str_replace("--path=","",$this->args[3]);
            $path = $this->path . $targetPath;
        }

        $placeholders = [
            '{FormName}' => $targetName,
            '{formName}' => strtolower($targetName),
            '{path}' => ucfirst(str_replace('/','\\',$targetPath)),
        ];

        GeneratorUtils::createDirectory($path);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{FormName}FormFactory.php', $path.'/'.$targetName.'FormFactory.php', $placeholders);
    }
}