<?php

namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';

class GeneratorModel extends BaseGenerator {

    const TABLE_DEFAULT = "your_table";
    const DIR_DEFAULT = "app/Model";

    public function __construct()
    {
        parent::__construct();
    }

    public function run(): void
    {
        $targetName = $this->args[2];

        $targetTable = self::TABLE_DEFAULT;
        $namespace = self::DIR_DEFAULT;
        $targetDir = $this->absolute_path . self::DIR_DEFAULT;

        $targetFilename = $targetDir.'/'.$targetName.'Repository';

        if(isset($this->args[3]) && str_contains($this->args[3],"--table=") ) {
            $targetTable = str_replace("--table=","",$this->args[3]);
        }

        $placeholders = [
            '{ModelName}' => $targetName,
            '{modelName}' => strtolower($targetName),
            '{table_name}' => $targetTable,
            '{namespace}' => ucfirst(str_replace('/','\\',$namespace)),
        ];

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{ModelName}Repository.php', $targetFilename.'.php', $placeholders);
    }
}