<table class="jobs">
  <?php foreach ($gc_mailbox_list as $i => $gc_mailbox): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
      <td class="location"><?php echo $gc_mailbox->getName() ?></td>
      <td class="position"><?php echo link_to($gc_mailbox->getUsername(), 'mailbox_show_user', $gc_mailbox) ?></td>
      <td class="company"><?php echo $gc_mailbox->getEmail() ?></td>
    </tr>
  <?php endforeach; ?>
</table>