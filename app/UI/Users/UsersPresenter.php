<?php
declare(strict_types=1);

namespace App\UI\Users;

use App\Forms\ProfileFormFactory;
use App\Model\UserRepository;
use App\UI\BasePresenter;
use Nette\Application\UI\Presenter;
use Nette\Neon\Exception;

class UsersPresenter extends BasePresenter {

    public function __construct(
        private UserRepository $userRepository,
        private ProfileFormFactory $formFactory,
    )
    {
        parent::__construct();
    }

    protected function filters()
    {
        return [
            'access' => [
                'rules' =>  [
                    [
                        'actions' => ['*'],
                        'auth' => true,
                        'redirect' => 'Home:',
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

    protected function getRoles(): array
    {
        return $this->userRepository->getRoleOptions();
    }

    public function renderDefault(): void
    {
        $profiles = $this->userRepository->find();
        $this->template->profiles = $profiles;
        $this->template->roleOptions = $this->getRoles();
    }

    public function renderCreate()
    {
        $this->template->roleOptions = $this->getRoles();
    }

    public function renderProfile(int $id): void
    {
        $profile = $this->userRepository->findById($id);

        if (!$profile) {
            $this->error('Profil užívateľa sa nenašiel.');
        }

        $this->template->profile = $profile;

        $this->getComponent('profileForm')
            ->setDefaults($profile->toArray());
    }

    public function actionDelete(int $id): void
    {
        //...
    }

    protected function createComponentUserForm()
    {
        $form = $this->formFactory->create();
        $form->onSuccess[] = [$this, 'profileFormSucceeded'];
        return $form;
    }
    protected function createComponentProfileForm()
    {
        $form = $this->formFactory->update();
        $form->onSuccess[] = [$this, 'profileFormSucceeded'];
        return $form;
    }

    public function profileFormSucceeded($form, $data)
    {
        try {
            $profileId = (int)$this->getParameter('id');

            unset($data['password_confirm']);

            if($profileId) {

                if(empty($data['password'])) {
                    unset($data['password']);
                }

                $this->userRepository->updateById($profileId, $data);
                $this->flashMessage('Uživateľ bol úspešne upravený.', 'success');
            }
            else {
                $this->userRepository->create($data);
                $this->flashMessage('Uživateľ bol úspešne založený.', 'success');
            }
        } catch (Exception $e) {
            $form->addError('Ukladanie zlyhalo.');
        }
        $this->redirect('Users:');
    }
}