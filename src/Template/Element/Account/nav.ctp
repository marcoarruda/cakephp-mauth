<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Ações') ?></li>
    <li><?= $this->Html->link(__('Home'), ['controller' => 'Account', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('Profile'), ['controller' => 'Account', 'action' => 'profile']) ?></li>
    <li><?= $this->Html->link(__('Change Password'), ['controller' => 'Account', 'action' => 'change_password']) ?></li>
    <li><?= $this->Html->link(__('Configurations'), ['controller' => 'Account', 'action' => 'config']) ?></li>
    <li><?= $this->Html->link(__('Logout'), ['controller' => 'Account', 'action' => 'logout']) ?></li>
  </ul>
</nav>
