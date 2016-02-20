<?php

namespace MAuth\Controller;

use MAuth\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

class AccountController extends AppController {

  // Controller
  public function initialize() {
    parent::initialize();
  }
  public function isAuthorized($user) {
    return true;
  }
  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->viewBuilder()->layout('default');
    $this->Auth->allow(['login', 'logout', 'forget']);
  }
  public function beforeRender(Event $event) {
    parent::beforeRender($event);
  }
  // User actions
  public function login() {
    if ($this->Auth->user() != null) {
      $this->redirect(['action' => 'home']);
    }
    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user) {
        $this->Auth->setUser($user);
        return $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error(__('Username or password is incorrect'), [
        'key' => 'auth'
      ]);
    }
  }
  public function logout() {
    $this->Flash->success(__('You are now logged out.'));
    return $this->redirect($this->Auth->logout());
  }
  public function index() {
    
  }
  public function profile() {
    $this->loadModel('MAuth.Profiles');
    $conditions = ['Profiles.user_id' => $this->userAuth['id']];
    $query = $this->Profiles->find('all', compact('conditions'));
    $find_profile = $query->first();
    if ($find_profile == null) {
      $this->_profile_add();
    } else {
      $this->_profile_edit($find_profile->id);
    }
  }
  public function forget() {
    $email = new Email();
    $email->transport('default');
    $email->deliver('marco.nc.arruda@gmail.com', 'Subject', 'Message', ['from' => 'me@example.com']);
    $this->redirect(['action' => 'login']);
    if($this->request->is('post')) {
    }
  }
  private function _profile_add() {
    $profile = $this->Profiles->newEntity();
    if ($this->request->is('post')) {
      $profile = $this->Profiles->patchEntity($profile, $this->request->data);
      $profile->user_id = $this->userAuth['id'];
      if ($this->Profiles->save($profile)) {
        $this->Flash->success(__('The profile has been saved.'));
        return $this->redirect(['action' => 'profile']);
      } else {
        $this->Flash->error(__('The profile could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('profile'));
    $this->set('_serialize', ['profile']);
  }
  private function _profile_edit($id) {
    $profile = $this->Profiles->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $profile = $this->Profiles->patchEntity($profile, $this->request->data);
      $profile->user_id = $this->userAuth['id'];
      if ($this->Profiles->save($profile)) {
        $this->Flash->success(__('The profile has been saved.'));
        return $this->redirect(['action' => 'profile']);
      } else {
        $this->Flash->error(__('The profile could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('profile'));
    $this->set('_serialize', ['profile']);
  }
  public function config() {
    
  }

}
