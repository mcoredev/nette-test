<?php

declare(strict_types=1);

namespace App\UI;

use Nette\Application\BadRequestException;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter {

    public $isLoggedIn = false;

    protected function startup(): void
    {
        parent::startup();

        $this->isLoggedIn = $this->getUser()->isLoggedIn();

        $this->accesRequestAction();

    }

    protected function accesRequestAction()
    {
        $filters = $this->filters();
        $requestAction = $this->request->getParameter('action');
        $userAuth = $this->isLoggedIn ? 'auth' : 'guest';

        if(isset($filters['access'])) {
            $filerRules = $filters['access']['rules'];

            foreach($filerRules as $rule) {

                foreach ($rule['actions'] as $action) {
                    if($action === $requestAction || $action === '*') {

                        if($rule['auth'] !== $this->isLoggedIn ) {
                            if(isset($rule['redirect'])) {
                                $this->redirect($rule['redirect']);
                            }
                            throw new BadRequestException('Access denied', 403);
                        }
                    }
                }
            }
        }
    }

    protected function filters()
    {
        return [];
    }
}