<?php use_stylesheet('jobs.css') ?>

<div class="category">
  <h1><?php echo "Creados recientemente" ?></h1>
</div>

<?php include_partial('mailbox/list', array('gc_mailbox_list' => $pager->getResults())) ?>

<?php if ($pager->haveToPaginate()): ?>
  <div class="pagination">
    <a href="<?php echo url_for('homepage', $gc_mailbox_list) ?>?page=1">
      <img src="/images/first.png" alt="First page" />
    </a>

    <a href="<?php echo url_for('homepage', $gc_mailbox_list) ?>page=<?php echo $pager->getPreviousPage() ?>">
      <img src="/images/previous.png" alt="Previous page" title="Previous page" />
    </a>

    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page ?>
      <?php else: ?>
        <a href="<?php echo url_for('homepage', $gc_mailbox_list) ?>page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>

    <a href="<?php echo url_for('homepage', $gc_mailbox_list) ?>page=<?php echo $pager->getNextPage() ?>">
      <img src="/images/next.png" alt="Next page" title="Next page" />
    </a>

    <a href="<?php echo url_for('homepage', $gc_mailbox_list) ?>page=<?php echo $pager->getLastPage() ?>">
      <img src="/images/last.png" alt="Last page" title="Last page" />
    </a>
  </div>
<?php endif; ?>

<div class="pagination_desc">
  <strong><?php echo $pager->getNbResults() ?></strong> buzones en el servidor

  <?php if ($pager->haveToPaginate()): ?>
    - página <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>