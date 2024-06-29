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

    protected function db()
    {
        return $this->database->table("{table_name}");
    }

    public function add(string $name, string $description): void
    {
        // logic here
    }

    public function findAll(): Nette\Database\Table\Selection
    {
        return $this->db();
    }

    public function findById(int $id): Nette\Database\Table\ActiveRow|null
    {
        return $this->db()->where('id', $id);
    }

    public function find(): Nette\Database\Table\Selection
    {
        return $this->db();
    }

    public function updateById(int $id, Nette\Utils\ArrayHash $data): int|null
    {
        return (!empty($data)) ? $this->db()
            ->where('id', $id)
            ->update($data) : null;
    }

    public function deleteById(int $id): int
    {
        return $this->db()
            ->where('id', $id)
            ->delete();
    }

}