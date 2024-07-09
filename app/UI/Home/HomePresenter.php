<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\UI\BasePresenter;
use App\Forms\SignInFormFactory;
use Nette;


final class HomePresenter extends BasePresenter
{

    public function __construct(
        private SignInFormFactory $formFactory
    ) {
        parent::__construct();
    }

    protected function filters(): array
    {
        return [
            'access' => [
                'rules' =>  [
                    [
                        'actions' => ['default'],
                        'auth' => false,
                        'redirect' => 'Projects:',
                    ],
                    [
                        'actions' => ['logout'],
                        'auth' => true,
                    ]
                ],
            ],
        ];
    }

    protected function startup(): void
    {
        parent::startup();
    }

    public function renderDefault(): void
    {
        if ($this->isLoggedIn) {
            $this->redirect('Projects:');
        }
    }

    public function actionLogout()
    {
        $this->user->logout();
        $this->flashMessage('You have been logged out.', 'info');
        $this->redirect('Home:default');
    }

    protected function createComponentSignInForm()
    {
        $form = $this->formFactory->create();
        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    public function signInFormSucceeded($form, $data)
    {
        try {
            $this->getUser()->login($data->email, $data->password);
            $this->redirect('Projects:');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
//        $this->flashMessage('Login has been succesfully.', 'success');
//        $this->redirect('Project');
    }
}
