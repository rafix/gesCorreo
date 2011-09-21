<?php use_stylesheet('job.css') ?>
<?php use_helper('Text') ?>

<div id="job">
<h1><?php echo link_to1($gc_mailbox->getGcArea(), 'area/'.$gc_mailbox->getGcArea()->getSlug()) ?></h1>
  <h2><?php echo link_to1($gc_mailbox->getGcGroup(), 'group/'.$gc_mailbox->getGcGroup()->getSlug()) ?></h2>
  <h3>
      <?php echo $gc_mailbox->getName() ?>
    <small> - <?php echo $gc_mailbox->getEmail() ?></small>
  </h3>



<a href="<?php echo url_for('mailbox/index') ?>">Listar</a>
