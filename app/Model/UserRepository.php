<?php
declare(strict_types=1);

namespace App\Model;

use Nette;

final class UserRepository
{
    public function __construct(
        private Nette\Database\Explorer $database,
        private Nette\Security\Passwords $passwords
    ) {
    }

    public function find(): Nette\Database\Table\Selection
    {
        return $this->database->table('users');
    }

    public function getRoleOptions()
    {
        return [
            'admin' => 'Administrátor',
            'editor' => 'Editor',
        ];
    }

    public function findByEmail(string $email): Nette\Database\Table\Selection
    {
        return $this->find()->where('email', $email);
    }

    public function findById(int $id): Nette\Database\Table\ActiveRow|null
    {
        return $this->find()->get($id);
    }

    public function updateLastLogin(int $id): int|null
    {
        return $this->find()->where('id', $id)->update(['last_login' => date('Y-m-d H:i:s')]);
    }

    public function updateById(int $id, Nette\Utils\ArrayHash $data): int|null
    {
        if(!empty($data['password'])) {
            $data['password'] = $this->passwords->hash($data['password']);
        }
        return $this->find()->where('id', $id)->update($data);
    }

    public function create(Nette\Utils\ArrayHash $data): Nette\Database\Table\ActiveRow|null
    {
        $data['password'] = $this->passwords->hash($data['password']);
        return $this->find()->insert($data);
    }

}