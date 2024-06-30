<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

class SignInFormFactory
{
    public function create(): Form
    {
        $form = new Form;
        $form->addEmail('email', 'Enter your email:')
            ->setRequired();
        $form->addPassword('password', 'Your password:')
            ->setRequired();
        $form->addSubmit('send', 'Login');
        return $form;
    }
}