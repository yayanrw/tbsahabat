<?php
$segment = $this->uri->segment(1) . '/' . $this->uri->segment(2);
$currentRole = $this->session->userdata('role_id');
//1 = Super User
//2 = SPV
//3 = Staff
//4 = Line Coordinator
//5 = Quality Control
?>
<div class="app-sidebar">
	<div class="logo logo-sm hidden-sidebar-logo">
		<a href="<?= base_url() ?>"><?= APPS_NAME ?></a>
	</div>
	<div class="app-menu">
		<?php if (in_array($currentRole, [1, 2])) { ?>
			<ul class="accordion-menu">
				<li class="sidebar-title">
					Master Data
				</li>
				<?php if ($currentRole == 1) { ?>
					<li class="<?php
								if ($segment == 'master/roles' || $segment == 'master/users') {
									echo 'open';
								}
								?>">
						<a href="#">
							<i class="material-icons-two-tone">lock</i>Auth <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?= base_url('master/roles') ?>" class="<?= $segment == 'master/roles' ? 'active' : ''; ?>">Roles</a>
							</li>
							<li>
								<a href="<?= base_url('master/users') ?>" class="<?= $segment == 'master/users' ? 'active' : ''; ?>">Users</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<li>
					<a href="<?= base_url('master/marketplace') ?>" class="<?= $segment == 'master/marketplace' ? 'active' : ''; ?>"><i class="material-icons-two-tone">store</i> Market Place</a>
				</li>
			</ul>
		<?php } ?>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				<?= APPS_NAME; ?>
			</li>
			<li>
				<a href="<?= base_url('events') ?>" class="<?= $segment == 'events' ? 'active' : ''; ?>"><i class="material-icons-two-tone">event</i> Events</a>
			</li>
		</ul>
	</div>
</div>
