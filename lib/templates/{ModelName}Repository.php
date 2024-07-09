<?php
declare(strict_types=1);

namespace App\Model;

use Nette;

final class {ModelName}Repository
{
    public function __construct(
        private Nette\Database\Explorer $database,
    ) {
    }

    protected function getTableName()
    {
        return "{table_name}";
    }

    public function create(Nette\Utils\ArrayHash $data): void
    {
        // $this->find()->insert($data);
    }

    public function updateById(int $id, Nette\Utils\ArrayHash $data): int|null
    {
        return (!empty($data)) ? $this->find()
            ->where('id', $id)
            ->update($data) : null;
    }

    public function deleteById(int $id): int
    {
        return $this->find()
            ->where('id', $id)
            ->delete();
    }

    public function findAll(): Nette\Database\Table\Selection
    {
        return $this->find();
    }

    public function findById(int $id): Nette\Database\Table\ActiveRow|null
    {
        return $this->find()->where('id', $id);
    }

    protected function find()
    {
        return $this->database->table($this->getTableName());
    }

}