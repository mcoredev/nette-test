<?php
declare(strict_types=1);

namespace App\Control\Project\Grid;

use App\Model\ProjectRepository;
use Nette\Application\UI\Control as UIControl;
use App\Control\Project\Grid\Item\ControlFactory;
use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

class Control extends UIControl
{
    private Selection $projects;

    public function __construct(
        private ProjectRepository $projectRepository,
        private ControlFactory $controlFactory,
    ){
        $this->projects = $this->projectRepository->find();
    }

    public function render(): void
    {
        $this->template->projects = $this->projects;
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentItem()
    {
        $projects = $this->projects;
        $factory = $this->controlFactory;
        return new Multiplier(function(string $id) use ($projects, $factory) {
            return $factory->create($projects[(int) $id]);
        });
    }

    public function renderPaginator(): void
    {
        // ...
    }
}