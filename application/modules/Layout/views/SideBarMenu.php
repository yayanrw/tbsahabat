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
			</ul>
		<?php } ?>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				PROMO
			</li>
			<li>
				<a href="<?= base_url('banners') ?>" class="<?= $segment == 'banners' ? 'active' : ''; ?>"><i class="material-icons-two-tone">campaign</i> Banners</a>
			</li>
		</ul>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				PRODUCT
			</li>
			<li>
				<a href="<?= base_url('brands') ?>" class="<?= $segment == 'brands' ? 'active' : ''; ?>"><i class="material-icons-two-tone">branding_watermark</i> Brands</a>
			</li>
			<li>
				<a href="<?= base_url('product-categories') ?>" class="<?= $segment == 'product-categories' ? 'active' : ''; ?>"><i class="material-icons-two-tone">category</i> Product Categories</a>
			</li>
			<li>
				<a href="<?= base_url('products') ?>" class="<?= $segment == 'products' ? 'active' : ''; ?>"><i class="material-icons-two-tone">inventory_2</i> Products</a>
			</li>
		</ul>
		<ul class="accordion-menu">
			<li class="sidebar-title">
				SETTING
			</li>
			<li>
				<a href="<?= base_url('about') ?>" class="<?= $segment == 'about' ? 'active' : ''; ?>"><i class="material-icons-two-tone">settings</i> About</a>
			</li>
			<li>
				<a href="<?= base_url('social-medias') ?>" class="<?= $segment == 'social-medias' ? 'active' : ''; ?>"><i class="material-icons-two-tone">groups</i> Social Media</a>
			</li>
		</ul>
	</div>
</div>