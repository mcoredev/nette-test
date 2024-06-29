<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

class ProjectFormFactory
{
    protected function createForm()
    {
        $form = new Form;
        $form->addProtection();
        $form->addText('name', 'Name project')
            ->setRequired();
        $form->addTextArea('description', 'Project description')
            ->setRequired();
        return $form;
    }
    public function create(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Pridať projekt');
        return $form;
    }

    public function update(): Form
    {
        $form = $this->createForm();
        $form->addSubmit('send', 'Upraviť projekt');
        return $form;
    }
}