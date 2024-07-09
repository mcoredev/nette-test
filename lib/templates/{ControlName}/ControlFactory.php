<?php
declare(strict_types=1);
namespace {path};

use Nette\Application\UI\Control;

interface ControlFactory
{
    public function create(): Control;
}