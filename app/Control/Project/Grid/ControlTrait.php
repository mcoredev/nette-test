<?php
declare(strict_types=1);
namespace App\Control\Project\Grid;

use App\Control\Project\Grid\ControlFactory;
use Nette\Application\UI\Control;

trait ControlTrait
{
    private ControlFactory $projectGridControlFactory;

    public function injectGridControl(ControlFactory $controlFactory): void
    {
        $this->projectGridControlFactory = $controlFactory;
    }

    public function createComponentProjectGrid(): Control
    {
       return $this->projectGridControlFactory->create();
    }

}