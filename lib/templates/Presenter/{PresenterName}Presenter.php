<?php

declare(strict_types=1);

namespace {namespace};

use Nette;
use Nette\Application\UI\Presenter;
use App\UI\BasePresenter;

final class {PresenterName}Presenter extends BasePresenter
{
    public function filters()
    {
        return [
            'access' => [
                'rules' =>  [
                    [
                        'actions' => ['default'],
                        'auth' => false,
                    ],
                ],
            ],
        ];
    }

    protected function startup(): void
    {
        parent::startup();
        $this->setLayout('main');
    }

    public function renderDefault(): void
    {
    }

/*
    protected function createComponentYourForm()
    {
        $form = $this->formFactory->create();
        $form->onSuccess[] = [$this, 'YourFormSucceeded'];
        return $form;
    }

    public function yourFormSucceeded($form, $data)
    {
        // your logic here
    }

*/

}
