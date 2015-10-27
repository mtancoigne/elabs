<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?php echo __('Actions') ?></li>
        <li><?php echo $this->Html->link(__('List Tags'), ['action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('List Itemtags'), ['controller' => 'Itemtags', 'action' => 'index']) ?></li>
        <li><?php echo $this->Html->link(__('New Itemtag'), ['controller' => 'Itemtags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tags form large-9 medium-8 columns content">
    <?php echo $this->Form->create($tag) ?>
    <fieldset>
        <legend><?php echo __('Add Tag') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')) ?>
    <?php echo $this->Form->end() ?>
</div>
