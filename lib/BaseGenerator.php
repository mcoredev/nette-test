<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
class BaseGenerator {
    protected $args;
    protected $absolute_path;
    protected $templateDirectory;

    public function __construct()
    {
        $this->absolute_path = __DIR__ . '/../';
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
    }

    protected function getArgumentPath($targetName = null, $dir_default = null)
    {
        $targetDir = $this->absolute_path . $dir_default;
        $targetPath = $dir_default.'/'.$targetName;
        $namespace = $targetPath;

        if(isset($this->args[3]) && str_contains($this->args[3],"--path=") ) {
            $targetPath = str_replace("--path=","",$this->args[3]);
            $targetDir = $this->absolute_path . $targetPath;
            $namespace = $targetPath.'/'.$targetName;
        }

        return [
            "targetPath" => $targetPath,
            "namespace" => $namespace,
            "targetDir" => $targetDir,
        ];
    }
}