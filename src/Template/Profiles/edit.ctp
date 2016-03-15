<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?=
      $this->Form->postLink(
        __('Delete'), ['action' => 'delete', $profile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profile->id)]
      )
      ?></li>
    <li><?= $this->Html->link(__('List Profiles'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
  </ul>
</nav>
<div class="profiles form large-9 medium-8 columns content">
  <?= $this->Form->create($profile, ['type' => 'file']) ?>
  <fieldset>
    <legend><?= __('Edit Profile') ?></legend>
    <?php
    echo $this->Form->input('user_id', ['options' => $users]);
    echo $this->Form->input('first_name');
    echo $this->Form->input('last_name');
    echo $this->Form->input('image', ['type' => 'file']);
    ?>
  </fieldset>
  <?= $this->Form->button(__('Submit')) ?>
  <?= $this->Form->end() ?>
</div>
