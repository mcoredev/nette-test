<?php
declare(strict_types=1);

use Nette\Application\UI\Control;

class TaskControl extends Control
{
    public function render(): void
    {
        $this->template->param = $value;

        $this->template->render(__DIR__ . '/default.latte');
    }
}