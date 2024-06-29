<?php

namespace Lib;

class ConsoleCommand {

    protected $command;
    protected $args;
    protected $input;
    protected $templateDirectory;
    protected $commandList = [];

    public function getArguments()
    {
        return $this->args;
    }

    public function handle($argv)
    {
        list($console, $this->command, $this->args) = $argv;
        $this->input = $argv;
        $this->templateDirectory = __DIR__ . '/templates';
    }

    public function setTemplateDirectory($path = null)
    {
        $this->templateDirectory = $path;
    }

    public function getTemplateDirectory()
    {
        return $this->templateDirectory;
    }

    public function setCommand($name, $command = null)
    {
        $this->commandList[$name] = $command;
    }

    public function run()
    {
        if(isset($this->commandList[$this->command])) {
            $generator = $this->commandList[$this->command];

            $generator->setArguments($this->input);
            $generator->setTemplateDirectory($this->getTemplateDirectory());
            $generator->run();
        }
        else {
            echo "Usage: php genette $this->command not to found!\n";
            exit(1);
        }
    }
}



