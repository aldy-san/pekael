<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PEKAEL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="<?= base_url('assets/cms/img/favicon.png'); ?>" rel="icon">
  <link href="<?= base_url('assets/cms/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/cms/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= base_url('assets/cms/img/logo.png'); ?>" alt="">
      </a>
  		<?php if($withSidebar): ?>
      	<i class="bi bi-list toggle-sidebar-btn"></i>
	 	<?php endif ?>
    </div>
    <!--<div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>-->

  		<?php if(isset($user)): ?>
			<nav class="header-nav ms-auto">
				<ul class="d-flex align-items-center">
					<li class="nav-item d-block d-lg-none">
						<a class="nav-link nav-icon search-bar-toggle " href="#">
							<i class="bi bi-search"></i>
						</a>
					</li>
					<li class="nav-item dropdown pe-3">
						<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
							<img src="<?= base_url('assets/cms/img/profile-img.jpg'); ?>" alt="Profile" class="rounded-circle">
							<span class="d-none d-md-block dropdown-toggle ps-2"><?= $user['name']; ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
							<li class="dropdown-header">
								<h6><?= $user['name']; ?></h6>
								<span><?= $user['role']; ?></span>
							</li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center" href="users-profile.html">
									<i class="bi bi-person"></i>
									<span>My Profile</span>
								</a>
							</li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout'); ?>">
									<i class="bi bi-box-arrow-right"></i>
									<span>Sign Out</span>
								</a>
							</li>

						</ul>
					</li>
				</ul>
			</nav>
			<?php endif;?>

  </header>

  <!-- ======= Sidebar ======= -->
  <?php if($withSidebar): ?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) === 'dashboard' ? '' : 'collapsed'; ?>" href="<?= base_url('dashboard'); ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar-->
  <?php endif;?>
	<main id="<?= isset($mainClass) ? $mainClass : ''; ?>">
	<?php if ($this->session->flashdata('alertForm')): ?>
	<div class="alert alert-<?= $this->session->flashdata('alertType'); ?> alert-dismissible fade show" role="alert">
		<?= $this->session->flashdata('alertForm'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php endif; ?>
