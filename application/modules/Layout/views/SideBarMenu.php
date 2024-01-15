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
								if ($segment == 'admin/roles' || $segment == 'admin/users') {
									echo 'open';
								}
								?>">
						<a href="#">
							<i class="material-icons-two-tone">lock</i>Auth <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="<?= base_url('admin/roles') ?>" class="<?= $segment == 'admin/roles' ? 'active' : ''; ?>">Roles</a>
							</li>
							<li>
								<a href="<?= base_url('admin/users') ?>" class="<?= $segment == 'admin/users' ? 'active' : ''; ?>">Users</a>
							</li>
						</ul>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				PROMO
			</li>
			<li>
				<a href="<?= base_url('admin/banners') ?>" class="<?= $segment == 'admin/banners' ? 'active' : ''; ?>"><i class="material-icons-two-tone">campaign</i> Banners</a>
			</li>
		</ul>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				PRODUCT
			</li>
			<li>
				<a href="<?= base_url('admin/brands') ?>" class="<?= $segment == 'admin/brands' ? 'active' : ''; ?>"><i class="material-icons-two-tone">branding_watermark</i> Brands</a>
			</li>
			<li>
				<a href="<?= base_url('admin/categories') ?>" class="<?= $segment == 'admin/categories' ? 'active' : ''; ?>"><i class="material-icons-two-tone">category</i> Product Categories</a>
			</li>
			<li>
				<a href="<?= base_url('admin/products') ?>" class="<?= $segment == 'admin/products' ? 'active' : ''; ?>"><i class="material-icons-two-tone">inventory_2</i> Products</a>
			</li>
		</ul>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				SETTING
			</li>
			<li>
				<a href="<?= base_url('admin/about') ?>" class="<?= $segment == 'admin/about' ? 'active' : ''; ?>"><i class="material-icons-two-tone">settings</i> About</a>
			</li>
			<li>
				<a href="<?= base_url('admin/social-medias') ?>" class="<?= $segment == 'admin/social-medias' ? 'active' : ''; ?>"><i class="material-icons-two-tone">groups</i> Social Media</a>
			</li>
		</ul>
	</div>
</div>