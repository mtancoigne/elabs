<?php
$this->start('mainMenu');
?>
<li>
  <?php echo $this->Html->link(__d('admin', 'Dashboard'), '#') ?>
</li>
<li>
  <?php echo $this->Html->link(__d('posts', 'Articles'), ['prefix' => 'admin', 'controller' => 'posts', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('projects', 'Projects'), ['prefix' => 'admin', 'controller' => 'projects', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('files', 'Files'), ['prefix' => 'admin', 'controller' => 'files', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('users', 'Users'), ['prefix' => 'admin', 'controller' => 'users', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('licenses', 'Licenses'), ['prefix' => 'admin', 'controller' => 'licenses', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('tags', 'Tags'), ['prefix' => 'admin', 'controller' => 'tags', 'action' => 'index']) ?>
</li>
<li>
  <?php echo $this->Html->link(__d('reports', 'Reports'), ['prefix' => 'admin', 'controller' => 'reports', 'action' => 'index']) ?>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __d('admin', 'Maintenance') ?> <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li class="dropdown-header">Acts:</li>
        <li><?php echo $this->Form->postLink(__('{0}&nbsp;{1}', [$this->Html->icon('reload'), __('Rebuild table')]), ['controller' => 'Acts', 'action' => 'clean'], ['escape' => false, 'confirm' => _('Are you sure you want to clear the table and rebuild it ?')]) ?></li>
    </ul>
</li>
<li>

</li>
<?php
$this->end();
$this->start('secondMenu');
?>
<li>
  <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon('eye'), __d('admin', 'View site online')]), '/', array_merge($linkConfig, ['target' => '_blank'])) ?>
</li>
<li>
  <?php echo $this->Html->link(__('{0}&nbsp;{1}', [$this->Html->icon('sign-out'), __d('users', 'Logout')]), ['prefix' => false, 'controller' => 'users', 'action' => 'logout']) ?>
</li>
<?php
$this->end();
