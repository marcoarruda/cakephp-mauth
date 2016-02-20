<?php

namespace MAuth\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;

// just a comment
class AppController extends Controller {

  public $userAuth = [];

  public function initialize() {
    parent::initialize();

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');
    $this->loadComponent('Auth', [
      'authenticate' => [
        'Form' => [
          'userModel' => 'MAuth.Users',
          'fields' => [
            'username' => 'email',
            'password' => 'password'
          ]
        ]
      ],
      'loginAction' => [
        'controller' => 'Account',
        'action' => 'login'
      ],
      'loginRedirect' => [
        'controller' => 'Account',
        'action' => 'home'
      ],
      'logoutRedirect' => [
        'controller' => 'Account',
        'action' => 'login'
      ],
      'unauthorizedRedirect' => $this->referer(),
    ]);

    // Allow the display action so our pages controller
    // continues to work.
    $this->Auth->allow(['display']);

    I18n::locale('pt_BR');
  }
  public function isAuthorized($user) {
    echo "AppController - isAuthorized";
    return true;
  }
  public function beforeFilter(Event $event) {
    $this->userAuth = $this->Auth->user();
    $this->set('userAuth', $this->userAuth);
    $this->viewBuilder()->layout('MAuth.default');
  }
  public function beforeRender(Event $event) {
    if (!array_key_exists('_serialize', $this->viewVars) &&
      in_array($this->response->type(), ['application/json', 'application/xml'])
    ) {
      $this->set('_serialize', true);
    }
  }

}
