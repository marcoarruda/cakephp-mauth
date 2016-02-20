<?php

namespace MAuth\Controller;

use MAuth\Controller\AppController;

class UsersController extends AppController {

  public function beforeFilter(\Cake\Event\Event $event) {
    parent::beforeFilter($event);
    $this->Auth->allow();
  }

  public function index() {
    $this->paginate = [
      'contain' => ['Groups']
    ];
    $this->set('users', $this->paginate($this->Users));
    $this->set('_serialize', ['users']);
  }

  public function view($id = null) {
    $user = $this->Users->get($id, [
      'contain' => ['Groups']
    ]);
    $this->set('user', $user);
    $this->set('_serialize', ['user']);
  }

  public function add() {
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->data);
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $groups = $this->Users->Groups->find('list', ['limit' => 200]);
    $this->set(compact('user', 'groups'));
    $this->set('_serialize', ['user']);
  }

  public function edit($id = null) {
    $user = $this->Users->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->data);
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $groups = $this->Users->Groups->find('list', ['limit' => 200]);
    $this->set(compact('user', 'groups'));
    $this->set('_serialize', ['user']);
  }

  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('The user has been deleted.'));
    } else {
      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }

}
