<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
class GeneratorModel {

    const DIR_DEFAULT = "app/Model";
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
        $targetTable = "your_table";

        if(isset($this->args[3]) && str_contains($this->args[3],"--table=") ) {
            $targetTable = str_replace("--table=","",$this->args[3]);
        }

        $placeholders = [
            '{ModelName}' => $targetName,
            '{modelName}' => strtolower($targetName),
            '{table_name}' => $targetTable,
        ];

        GeneratorUtils::createDirectory($path);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ModelName}Repository.php', $path.'/'.$targetName.'Repository.php', $placeholders);
    }
}