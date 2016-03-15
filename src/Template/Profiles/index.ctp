<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('New Profile'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
  </ul>
</nav>
<div class="profiles index large-9 medium-8 columns content">
  <h3><?= __('Profiles') ?></h3>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('user_id') ?></th>
        <th><?= $this->Paginator->sort('first_name') ?></th>
        <th><?= $this->Paginator->sort('last_name') ?></th>
        <th>Image</th>
        <th class="actions"><?= __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($profiles as $profile): ?>
        <tr>
          <td><?= $this->Number->format($profile->id) ?></td>
          <td><?= $profile->has('user') ? $this->Html->link($profile->user->id, ['controller' => 'Users', 'action' => 'view', $profile->user->id]) : '' ?></td>
          <td><?= h($profile->first_name) ?></td>
          <td><?= h($profile->last_name) ?></td>
          <td><?= $this->Html->image('../' . $profile->image_dir . $profile->image) ?></td>
          <td class="actions">
            <?= $this->Html->link(__('View'), ['action' => 'view', $profile->id]) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $profile->id]) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $profile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profile->id)]) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="paginator">
    <ul class="pagination">
      <?= $this->Paginator->prev('< ' . __('previous')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
  </div>
</div>
