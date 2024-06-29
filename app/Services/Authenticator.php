<?php
declare(strict_types=1);

namespace App\Services;

use Nette;
use Nette\Security\SimpleIdentity;

class Authenticator implements Nette\Security\Authenticator
{
    public function __construct(
        private \App\Model\UserRepository $userRepository,
        private Nette\Security\Passwords $passwords,
        private Nette\Database\Explorer $database,
    ) {
    }

    public function authenticate(string $user, string $password): SimpleIdentity
    {
        $row = $this->userRepository->find()->where('email', $user)->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        $this->userRepository->updateLastLogin($row->id);

        return new SimpleIdentity(
            $row->id,
            $row->role, // nebo pole více rolí
            ['name' => $row->email],
        );
    }
}
