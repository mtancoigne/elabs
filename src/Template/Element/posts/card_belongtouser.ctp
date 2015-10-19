<?php
/**
 * Used vars:
 *
 * $data[
 *   id
 *   title
 *   publication date
 *   modified
 *   excerpt
 * ] 
 *   
 */
?>
<div class="card">
	<div class="card-side pull-left">
		<span class="card-heading">
			<?= $this->Html->link(__d('elabs', 'Read more...'), ['prefix' => false, 'controller' => 'Posts', 'action' => 'view', $this->Number->format($data['id'])], ['class' => 'waves-attach waves-effect btn btn-flat']) ?>
		</span>
	</div>
	<div class="card-main">
		<!-- Header -->
		<div class="card-header">
			<!-- Icon -->
			<div class="card-header-side pull-left">
				<i class="fa fa-font fa-3x"></i>
			</div>
			<!-- Title -->
			<div class="card-inner">
				<div class="text-overflow"><?= h($data['title']) ?></div>
				<em class="subtitle">
					<?php
					echo __d('elabs', 'Published on: {0}', h($data['publication_date']));
					if ($data['publication_date'] < $data['modified']):
						echo ' - ' . __d('elabs', 'Updated on: {0}', h($data['modified']));
					endif;
					?>
				</em>
			</div>
		</div>
		<!-- Content -->
		<div class="card-inner">
			<p>
				<?= $this->Markdown->transform($data['excerpt']) ?>
			</p>
		</div>
	</div>
</div>