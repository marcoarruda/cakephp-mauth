<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
  </head>
  <body>
    <nav class="top-bar expanded" data-topbar role="navigation">
      <ul class="title-area large-3 medium-4 columns">
        <li class="name">
          <h1><a href=""><?= $this->fetch('title') ?></a></h1>
        </li>
      </ul>
      <?= $this->Element('Default/nav'); ?>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
      <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
  </body>
</html>
