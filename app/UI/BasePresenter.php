<?php

declare(strict_types=1);

namespace App\UI;

use Nette\Application\BadRequestException;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Template;

class BasePresenter extends Presenter {

    public $isLoggedIn = false;
    public $userRoles = [];
    public $isUserAdmin = false;

    protected function startup(): void
    {
        parent::startup();

        $this->isLoggedIn = $this->getUser()->isLoggedIn();
        $this->userRoles = $this->getUser()->getRoles();
        $this->isUserAdmin = in_array('admin',$this->userRoles);

        $this->accessRequestAction();
    }

    protected function accessRequestAction()
    {
        $filters = $this->filters();
        $requestAction = $this->request->getParameter('action');

        if(isset($filters['access'])) {
            $filerRules = $filters['access']['rules'];

            foreach($filerRules as $rule) {

                foreach ($rule['actions'] as $action) {
                    if($action === $requestAction || $action === '*') {

                        if((isset($rule['auth']) && $rule['auth'] !== $this->isLoggedIn) || (isset($rule['role']) && !$this->isUserAdmin && !in_array($rule['role'],$this->userRoles)) ) {

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

    public function userHasRole($role = null)
    {
        if($this->isUserAdmin) {
            return true;
        }

        return $this->user->isLoggedIn() && in_array($role, $this->user->getRoles());
    }

    protected function createTemplate(?string $class = null): Template
    {
        $template = parent::createTemplate($class);
        $template->addFilter('hasRole', function ($input, $role) {
            return $this->userHasRole($role) ? $input : null;
        });
        return $template;
    }

    protected function filters()
    {
        return [];
    }
}