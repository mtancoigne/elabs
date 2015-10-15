<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="initial-scale=1.0, width=device-width" name="viewport">
    <title>
			<?= $this->fetch('title') ?>
    </title>
		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('frontend.css', array('media' => 'screen,projection')) ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>

		<!-- ie -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="page-amber avoid-fout">
		<?= $this->element('layout/pageloader') ?>
		<header class="header header-transparent header-waterfall">
			<ul class="nav nav-list pull-left visible-sm-or-smaller">
				<li>
					<a data-toggle="menu" href="#menu">
						<span class="icon icon-lg">menu</span>
					</a>
				</li>
			</ul>
			<a class="header-logo" href="#">ExperimentsLabs</a>

			<ul class="nav nav-list pull-right">
				<li>
					<a data-toggle="menu" href="#profile">
						<span class="avatar">
							<?php
							if (!is_null($authUser)):
								echo $this->Gravatar->generate($authUser['email']);
							else:
								?><span class="fa fa-user fa-3x"></span></span><?php
							endif;
							?>
					</a>
				</li>
			</ul>
			<ul class="nav nav-list hidden-sm-or-smaller">
				<?= $this->element('layout/mainmenu') ?>
			</ul>

		</header>
		<nav aria-hidden="true" class="menu" id="menu" tabindex="-1">
			<div class="menu-scroll">
				<div class="menu-content">
					<a class="menu-logo" href="#">ExperimentsLabs</a>
					<ul class="nav">
						<?= $this->element('layout/mainmenu') ?>
					</ul>
					<hr>
					<ul class="nav">
						<li>
							<a class="waves-attach" href="#">About</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
		if (!is_null($authUser)):
			echo $this->element('users/usermenu');
		else:
			echo $this->element('users/loginmenu');
		endif;
		?>
		<div class="content">
			<div class="content-heading">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="heading"><?= $this->fetch('title') ?></h1>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="content-inner">
					<div class="row">
						<!--<div class="col-sm-12">-->
						<?= $this->Flash->render() ?>
						<?= $this->fetch('content') ?>
						<!--</div>-->
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<p>© 2015 Elabs</p>
			</div>
			<!--<a class="fbtn fbtn-lg upbtn"><span class="icon">add</span></a>-->
		</footer>
		<!--		<div class="fbtn-container">
					<div class="fbtn-inner">
						<a class="fbtn fbtn-red fbtn-lg" data-toggle="dropdown"><span class="fbtn-text">Links</span><span class="fbtn-ori icon">add</span><span class="fbtn-sub icon">close</span></a>
						<div class="fbtn-dropdown">
							<a class="fbtn" href="https://github.com/Daemonite/material" target="_blank"><span class="fbtn-text">Fork me on GitHub</span><span class="fa fa-github"></span></a>
							<a class="fbtn fbtn-blue" href="https://twitter.com/daemonites" target="_blank"><span class="fbtn-text">Follow Daemon on Twitter</span><span class="fa fa-twitter"></span></a>
							<a class="fbtn fbtn-alt" href="http://www.daemon.com.au/" target="_blank"><span class="fbtn-text">Visit Daemon Website</span><span class="icon">link</span></a>
						</div>
					</div>
				</div>-->

		<!-- Javascript at the end -->
		<?= $this->Html->script('lib/jquery-1.11.3.min.js') ?>
		<?= $this->Html->script('material.min.js') ?>
		<!-- Custom scripts -->
		<?= $this->Html->script('custom.js') ?>
		<?= $this->fetch('pageBottomScripts') ?>
	</body>
</html>
