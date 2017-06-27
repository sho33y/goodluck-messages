<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Class AdminController
 * @package App\Controller\Admin
 */
class AdminController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Auth', [
            // 'authorize' => 'Controller',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Members',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                ]
            ],
            'loginAction' => [
                'controller' => 'Admin',
                'action'     => 'login',
                'prefix'     => 'admin',
            ],
            'loginRedirect' => [
                'controller' => 'Goodlucks',
                'action'     => 'index',
                'prefix'     => 'admin',
            ],
            'logoutRedirect' => [
                'controller' => 'Admin',
                'action'     => 'login',
                'prefix'     => 'admin',
            ],
            'authError' => '管理者としてログインする必要があります',
            'unauthorizedRedirect' => $this->referer(),
        ]);

        $this->viewBuilder()->setLayout('admin');

        $this->authUser = $this->Auth->user() ? $this->Auth->user() : null;
        $this->set('authUser', $this->authUser);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login', 'logout']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ユーザー名またはパスワードが正しくありません。もう一度お試しください。'));
        }
    }

    public function logout()
    {
        $this->Flash->success('ログアウトしました。');
        return $this->redirect($this->Auth->logout());
    }

}
