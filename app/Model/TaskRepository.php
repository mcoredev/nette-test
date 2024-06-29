<?php
declare(strict_types=1);

namespace App\Model;

use Nette;

final class TaskRepository
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    public function find():  Nette\Database\Table\Selection
    {
        return $this->database->table('tasks');
    }

    public function getStatusOptions()
    {
        return [
            'new' => 'Nová',
            'draft' => 'Koncept',
            'progress' => 'Prebieha',
            'done' => 'Ukončená'
        ];
    }

    public function create(Nette\Utils\ArrayHash $data): void
    {
        $this->find()->insert($data);
    }

    public function findById(int $id): Nette\Database\Table\ActiveRow|null
    {
        return $this->find()->get($id);
    }

    public function findByProjectId(int $projectId): Nette\Database\Table\Selection
    {
        return $this->find()->where('project_id', $projectId);
    }

    public function updateById(int $id, Nette\Utils\ArrayHash $data): int|null
    {
        return $this->find()->where('id', $id)->update($data);
    }

    public function deleteById(int $id): int
    {
        return $this->find()
            ->where('id', $id)
            ->delete();
    }
    public function getPublicTasks(): Nette\Database\Table\Selection
    {
        return $this->find()
            ->order('created_at DESC');
    }

    public function getPublicTasksCount(): int
    {
        return $this->getPublicTasks()->count('*');
    }
}