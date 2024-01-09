<?php
$segment = $this->uri->segment(1) . '/' . $this->uri->segment(2);
?>
<div class="app-menu">
	<div class="container">
		<ul class="menu-list">
			<li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active-page' : ''; ?>">
				<a href="<?= base_url('dashboard'); ?>" class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
			</li>
			<li class="<?= $this->uri->segment(1) == 'Manifesting' ? 'active-page' : ''; ?>">
				<a href="#">Manifesting<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
				<ul class="sub-menu">
					<li>
						<a href="<?= base_url('Manifesting/RegisterProduct'); ?>" class="<?= $segment  == 'Manifesting/Register' ? 'active' : ''; ?>">Register Product</a>
					</li>
					<li>
						<a href="<?= base_url('Manifesting/HistoryRegisterProduct'); ?>" class="<?= $segment  == 'Manifesting/HistoryRegisterProduct' ? 'active' : ''; ?>">History Register Product</a>
					</li>
					<div class="divider" style="margin: 5px 0px;"></div>
					<li>
						<a href="<?= base_url('Manifesting/Create'); ?>" class="<?= $segment  == 'Manifesting/Create' ? 'active' : ''; ?>">Create New Manifest</a>
					</li>
					<li>
						<a href="<?= base_url('Manifesting/History'); ?>" class="<?= $segment  == 'Manifesting/History' ? 'active' : ''; ?>">History Manifest</a>
					</li>
					<div class="divider" style="margin: 5px 0px;"></div>
					<li>
						<a href="<?= base_url('Manifesting/ScanOut'); ?>" class="<?= $segment  == 'Manifesting/ScanOut' ? 'active' : ''; ?>">Scan Out</a>
					</li>
					<li>
						<a href="<?= base_url('Manifesting/HistoryScanOut'); ?>" class="<?= $segment  == 'Manifesting/HistoryScanOut' ? 'active' : ''; ?>">History Scan Out</a>
					</li>
				</ul>
			</li>
			<li class="<?= $this->uri->segment(1) == 'Master' ? 'active-page' : ''; ?>">
				<a href="#">Master<i class="material-icons has-sub-menu">keyboard_arrow_down</i></a>
				<ul class="sub-menu">
					<?php if ($this->session->userdata('role_id') == 1) { ?>
						<li>
							<a href="#" class="
                        <?php
						if ($segment == 'Master/Roles' || $segment == 'Master/Users') {
							echo 'active';
						}
						?>">Auth<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
							<ul class="sub-menu">
								<li>
									<a href="<?= base_url('Master/Roles'); ?>" class="<?= $segment  == 'Master/Roles' ? 'active' : ''; ?>">Roles</a>
								</li>
								<li>
									<a href="<?= base_url('Master/Users'); ?>" class="<?= $segment  == 'Master/Users' ? 'active' : ''; ?>">Users</a>
								</li>
							</ul>
						</li>
					<?php } ?>
					<li>
						<a href="#" class="
                        <?php
						if ($segment == 'Master/Product' || $segment == 'Master/ProductKosme') {
							echo 'active';
						}
						?>">Product<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
						<ul class="sub-menu">
							<li>
								<a href="<?= base_url('Master/Product'); ?>" class="<?= $segment  == 'Master/Product' ? 'active' : ''; ?>">Product</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?= base_url('Master/Warehouse'); ?>" class="<?= $segment  == 'Master/Warehouse' ? 'active' : ''; ?>">Warehouse</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>