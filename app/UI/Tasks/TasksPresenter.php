<?php
declare(strict_types=1);

namespace App\UI\Tasks;

use App\Forms\TaskFormFactory;
use App\Model\TaskRepository;
use App\UI\BasePresenter;
use Exception;
use Nette\Application\UI\Presenter;
use Nette\Utils\Paginator;

class TasksPresenter extends BasePresenter {

    protected function filters()
    {
        return [
            'access' => [
                'rules' =>  [
                    [
                        'actions' => ['*'],
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
        private TaskRepository $taskRepository,
        private TaskFormFactory $formFactory,
    )
    {
        parent::__construct();
    }
    public function renderDefault(int $page = 1): void
    {
        $this->template->statusOptions = $this->taskRepository->getStatusOptions();

        $tasksCount = $this->taskRepository->getPublicTasksCount();

        $paginator = new Paginator;
        $paginator->setItemCount( $tasksCount );
        $paginator->setItemsPerPage(2);
        $paginator->setPage($page);

        $tasks = $this->taskRepository
            ->getPublicTasks()
            ->limit($paginator->getLength(), $paginator->getOffset());

        $this->template->tasks = $tasks;
        $this->template->paginator = $paginator;

    }

    public function renderUpdate(int $id): void
    {
        $task = $this->taskRepository->findById($id);

        if (!$task) {
            $this->error('Uloha sa nenašla.');
        }

        $this->template->task = $task;

        $this->getComponent('taskForm')
            ->setDefaults($task->toArray());
    }

    public function actionDelete(int $id): void
    {

    }

    protected function createComponentTaskForm()
    {
        $form = $this->formFactory->create();
        $form->onSuccess[] = [$this, 'taskFormSucceeded'];
        return $form;
    }

    public function taskFormSucceeded($form, $data)
    {
        try {
            $taskId = (int)$this->getParameter('id');

            if($taskId) {
                $this->taskRepository->updateById($taskId , $data);
                $this->flashMessage('Úloha bola úspešne upravená.', 'success');
            }
            else {
                $this->taskRepository->create($data);
                $this->flashMessage('Úloha bol úspešne pridaná.', 'success');
            }
        } catch (Exception $e) {
            $form->addError('Ukladanie zlyhalo.');
        }
        $this->redirect('Tasks:');
    }

}