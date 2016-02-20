<?= $this->Element('MAuth.Account/nav') ?>
<div class="index large-9 medium-8 columns content">
  <?php
  echo $this->Form->create($profile);
  echo $this->Form->input('first_name');
  echo $this->Form->input('last_name');
  echo $this->Form->button(__('Submit'));
  echo $this->Form->end();
  ?>
</div>