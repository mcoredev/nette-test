<?php
declare(strict_types=1);
namespace App\Control\Project\Grid\Item;

use App\Control\Project\Grid\ControlFactory;
use App\Control\Project\Grid\Control;
use Nette\Database\Table\ActiveRow;

trait ControlTrait
{
    private ControlFactory $projectGridItemControlFactory;
    private ActiveRow $projectGridItem;
    public function injectGridItemControl(ControlFactory $controlFactory): void
    {
        $this->projectGridItemControlFactory = $controlFactory;
    }

    public function createComponentProjectGrid(): Control
    {
       return $this->projectGridItemControlFactory->create($this->projectGridItem);
    }

}