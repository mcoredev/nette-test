<?php
declare(strict_types=1);

namespace {namespace};

use Nette\Application\UI\Form;

class {FormName}FormFactory
{

    public function __construct(
    ) {}

    protected function createForm()
    {
        $form = new Form;
        $form->addProtection();
        $form->addText('name', 'Name');
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