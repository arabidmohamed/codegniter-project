<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	$content = 'Content_'.$__lang;
	$title = 'Title_'.$__lang;
?>



<!-- Header -->
		<header class="header header-sub">
			<div class="container">
				<div class="header-box text-lg-left text-center">
					<h1 class="title mb-4"><?=getSystemString('about_dnet')?></h1>
					<nav class="breadcrumb">
						<a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString(218)?></a>
						<span class="breadcrumb-item active"><?=getSystemString('about_dnet')?></span>
					</nav>
				</div>
			</div>
		</header>
		<!-- End Header -->
		<!-- about-section" -->
		<section class="about-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-12">
						<div class="title-section">
							<h2 class="title"> <?=getSystemString('about_text')?><br> <?=getSystemString('about_dnet_text')?></h2>
							<p class="info">
							<?php echo $about[4]->$content; ?>
							</p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
	        <div class="col-lg-10">
	          <div class="counters">
	            <div class="counter-box border-right border-bottom">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="38.25" viewBox="0 0 40 38.25"><g transform="translate(0 -33)"><path  d="M175.8,46.594a6.8,6.8,0,1,0-6.8-6.8A6.8,6.8,0,0,0,175.8,46.594Zm0-11.25a4.453,4.453,0,1,1-4.453,4.453A4.458,4.458,0,0,1,175.8,35.344Z" transform="translate(-155.797)"/><path  d="M381.3,105.594a4.3,4.3,0,1,0-4.3-4.3A4.3,4.3,0,0,0,381.3,105.594Zm0-6.25a1.953,1.953,0,1,1-1.953,1.953A1.955,1.955,0,0,1,381.3,99.344Z" transform="translate(-347.547 -59)"/><path  d="M34.7,241H32.883a5.34,5.34,0,0,0-4.82,3.638A8.851,8.851,0,0,0,21.092,241H18.908a8.851,8.851,0,0,0-6.971,3.638A5.34,5.34,0,0,0,7.117,241H5.3C2.38,241,0,243.8,0,247.239v10.1a2.531,2.531,0,0,0,2.3,2.708H9.464A2.971,2.971,0,0,0,12.189,263H27.811a2.971,2.971,0,0,0,2.725-2.958H37.62a2.621,2.621,0,0,0,2.38-2.8v-10C40,243.8,37.62,241,34.7,241ZM2.344,247.239A3.247,3.247,0,0,1,5.3,243.773H7.117a3.247,3.247,0,0,1,2.961,3.465v.949c-.788,2.428-.625,3.883-.625,9.081H2.344ZM28.2,259.763a.433.433,0,0,1-.392.464H12.189a.433.433,0,0,1-.392-.464v-7.576c0-4.639,3.19-8.414,7.111-8.414h2.184c3.921,0,7.111,3.774,7.111,8.414Zm9.453-2.525c0,.048.437.031-7.109.031,0-5.237.162-6.657-.625-9.081v-.949a3.247,3.247,0,0,1,2.961-3.465H34.7a3.247,3.247,0,0,1,2.961,3.465Z" transform="translate(0 -191.75)"/><path  d="M29.3,105.594a4.3,4.3,0,1,0-4.3-4.3A4.3,4.3,0,0,0,29.3,105.594Zm0-6.25a1.953,1.953,0,1,1-1.953,1.953A1.955,1.955,0,0,1,29.3,99.344Z" transform="translate(-23.047 -59)"/></g></svg>
	              </div>
	              <?php
	                $client = 'clients_'.$__lang;
	                $no = $achievement->total_client;
	                $string = $achievement->$client;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	            <div class="counter-box border-right border-bottom">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="26.533" viewBox="0 0 40 26.533"><g transform="translate(0 -76.3)"><path  d="M132.354,72.675a1.92,1.92,0,0,0-2.364,1.336L123.4,96.7a1.92,1.92,0,1,0,3.7,1.028l6.59-22.692A1.92,1.92,0,0,0,132.354,72.675Z" transform="translate(-108.45 3.695)"/><path  d="M9.548,80.443a1.92,1.92,0,0,0-2.7.249l-6.4,7.7a1.92,1.92,0,0,0,0,2.458l6.4,7.664a1.92,1.92,0,1,0,2.947-2.461L4.419,89.613,9.8,83.147A1.92,1.92,0,0,0,9.548,80.443Z" transform="translate(0 -0.032)"/><path  d="M239.793,88.354l-6.4-7.664a1.92,1.92,0,1,0-2.947,2.461l5.374,6.435-5.377,6.466a1.92,1.92,0,1,0,2.952,2.455l6.4-7.7A1.92,1.92,0,0,0,239.793,88.354Z" transform="translate(-200.24 -0.034)"/></g></svg>
	              </div>
	              <?php
	                $award = 'awards_'.$__lang;
	                $no = $achievement->total_award;
	                $string = $achievement->$award;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	            <div class="counter-box border-bottom">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="46.712" viewBox="0 0 40 46.712"><g transform="translate(-9.081 -19.04)"><g transform="translate(-27.705 19.04)"><g transform="translate(36.785)"><g transform="translate(0)"><path  d="M75.985,4.5a3.38,3.38,0,0,0-2.579-1.193H70.143V2.291A2.294,2.294,0,0,0,67.852,0H45.719a2.294,2.294,0,0,0-2.291,2.291V3.312H40.164A3.38,3.38,0,0,0,37.585,4.5a3.339,3.339,0,0,0-.756,2.7,17.492,17.492,0,0,0,8.886,12.487,23.066,23.066,0,0,0,1.46,2.928,13.621,13.621,0,0,0,6.261,5.908,4.938,4.938,0,0,1-3.813,5.282l-.014,0a1.081,1.081,0,0,0-.829,1.05v4.96H46.774a3.247,3.247,0,0,0-3.243,3.243v2.56a1.081,1.081,0,0,0,1.081,1.081h24.45a1.081,1.081,0,0,0,1.081-1.081v-2.56A3.247,3.247,0,0,0,66.9,39.828H64.893v-4.96a1.081,1.081,0,0,0-.832-1.051l-.013,0a4.934,4.934,0,0,1-3.809-5.328A13.7,13.7,0,0,0,66.4,22.623a23.077,23.077,0,0,0,1.46-2.928A17.492,17.492,0,0,0,76.742,7.207,3.339,3.339,0,0,0,75.985,4.5ZM38.963,6.86a1.165,1.165,0,0,1,.269-.955,1.221,1.221,0,0,1,.932-.431h3.264V7.463a33.971,33.971,0,0,0,1.152,8.9A15.31,15.31,0,0,1,38.963,6.86ZM66.9,41.99a1.082,1.082,0,0,1,1.081,1.081V44.55H45.693V43.071a1.082,1.082,0,0,1,1.081-1.081Zm-4.168-6.041v3.879H50.942V35.949Zm-8.953-2.162a7.158,7.158,0,0,0,.73-.954,7.033,7.033,0,0,0,1.116-3.711,8.476,8.476,0,0,0,2.426-.014,7.117,7.117,0,0,0,1.857,4.679H53.778ZM67.98,7.463a27.934,27.934,0,0,1-3.444,14.055c-2.116,3.561-4.869,5.522-7.751,5.522s-5.636-1.961-7.752-5.522A27.933,27.933,0,0,1,45.59,7.463V2.291a.129.129,0,0,1,.129-.129H67.851a.129.129,0,0,1,.129.129Zm6.627-.6a15.311,15.311,0,0,1-5.617,9.506,33.974,33.974,0,0,0,1.152-8.9V5.474h3.264a1.222,1.222,0,0,1,.932.431A1.165,1.165,0,0,1,74.608,6.86Z" transform="translate(-36.785)"/></g></g><g transform="translate(50.169 6.331)"><path  d="M196.659,74.16a1.082,1.082,0,0,0-.873-.736l-3.262-.474-1.459-2.956a1.081,1.081,0,0,0-1.939,0l-1.459,2.956-3.262.474a1.081,1.081,0,0,0-.6,1.844l2.361,2.3-.557,3.249a1.081,1.081,0,0,0,1.569,1.14l2.918-1.534,2.918,1.534a1.081,1.081,0,0,0,1.569-1.14l-.557-3.249,2.361-2.3A1.081,1.081,0,0,0,196.659,74.16Zm-4.551,2.258a1.081,1.081,0,0,0-.311.957l.283,1.65-1.482-.779a1.082,1.082,0,0,0-1.006,0l-1.482.779.283-1.65a1.081,1.081,0,0,0-.311-.957l-1.2-1.169,1.657-.241a1.081,1.081,0,0,0,.814-.591l.741-1.5.741,1.5a1.081,1.081,0,0,0,.814.591l1.657.241Z" transform="translate(-183.479 -69.391)"/></g></g></g></svg>
	              </div>
	              <?php
	                $experience = 'experience_'.$__lang;
	                $no = $achievement->total_experience;
	                $string = $achievement->$experience;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	            <div class="counter-box border-right">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="61.053" viewBox="0 0 40 61.053"><g transform="translate(-72.023)"><g transform="translate(72.023)"><g transform="translate(0)"><path  d="M103.452,34.286H97.737v-4.4A11.429,11.429,0,0,0,103.452,20a3.81,3.81,0,1,0,0-7.619v-1.9A10.476,10.476,0,0,0,92.975,0H81.547a.952.952,0,0,0-.952.952,7.619,7.619,0,0,0,1.6,4.657,11.334,11.334,0,0,0-1.6,5.819v.952a3.81,3.81,0,0,0,0,7.619,11.429,11.429,0,0,0,5.714,9.886v4.4H80.594a8.571,8.571,0,0,0-8.571,8.571V60.143h1.9V42.857a6.667,6.667,0,0,1,6.667-6.667h7.981l1.543,3.019-1.9,14a.952.952,0,0,0,.267.8l2.857,2.857a.952.952,0,0,0,1.347.005l.005-.005,2.857-2.857a.952.952,0,0,0,.267-.8l-1.9-14,1.562-3.019h7.981a6.667,6.667,0,0,1,6.667,6.667V60.143h1.9V42.857A8.571,8.571,0,0,0,103.452,34.286Zm0-20a1.9,1.9,0,1,1,0,3.81ZM80.594,18.1a1.9,1.9,0,0,1,0-3.81ZM92.975,1.9a8.571,8.571,0,0,1,8.571,8.571v1.048a6.019,6.019,0,0,1-1.9-3.971.952.952,0,0,0-.952-.886H88.213A5.714,5.714,0,0,1,82.575,1.9h10.4ZM82.5,11.429A9.524,9.524,0,0,1,83.613,7.01a5.939,5.939,0,0,0,.79.514,5.876,5.876,0,0,1-1.9,4.01ZM82.5,20V13.876A7.781,7.781,0,0,0,86.223,8.3a7.274,7.274,0,0,0,1.99.276H97.88a7.857,7.857,0,0,0,3.667,5.314V20A9.524,9.524,0,1,1,82.5,20Zm9.524,34.848-1.848-1.9L91.909,40h.229l1.733,12.99ZM90.709,36.19h2.629l-.952,1.9h-.724Zm5.124-1.9H88.213V30.762a11.219,11.219,0,0,0,7.619,0Z" transform="translate(-72.023)"/><g transform="translate(0 61.053) rotate(-90)"><rect  width="1.905" height="40" rx="0.952"/></g></g></g><g transform="translate(84.404 14.286)"><g transform="translate(0)"><circle  cx="1.905" cy="1.905" r="1.905"/></g></g><g transform="translate(95.833 14.286)"><circle  cx="1.905" cy="1.905" r="1.905"/></g><g transform="translate(89.13 14.029)"><path  d="M219.565,118.354l-1.9-.514-1.9,6.667a.949.949,0,0,0,.914,1.21h2.9v-1.9h-1.59Z" transform="translate(-215.72 -117.84)"/></g></g></svg>
	              </div>
	              <?php
	                $projects = 'projects_'.$__lang;
	                $no = $achievement->total_projects;
	                $string = $achievement->$projects;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	            <div class="counter-box border-right">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="46.42" viewBox="0 0 40 46.42"><path  d="M75.174,28.8,69.836,20.82a16.2,16.2,0,0,0-1.048-4.9,1.36,1.36,0,0,0-1.27-.873h-1.43V10.88a1.36,1.36,0,0,0-1.36-1.36H62.967q-.087-.224-.184-.444L64.028,7.83a1.36,1.36,0,0,0,0-1.923L60.182,2.06a1.36,1.36,0,0,0-1.923,0L57.013,3.306q-.22-.1-.444-.184V1.36A1.36,1.36,0,0,0,55.209,0h-5.44a1.36,1.36,0,0,0-1.36,1.36V3.121q-.224.087-.444.184L46.719,2.06a1.36,1.36,0,0,0-1.923,0L40.949,5.907a1.36,1.36,0,0,0,0,1.923l1.246,1.246q-.1.22-.184.444H40.249a1.36,1.36,0,0,0-1.36,1.36V15.05H37.756a1.36,1.36,0,0,0-1.27.874,16.333,16.333,0,0,0,9.805,21.225V45.06a1.36,1.36,0,0,0,1.36,1.36h15.5a1.36,1.36,0,0,0,1.36-1.36V38.079H68.5a1.36,1.36,0,0,0,1.36-1.36v-5.8h4.18a1.361,1.361,0,0,0,1.13-2.116ZM41.609,12.24h1.377a1.36,1.36,0,0,0,1.308-.986,8.474,8.474,0,0,1,.742-1.788,1.36,1.36,0,0,0-.227-1.623l-.974-.974,1.923-1.923.974.974a1.36,1.36,0,0,0,1.623.227A8.476,8.476,0,0,1,50.142,5.4,1.36,1.36,0,0,0,51.129,4.1V2.72h2.72V4.1A1.36,1.36,0,0,0,54.835,5.4a8.471,8.471,0,0,1,1.788.742,1.36,1.36,0,0,0,1.623-.227l.974-.974,1.923,1.923-.974.974a1.36,1.36,0,0,0-.227,1.623,8.476,8.476,0,0,1,.742,1.788,1.36,1.36,0,0,0,1.308.986h1.377V15.05H57.732a5.439,5.439,0,1,0-10.484,0H41.609V12.24Zm8.579,2.811a2.719,2.719,0,1,1,4.6,0ZM68.5,28.2a1.36,1.36,0,0,0-1.36,1.36v5.8H63.155a1.36,1.36,0,0,0-1.36,1.36V43.7H49.011V36.156a1.36,1.36,0,0,0-.99-1.309,13.638,13.638,0,0,1-9.3-17.077H66.549a13.533,13.533,0,0,1,.586,3.534c.022.685.125.432,4.362,6.893Z" transform="translate(-35.405)"/></svg>
	              </div>
	              <?php
	                $portfolios = 'portfolios_'.$__lang;
	                $no = $achievement->total_portfolios;
	                $string = $achievement->$portfolios;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	            <div class="counter-box">
	              <div class="pic">
	                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="34.667" viewBox="0 0 40 34.667"><path  d="M20,1A17.364,17.364,0,0,0,4,11.667H6.958a14.694,14.694,0,0,1,7.094-6.729,20.2,20.2,0,0,0-2.687,6.729h2.76c1.208-4.9,3.625-8,5.875-8s4.667,3.1,5.875,8h2.76a20.2,20.2,0,0,0-2.688-6.729,14.694,14.694,0,0,1,7.094,6.729H36A17.364,17.364,0,0,0,20,1ZM0,14.333,2.6,25H5.125l1.542-6.8L8.208,25h2.521l2.6-10.667H10.667L9.4,20.75,8,14.333H5.333l-1.4,6.417L2.667,14.333Zm13.333,0L15.937,25h2.521L20,18.2,21.542,25h2.521l2.6-10.667H24L22.729,20.75l-1.4-6.417H18.667l-1.4,6.417L16,14.333Zm13.333,0L29.281,25h2.51l1.542-6.8L34.875,25h2.51L40,14.333H37.333L36.073,20.75l-1.406-6.417H32L30.594,20.75l-1.261-6.417ZM5.417,27.667a17.292,17.292,0,0,0,29.167,0H31.3a14.819,14.819,0,0,1-5.344,4.042A17.768,17.768,0,0,0,27.9,27.667H25.021C23.708,30.979,21.813,33,20,33s-3.708-2.021-5.021-5.333H12.1a17.767,17.767,0,0,0,1.938,4.042A14.818,14.818,0,0,1,8.7,27.667Z" transform="translate(0 -1)"/></svg>
	              </div>
	              <?php
	                $videos = 'videos_'.$__lang;
	                $no = $achievement->total_video;
	                $string = $achievement->$videos;
	              ?>
	              <h2 class="number"> +<span class="count"><?=$no?></span></h2>
	              <h3 class="title">
	                <?=$string?>
	              </h3>
	            </div>
	          </div>
	        </div>
	      </div>

			</div>
		</section>
		<!-- End about-section -->
		<!-- about-section" -->
		<?php if($teams) { ?>
		<section class="team-section ">
			<div class="container">
				<div class="row justify-content-center tech-section bg-transparent">
					<div class="col-lg-12">
						<div class="title-section text-center">
							<h2 class="title"><?=getSystemString('managements')?></h2>
							<p class="info"><?=getSystemString('team_work_note')?></p>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<?php
					//print_r($teams);
					foreach ($teams as $team) {
						$name = 'Name_'.$__lang;
						$position = 'Position_'.$__lang;
						$pic = base_url('content/users/'.$team->Original_Img);
					?>
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="team-box">
							<div class="pic">
								<img src="<?=$pic?>" alt="user" width="100%">
							</div>
							<div class="content">
								<h4 class="name"><?=$team->$name?></h4>
								<p class="name"><?=$team->$position?></p>
								<ul class="nav social-media justify-content-center">
									<?php if($team->LinkedIn){?>
									<li class="nav-item">
										<a href="https://linkedin.com/user/<?=$team->LinkedIn?>" target="_blank" class="nav-link"> <i class="fab fa-linkedin-in"></i></a>
									</li>
									<?php } if($team->Facebook){?>
									<li class="nav-item">
										<a href="https://facebook.com/<?=$team->Facebook?>" target="_blank"  class="nav-link"> <i class="fab fa-facebook-f"></i></a>
									</li>
									<?php } if($team->Twitter){?>
									<li class="nav-item">
										<a href="https://twitter.com/<?=$team->Twitter?>" target="_blank"  class="nav-link"> <i class="fab fa-twitter"></i></a>
									</li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
	  <?php } ?>
		<!-- End about-section -->




<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/analytics');
?>

