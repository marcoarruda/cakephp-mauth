<?php
namespace MAuth\Controller;

use MAuth\Controller\AppController;

class GroupsController extends AppController
{

  public function beforeFilter(\Cake\Event\Event $event) {
    parent::beforeFilter($event);
    $this->Auth->allow();
  }

  public function index()
  {
    $this->set('groups', $this->paginate($this->Groups));
    $this->set('_serialize', ['groups']);
  }

  public function view($id = null)
  {
    $group = $this->Groups->get($id, [
      'contain' => ['Users']
    ]);
    $this->set('group', $group);
    $this->set('_serialize', ['group']);
  }

  public function add()
  {
    $group = $this->Groups->newEntity();
    if ($this->request->is('post')) {
      $group = $this->Groups->patchEntity($group, $this->request->data);
      if ($this->Groups->save($group)) {
        $this->Flash->success(__('The group has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The group could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('group'));
    $this->set('_serialize', ['group']);
  }

  public function edit($id = null)
  {
    $group = $this->Groups->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $group = $this->Groups->patchEntity($group, $this->request->data);
      if ($this->Groups->save($group)) {
        $this->Flash->success(__('The group has been saved.'));
        return $this->redirect(['action' => 'index']);
      } else {
        $this->Flash->error(__('The group could not be saved. Please, try again.'));
      }
    }
    $this->set(compact('group'));
    $this->set('_serialize', ['group']);
  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $group = $this->Groups->get($id);
    if ($this->Groups->delete($group)) {
      $this->Flash->success(__('The group has been deleted.'));
    } else {
      $this->Flash->error(__('The group could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }
}
