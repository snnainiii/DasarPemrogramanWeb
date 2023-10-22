<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

	<!-- =======================
Page Banner START -->
	<section class="pt-0">
		<!-- Main banner background image -->
		<div class="container-fluid px-0">
			<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url(../assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
			</div>
		</div>
		<div class="container mt-n4">
			<div class="row">
				<!-- Profile banner START -->
				<div class="col-12">
					<div class="card bg-transparent card-body p-0">
						<div class="row d-flex justify-content-between">
							<!-- Avatar -->
							<div class="col-auto mt-4 mt-md-0">
								<div class="avatar avatar-xxl mt-n3">
									<img class="avatar-img rounded-circle border border-white border-3 shadow" src="../assets/images/avatar/01.jpg" alt="">
								</div>
							</div>
							<!-- Profile info -->
							<div class="col d-md-flex justify-content-between align-items-center mt-4">
								<div>
									<h1 class="my-1 fs-4">Lori Stevens <i class="bi bi-patch-check-fill text-info small"></i></h1>
								</div>
							</div>
						</div>
					</div>
					<!-- Profile banner END -->

					<!-- Advanced filter responsive toggler START -->
					<!-- Divider -->
					<hr class="d-xl-none">
					<div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
						<a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
						<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
							<i class="fas fa-sliders-h"></i>
						</button>
					</div>
					<!-- Advanced filter responsive toggler END -->
				</div>
			</div>
		</div>
	</section>
	<!-- =======================
Page Banner END -->

	<!-- =======================
Page content START -->
	<section class="pt-0">
		<div class="container">
			<div class="row">

				<!-- Right sidebar START -->
				<div class="col-xl-3">
					<!-- Responsive offcanvas body START -->
					<nav class="navbar navbar-light navbar-expand-xl mx-0">
						<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
							<!-- Offcanvas header -->
							<div class="offcanvas-header bg-light">
								<h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<!-- Offcanvas body -->
							<div class="offcanvas-body p-3 p-xl-0">
								<div class="bg-dark border rounded-3 pb-0 p-3 w-100">
									<!-- Dashboard menu -->
									<div class="list-group list-group-dark list-group-borderless">
										<a class="list-group-item active" href="edit-profile.php"><i class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
										<a class="list-group-item" href="delete-account.php"><i class="bi bi-trash fa-fw me-2"></i>Delete Profile</a>
										<a class="list-group-item text-danger bg-danger-soft-hover" href="sign-in.html"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign
											Out</a>
									</div>
								</div>
							</div>
						</div>
					</nav>
					<!-- Responsive offcanvas body END -->
				</div>
				<!-- Right sidebar END -->

				<!-- Main content START -->
				<div class="col-xl-9">
					<!-- Edit profile START -->
					<div class="card bg-transparent border rounded-3">
						<!-- Card header -->
						<div class="card-header bg-transparent border-bottom">
							<h3 class="card-header-title mb-0">Edit Profile</h3>
						</div>
						<!-- Card body START -->
						<div class="card-body">
							<!-- Form -->
							<form class="row g-4">

								<!-- Profile picture -->
								<div class="col-12 justify-content-center align-items-center">
									<label class="form-label">Profile picture</label>
									<div class="d-flex align-items-center">
										<label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
											<!-- Avatar place holder -->
											<span class="avatar avatar-xl">
												<img id="uploadfile-1-preview" class="avatar-img rounded-circle border border-white border-3 shadow" src="../assets/images/avatar/07.jpg" alt="">
											</span>
											<!-- Remove btn -->
											<button type="button" class="uploadremove"><i class="bi bi-x text-white"></i></button>
										</label>
										<!-- Upload button -->
										<label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
										<input id="uploadfile-1" class="form-control d-none" type="file">
									</div>
								</div>

								<!-- Full name -->
								<div class="col-6">
									<label class="form-label">Nama lengkap</label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Masukkan nama lengkap sesuai KTP">
									</div>
								</div>

								<!-- Username -->
								<div class="col-md-6">
									<label class="form-label">Username</label>
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Masukkan username">
									</div>
								</div>

								<!-- Email id -->
								<div class="col-md-6">
									<label class="form-label">Tanggal lahir</label>
									<input class="form-control" type="date" placeholder="Masukkan tanggal lahir">
								</div>

								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">Nomor telepon</label>
									<input type="text" class="form-control" placeholder="Masukkan nomor telepon">
								</div>

								<!-- Location -->
								<div class="col-md-6">
									<label class="form-label">Email</label>
									<input class="form-control" type="email" placeholder="Masukkan email">
								</div>

								<!-- Save button -->
								<div class="d-sm-flex justify-content-end">
									<button type="button" class="btn btn-primary mb-0">Save changes</button>
								</div>
							</form>
						</div>
						<!-- Card body END -->
					</div>
					<!-- Edit profile END -->

					<div class="row g-4 mt-3">

						<!-- Password change START -->
						<div class="col-lg-6">
							<div class="card border bg-transparent rounded-3">
								<!-- Card header -->
								<div class="card-header bg-transparent border-bottom">
									<h5 class="card-header-title mb-0">Update password</h5>
								</div>
								<!-- Card body START -->
								<div class="card-body">
									<!-- Current password -->
									<div class="mb-3">
										<label class="form-label">Current password</label>
										<input class="form-control" type="password" placeholder="Enter current password">
									</div>
									<!-- New password -->
									<div class="mb-3">
										<label class="form-label"> Enter new password</label>
										<div class="input-group">
											<input class="form-control" type="password" placeholder="Enter new password">
											<span class="input-group-text p-0 bg-transparent">
												<i class="far fa-eye cursor-pointer p-2 w-40px"></i>
											</span>
										</div>
										<div class="rounded mt-1" id="psw-strength"></div>
									</div>
									<!-- Confirm password -->
									<div>
										<label class="form-label">Confirm new password</label>
										<input class="form-control" type="password" placeholder="Enter new password">
									</div>
									<!-- Button -->
									<div class="d-flex justify-content-end mt-4">
										<button type="button" class="btn btn-primary mb-0">Change password</button>
									</div>
								</div>
								<!-- Card body END -->
							</div>
						</div>
						<!-- Password change end -->
					</div>
				</div>
				<!-- Main content END -->
			</div><!-- Row END -->
		</div>
	</section>
	<!-- =======================
Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>