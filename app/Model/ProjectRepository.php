<?php
declare(strict_types=1);

namespace App\Model;

use Nette;

final class ProjectRepository
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    public function find():  Nette\Database\Table\Selection
    {
        return $this->database->table('projects');
    }
    public function add(string $name, string $description): void
    {
        $this->find()->insert([
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function findById(int $projectId): Nette\Database\Table\ActiveRow|null
    {
        return $this->find()->get($projectId);
    }

    public function updateById(int $id, Nette\Utils\ArrayHash $data): int|null
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->find()->where('id', $id)->update($data);
    }

    public function deleteById(int $id): int
    {
        return $this->find()
            ->where('id', $id)
            ->delete();
    }

}