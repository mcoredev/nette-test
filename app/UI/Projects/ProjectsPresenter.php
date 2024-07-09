<?php
declare(strict_types=1);

namespace App\UI\Projects;

use App\Forms\ProjectFormFactory;
use App\Model\ProjectRepository;
use App\Model\TaskRepository;
use App\UI\BasePresenter;
use Nette\Neon\Exception;
use App\Control;

class ProjectsPresenter extends BasePresenter
{
    use Control\Project\Grid\ControlTrait;

    protected function filters(): array
    {
        return [
            'access' => [
                'rules' =>  [
                    [
                        'actions' => ['*'],
                        'role' => 'editor',
                        'auth' => true,
                        'redirect' => 'Home:',
                    ],
                ],
            ],
        ];
    }

    protected function startup(): void
    {
        parent::startup();
        $this->setLayout('main');
    }

    public function __construct(
        private ProjectFormFactory $formFactory,
        private ProjectRepository $projectRepository,
        private TaskRepository $taskRepository,
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->template->projects = $this->projectRepository->find();
    }

    public function renderCreate(): void
    {
    }

    public function renderPreview(int $id): void
    {
        $this->template->project = $this->projectRepository->findById($id);
        $this->template->taskStatusOptions = $this->taskRepository->getStatusOptions();
    }

    public function renderUpdate(int $id): void
    {
        $project = $this->projectRepository->findById($id);

        if (!$project) {
            $this->error('Projekt sa nenašiel.');
        }

        $this->template->project = $project;

        $this->getComponent('projectForm')
            ->setDefaults($project->toArray());
    }

    public function actionDelete(int $id)
    {
        $this->projectRepository->deleteById($id);
        $this->flashMessage('Projekt bol zmazaný.','danger');
        $this->redirect('Projects:default');
    }

    protected function createComponentProjectForm()
    {
        $form = $this->formFactory->create();
        $form->onSuccess[] = [$this, 'projectFormSucceeded'];
        return $form;
    }

    public function projectFormSucceeded($form, $data)
    {
        try {
            $projectId = (int)$this->getParameter('id');

            if($projectId) {
                $this->projectRepository->updateById($projectId , $data);
                $this->flashMessage('Projekt bol úspešne upravený.', 'success');
            }
            else {
                $this->projectRepository->add($data['name'], $data['description']);
                $this->flashMessage('Projekt bol úspešne založený.', 'success');
            }
        } catch (Exception $e) {
            $form->addError('Ukladanie zlyhalo.');
        }
        $this->redirect('Projects:');
    }
}