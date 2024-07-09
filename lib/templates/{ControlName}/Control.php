<?php
declare(strict_types=1);

namespace {path};

use Nette\Application\UI\Control as UIControl;

class Control extends UIControl
{

    public function __construct(
    ){
    }

    public function render(): void
    {
        //$this->template->param = null;
        $this->template->render(__DIR__ . '/default.latte');
    }


}