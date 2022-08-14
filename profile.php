<?php
require_once('themes/php/session.php');
require_once('includes/templates/header.php');

?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="card rounded-0 mt-3 border-primary">

				<div class="card-header border-primary">
					<ul class="nav nav-tabs card-header-tabs">

						<li class="nav-item">
							<a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
						</li>

						<li class="nav-item">
							<a href="#editProfile" class="nav-link  font-weight-bold" data-toggle="tab">Edit Profile</a>
						</li>

						<li class="nav-item">
							<a href="#changePass" class="nav-link  font-weight-bold" data-toggle="tab">Change Password</a>
						</li>


					</ul>
				</div>
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane container active" id="profile">
							<div class="card-deck">
								<div class="card border-primary">
									<div class="card-header bg-primary text-light text-center lead">
										User ID : <?= $cid;?>
									</div>
									<div class="card-body">
										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name:</b> <?= $cname;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail:</b> <?= $cemail;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Gender:</b> <?= $cgender;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Date Of Birth:</b> <?= $cdob;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Phone:</b> <?= $cphone;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Registered On:</b> <?= $reg_on;?></p>

										<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail Verified:</b> <?= $verified;?>

											<?php if($verified == 'Not Verified!'):?>

												<a href="#" id="verify-email" class="float-right">Verify Now</a>	

											<?php endif;  ?>	
										</p>
										<div class="clearfix"></div>
									</div>
								</div>

								<div class="card border-primary align-self-center">

									<?php if(!$cphoto): ?>
										<img src="themes/img/avatar.png" class="img-thumbnail img-fluid" width="408px">

									<?php else: ?>	
										<img src="<?= 'themes/img/'.$cphoto; ?>" class="img-thumbnail img-fluid" width="408px">
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>	

			</div>
		</div>	
	</div>






















	<?php

	require_once('./includes/templates/footer.php');

	?>