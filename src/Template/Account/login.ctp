<div class="index large-9 medium-8 columns content">
  <h2>Login</h2>
  <?= $this->Form->create() ?>
  <?= $this->Form->input('email') ?>
  <?= $this->Form->input('password') ?>
  <br />
  <?= $this->Html->link('Forget password?', ['action' => 'forget']); ?>
  <br /><br />
  <?= $this->Form->button('Login') ?>
  <?= $this->Form->end() ?>
</div>