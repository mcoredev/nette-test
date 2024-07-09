<?php
declare(strict_types=1);

namespace App\Forms;

use App\Model\UserRepository;
use Nette\Application\UI\Form;

class ProfileFormFactory
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    protected function createForm()
    {
        $form = new Form;
        $form->addProtection();
        $form->addText('first_name', 'First Name:')
            ->setRequired('Please enter your first name.');

        $form->addText('last_name', 'Last Name:')
            ->setRequired('Please enter your last name.');

        $form->addEmail('email', 'Email:')
            ->setRequired('Please enter your email address.');

        $form->addPassword('password', 'Password:')
            ->addRule($form::MinLength, 'Password must be at least %d characters long', 6);

        $form->addPassword('password_confirm', 'Confirm Password:')
            ->addRule($form::Equal, 'Passwords do not match.', $form['password']);

        $form->addCheckbox('is_active','Is active');

        $form->addSelect('role','Rola', $this->userRepository->getRoleOptions());
        return $form;
    }
    public function create(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Submit Create');
        return $form;
    }

    public function update(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Submit Edit');
        return $form;
    }
}