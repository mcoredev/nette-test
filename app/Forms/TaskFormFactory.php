<?php
declare(strict_types=1);

namespace App\Forms;

use App\Model\ProjectRepository;
use App\Model\TaskRepository;
use Nette\Application\UI\Form;
class TaskFormFactory
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private TaskRepository $taskRepository,
    ) {}
    protected function createForm()
    {
        $form = new Form;
        $form->addProtection();
        $form->addText('name', 'Name task')
            ->setRequired();
        $form->addSelect('project_id','Projekt', $this->projectRepository->find()->fetchPairs('id','name'));
        $form->addTextArea('description', 'Task description')
            ->setRequired();
        $form->addSelect('status', 'Status',$this->taskRepository->getStatusOptions())
            ->setRequired();
        return $form;
    }
    public function create(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Pridať úlohu');
        return $form;
    }

    public function update(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Upraviť úlohu');
        return $form;
    }
}