<?php
namespace Lib;

require_once __DIR__.'/GeneratorUtils.php';

class GeneratorPresenter  {
    const DIR_DEFAULT = "app/UI";
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
            '{PresenterName}' => $targetName,
            '{presenterName}' => strtolower($targetName),
            '{path}' => ucfirst(str_replace('/','\\',$targetPath)).'\\'.$targetName,
        ];

        $targetDir = $path . '/' . $targetName;

        GeneratorUtils::createDirectory($targetDir);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/{PresenterName}Presenter.php', $targetDir.'/'.$targetName.'Presenter.php', $placeholders);
        GeneratorUtils::copyTemplate($this->getTemplateDirectory() . '/default.latte', $targetDir.'/default.latte', $placeholders);
    }

}