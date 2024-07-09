<?php
declare(strict_types=1);

namespace App\Control\Project\Grid\Item;

use Nette\Application\UI\Control as UIControl;
use Nette\Database\Table\ActiveRow;

class Control extends UIControl
{
    public function __construct(
        private ActiveRow $item,
    ){}

    public function render(): void
    {
        $this->template->project = $this->item;
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function renderPaginator(): void
    {
        // ...
    }
}