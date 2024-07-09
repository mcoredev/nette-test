<?php
declare(strict_types=1);
namespace App\Control\Project\Grid\Item;

use App\Control\Project\Grid\Item\Control;
use Nette\Database\Table\ActiveRow;

interface ControlFactory
{
    public function create(
        ActiveRow $item,
    ): Control;
}