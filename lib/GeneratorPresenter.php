<?php
namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';
require_once __DIR__.'/BaseGenerator.php';

class GeneratorPresenter extends BaseGenerator {
    const DIR_DEFAULT = "app/UI";

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

        $targetFilename = $targetDir.'/'.$targetName.'Presenter';

        $placeholders = [
            '{PresenterName}' => $targetName,
            '{presenterName}' => strtolower($targetName),
            '{namespace}' => ucfirst(str_replace('/','\\',$namespace)),
        ];

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/Presenter/{PresenterName}Presenter.php', $targetFilename . '.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/Presenter/default.latte', $targetDir . '/default.latte', $placeholders);
    }

}