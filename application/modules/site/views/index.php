
<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());

$this->load->view('includes/header_menu');

    // $sectionName = 'SectionName_'.$__lang;
    // $sectionSub = 'Subtitle_'.$__lang;
    $lang_title = 'Title_'.$__lang;
    $lang_content = 'Content_'.$__lang;
    $lang_desc = 'Description_'.$__lang;
    $Prefix = 'Prefix_'.$__lang;
    $Page_Description = "Page_Description_".$__lang;
    $Page_title = "Page_title_".$__lang;
    $caption = 'Slide_Caption_'.$__lang;
    $c_name = 'Category_'.$__lang;
    $title__ = "Title_".$__lang;
    $UnitName = 'UnitName_'.$__lang;
    $branchName = 'Name_'.$__lang;
    $branchDetails = 'Details_'.$__lang;
    $city = 'City_'.$__lang;

    $title = 'Title_'.$__lang;
    $desc = 'Answer_'.$__lang;
    $caption = 'Slide_Caption_'.$__lang;

?>

<!-- Header -->
  <header class="header">
    <div class="container">
      <div class="form-row align-items-center">
        <div class="col-lg-6">
          <div class="header-box mb-0 mb-5 text-lg-left text-center">
            <h1 class="title"><?=$slides[0]->$title?></h1>
            <h2 class="details py-4"><?=$slides[0]->$caption?></h2>
            <a href="<?=$slides[0]->Target_Link?>" class="btn" title="<?=getSystemString('start_register_saudi_domain')?>">
              <span class="mr-4"><?=getSystemString('start_now')?></span>

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left arrow" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
              </svg>

            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="<?=base_url('content/slides/').$slides[0]->Slide_Image?>" class="img-fluid d-none" alt="header-pic">
	<div class="header-svg">
		<svg id="Component_229_1" data-name="Component 229 – 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="766.069" height="592.498" viewBox="0 0 806 632">
			<defs>
				<linearGradient id="linear-gradient" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#78ecef" />
					<stop offset="0.15" stop-color="#00759b" />
					<stop offset="1" stop-color="#05d3d8" />
				</linearGradient>
				<linearGradient id="linear-gradient-2" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#00759b" />
					<stop offset="1" stop-color="#0d89b1" />
				</linearGradient>
				<linearGradient id="linear-gradient-9" x1="-7.829" y1="0.5" x2="-6.829" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0.15" stop-color="#ff9800" />
					<stop offset="1" stop-color="#ffc107" />
				</linearGradient>
				<linearGradient id="linear-gradient-10" x1="-3.333" y1="1.247" x2="-2.168" y2="1.247" xlink:href="#linear-gradient-9" />
				<linearGradient id="linear-gradient-11" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#78ecef" />
					<stop offset="0.15" stop-color="#05d3d8" />
					<stop offset="1" stop-color="#05d3d8" />
				</linearGradient>
				<clipPath id="clip-path">
					<path
						id="Path_27849"
						data-name="Path 27849"
						d="M1397.74,1128.751c-21.906-10.26-39.223-1.559-38.485,19.337s19.267,46.386,41.172,56.646,39.224,1.559,38.485-19.336S1419.646,1139.012,1397.74,1128.751Z"
						transform="translate(-1359.232 -1124.443)"
						fill="none"
					/>
				</clipPath>
				<linearGradient id="linear-gradient-12" x1="74.731" y1="0.341" x2="75.721" y2="0.341" xlink:href="#linear-gradient-9" />
				<radialGradient id="radial-gradient" cx="0.5" cy="0.5" r="0.832" gradientTransform="translate(0.212 26.727) scale(0.576 0.579)" gradientUnits="objectBoundingBox">
					<stop offset="0.161" stop-color="#2647c8" />
					<stop offset="0.168" stop-color="#2949c8" />
					<stop offset="0.293" stop-color="#6179d7" />
					<stop offset="0.419" stop-color="#91a2e3" />
					<stop offset="0.543" stop-color="#b8c3ed" />
					<stop offset="0.664" stop-color="#d7ddf4" />
					<stop offset="0.782" stop-color="#edf0fa" />
					<stop offset="0.896" stop-color="#fafbfd" />
					<stop offset="1" stop-color="#fff" />
				</radialGradient>
				<linearGradient id="linear-gradient-13" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#fff" />
					<stop offset="0.27" stop-color="#f4f6fc" />
					<stop offset="0.74" stop-color="#d7e0f7" />
					<stop offset="1" stop-color="#c5d2f4" />
				</linearGradient>
				<linearGradient id="linear-gradient-14" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#c5d2f4" />
					<stop offset="0.26" stop-color="#d7e0f7" />
					<stop offset="0.73" stop-color="#f4f6fc" />
					<stop offset="1" stop-color="#fff" />
				</linearGradient>
				<radialGradient id="radial-gradient-2" cx="0.5" cy="0.5" r="0.832" gradientTransform="translate(0.212 32.785) scale(0.576 0.579)" gradientUnits="objectBoundingBox">
					<stop offset="0.161" stop-color="#02126a" />
					<stop offset="0.233" stop-color="#293681" />
					<stop offset="0.349" stop-color="#616ba2" />
					<stop offset="0.465" stop-color="#9198be" />
					<stop offset="0.579" stop-color="#b8bdd5" />
					<stop offset="0.691" stop-color="#d7dae7" />
					<stop offset="0.8" stop-color="#edeef4" />
					<stop offset="0.904" stop-color="#fafafc" />
					<stop offset="1" stop-color="#fff" />
				</radialGradient>
				<linearGradient id="linear-gradient-15" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#fff" />
					<stop offset="0.226" stop-color="#f4f6fc" />
					<stop offset="0.619" stop-color="#d7e0f7" />
					<stop offset="1" stop-color="#b6c7f1" />
				</linearGradient>
				<linearGradient id="linear-gradient-16" y1="0.5" x2="1" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#e2e9fa" />
					<stop offset="0.538" stop-color="#f4f6fd" />
					<stop offset="1" stop-color="#fff" />
				</linearGradient>
				<radialGradient id="radial-gradient-3" cx="0.5" cy="0.5" r="0.875" gradientTransform="matrix(-0.577, 0, 0, 0.517, 11.603, 24.144)" gradientUnits="objectBoundingBox">
					<stop offset="0.091" stop-color="#2647c8" />
					<stop offset="0.218" stop-color="#4f6ad2" />
					<stop offset="0.424" stop-color="#8d9ee2" />
					<stop offset="0.613" stop-color="#bec8ee" />
					<stop offset="0.778" stop-color="#e1e6f7" />
					<stop offset="0.913" stop-color="#f7f8fd" />
					<stop offset="1" stop-color="#fff" />
				</radialGradient>
				<linearGradient id="linear-gradient-17" x1="0.289" y1="0.5" x2="1.289" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0.004" stop-color="#c5d2f4" />
					<stop offset="0.153" stop-color="#ced9f5" />
					<stop offset="1" stop-color="#fff" />
				</linearGradient>
				<linearGradient id="linear-gradient-18" x1="43.878" y1="0.639" x2="45.778" y2="0.02" xlink:href="#linear-gradient-9" />
				<linearGradient id="linear-gradient-19" x1="18.683" y1="0.5" x2="19.683" y2="0.5" xlink:href="#linear-gradient-9" />
				<linearGradient id="linear-gradient-20" x1="25.977" y1="0.5" x2="26.977" y2="0.5" xlink:href="#linear-gradient-9" />
				<radialGradient id="radial-gradient-4" cx="0.5" cy="0.5" r="0.875" gradientTransform="matrix(-0.577, 0, 0, 0.517, 15.309, 31.917)" gradientUnits="objectBoundingBox">
					<stop offset="0.091" stop-color="#02126a" />
					<stop offset="0.094" stop-color="#03136a" />
					<stop offset="0.295" stop-color="#4e5997" />
					<stop offset="0.483" stop-color="#8d94bc" />
					<stop offset="0.653" stop-color="#bec2d8" />
					<stop offset="0.801" stop-color="#e1e3ed" />
					<stop offset="0.922" stop-color="#f7f7fa" />
					<stop offset="1" stop-color="#fff" />
				</radialGradient>
				<radialGradient id="radial-gradient-5" cx="0.5" cy="0.5" r="0.874" gradientTransform="translate(0.211 35.809) scale(0.577 0.517)" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#02126a" />
					<stop offset="0.049" stop-color="#25337f" />
					<stop offset="0.127" stop-color="#58629c" />
					<stop offset="0.208" stop-color="#848cb7" />
					<stop offset="0.292" stop-color="#aaafcd" />
					<stop offset="0.379" stop-color="#c9ccdf" />
					<stop offset="0.47" stop-color="#e0e2ed" />
					<stop offset="0.566" stop-color="#f1f2f7" />
					<stop offset="0.671" stop-color="#fbfcfd" />
					<stop offset="0.802" stop-color="#fff" />
				</radialGradient>
				<linearGradient id="linear-gradient-21" x1="0" y1="0.5" x2="1" y2="0.5" xlink:href="#linear-gradient-9" />
				<linearGradient id="linear-gradient-23" x1="-3.437" y1="0.5" x2="-2.437" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#b6c7f1" />
					<stop offset="0.25" stop-color="#c3d1f3" />
					<stop offset="0.713" stop-color="#e6ebfa" />
					<stop offset="1" stop-color="#fff" />
				</linearGradient>
				<linearGradient id="linear-gradient-33" x1="13.108" y1="0.5" x2="14.108" y2="0.5" xlink:href="#linear-gradient-9" />
				<linearGradient id="linear-gradient-34" x1="11.414" y1="0.5" x2="12.414" y2="0.5" gradientUnits="objectBoundingBox">
					<stop offset="0" stop-color="#ff9800" />
					<stop offset="0.28" stop-color="#ffa802" />
					<stop offset="0.701" stop-color="#ffba05" />
					<stop offset="1" stop-color="#ffc107" />
				</linearGradient>
			</defs>
			<g id="Layer_11" data-name="Layer 11" class="Group_15684" transform="translate(158.283)">
				<g id="Group_15684"  data-name="Group 15684">
					<g id="Group_15683" data-name="Group 15683">
						<path
							id="Path_27770"
							data-name="Path 27770"
							d="M1363.17,389.767c0-69.986-105.65-126.721-235.975-126.721S891.219,319.781,891.219,389.767V554.578c0-69.986,104.717-126.721,233.891-126.721S1362.8,484.591,1362.8,554.578Z"
							transform="translate(-891.134 -263.046)"
							fill="#60ced1"
						/>
						<path
							id="Path_27771"
							data-name="Path 27771"
							d="M1104.937,804.727c-120.679-5.5-213.718-59.93-213.718-126.264v164.81c0,65.931,92.931,120.1,211.7,126.158a21.114,21.114,0,0,0,22.2-21.082V825.811A21.116,21.116,0,0,0,1104.937,804.727Z"
							transform="translate(-891.134 -551.742)"
							fill="#78ecef"
						/>
						<path id="Path_27772" data-name="Path 27772" d="M1375.686,1422.65c-36.062.428-69.261-5.389-95.984-15.776l.355,9.158c26.932,10.691,59.591,16.3,96.21,15.865Z" transform="translate(-1161.111 -1057.954)" fill="#00759b" />
						<path id="Path_27773" data-name="Path 27773" d="M1321.172,1474.8a223.839,223.839,0,0,1-41.47-11.421l.6,9.252c12.354,4.9,26.048,8.333,40.872,11.1Z" transform="translate(-1161.111 -1097.222)" fill="#00759b" />
						<path
							id="Path_27774"
							data-name="Path 27774"
							d="M2126.608,777.342a18.741,18.741,0,0,0-11.222,17.191V917.492a18.79,18.79,0,0,0,27.6,16.581c43.637-23.02,70.739-55.195,70.739-90.8V678.463C2213.724,718.454,2179.909,754.117,2126.608,777.342Z"
							transform="translate(-1741.874 -551.742)"
							fill="#78ecef"
						/>
						<path
							id="Path_27775"
							data-name="Path 27775"
							d="M2205.858,1190.895v10.862c43.637-23.02,70.739-55.195,70.739-90.8v-10.862C2276.6,1135.7,2249.495,1167.875,2205.858,1190.895Z"
							transform="translate(-1804.747 -844.757)"
							fill="#00759b"
						/>
						<path
							id="Path_27776"
							data-name="Path 27776"
							d="M2205.858,1119.722v10.862c43.637-23.02,70.739-55.195,70.739-90.8v-10.862C2276.6,1064.527,2249.495,1096.7,2205.858,1119.722Z"
							transform="translate(-1804.747 -795.295)"
							fill="#00759b"
						/>
						<path
							id="Path_27777"
							data-name="Path 27777"
							d="M2205.858,1048.549v10.862c43.637-23.02,70.739-55.2,70.739-90.8V957.749C2276.6,993.354,2249.495,1025.529,2205.858,1048.549Z"
							transform="translate(-1804.747 -745.833)"
							fill="#00759b"
						/>
						<path
							id="Path_27778"
							data-name="Path 27778"
							d="M2205.858,977.376v10.862c43.637-23.02,70.739-55.2,70.739-90.8V886.576C2276.6,922.181,2249.495,954.356,2205.858,977.376Z"
							transform="translate(-1804.747 -696.371)"
							fill="#00759b"
						/>
						<path id="Path_27779" data-name="Path 27779" d="M2205.858,906.2v10.862c43.637-23.02,70.739-55.2,70.739-90.8V815.4C2276.6,851.008,2249.495,883.183,2205.858,906.2Z" transform="translate(-1804.747 -646.909)" fill="#00759b" />
						<path
							id="Path_27780"
							data-name="Path 27780"
							d="M2205.858,835.03v10.862c43.637-23.02,70.739-55.195,70.739-90.8V744.23C2276.6,779.835,2249.495,812.01,2205.858,835.03Z"
							transform="translate(-1804.747 -597.447)"
							fill="#00759b"
						/>
						<g id="Group_15661" data-name="Group 15661" transform="translate(37.941 51.078)">
							<g id="Group_15659" data-name="Group 15659">
								<path
									id="Path_27781"
									data-name="Path 27781"
									d="M1016.174,558.94c7.307,4.434,16.73,1.686,22.416-4.144,6.677-6.846,8.182-17.084,8.5-26.232.354-10.186-.719-21.328,4.494-30.549a20.342,20.342,0,0,1,9.148-8.85c3.96-1.742,8.734-1.728,11.9,1.518,2.611,2.681,3.794,6.524,5.023,9.966,1.251,3.5,2.5,7.135,4.744,10.144a23.5,23.5,0,0,0,19.737,8.951c8.386-.4,15.214-5.391,19.045-12.753,4.547-8.74,4.753-18.648,5.106-28.264.22-5.983.57-12.027,2.418-17.765a37.79,37.79,0,0,1,7-12.6,40,40,0,0,1,24.227-13.919c2.584-.415,1.483-4.332-1.083-3.928-16.812,2.649-31.281,16.057-35.115,32.655-2.407,10.419-.867,21.23-2.837,31.691-1.5,7.965-5.3,16.86-13.527,19.818a20.013,20.013,0,0,1-20.151-4.188c-5.594-5.376-5.877-13.822-10.115-20.053a13.013,13.013,0,0,0-9.1-5.923,17.408,17.408,0,0,0-12.133,3.312c-7.385,5.279-10.641,14-11.678,22.718-1.334,11.212.66,23.033-3.524,33.8a20.543,20.543,0,0,1-9.383,11.026c-4.126,2.206-9.11,2.832-13.314.489a1.783,1.783,0,0,0-1.8,3.078Z"
									transform="translate(-1015.317 -430.489)"
									fill="#00759b"
								/>
							</g>
							<g id="Group_15660" data-name="Group 15660" transform="translate(1.742 6.903)">
								<path
									id="Path_27782"
									data-name="Path 27782"
									d="M1022.638,570.353c7.1-.641,11.842-6.3,14.319-12.568,1.542-3.9,2.327-8.04,3.436-12.071a100.771,100.771,0,0,1,4.214-12.23c1.548-3.692,3.2-7.745,6.039-10.653a15.631,15.631,0,0,1,8.7-4.3c6.949-1.189,14.093,1.091,20.627,3.217,7.111,2.313,14.63,4.565,22.177,3.391a21.117,21.117,0,0,0,15.534-11.464c3.041-5.884,4.082-12.559,4.614-19.09.572-7.022.74-14.52,3.741-21.034,3.665-7.953,11.419-11.537,19.506-13.577a71.3,71.3,0,0,1,28.948-1.2c2.992.493,4.278-4.085,1.264-4.582a77.991,77.991,0,0,0-25.848.012c-7.569,1.285-15.489,3.551-21.51,8.518-11.894,9.81-9.164,26.218-11.906,39.693-1.238,6.084-3.663,12.56-9.179,16-6.482,4.044-14.642,2.561-21.609.782-12.3-3.142-29.227-9.256-38.783,2.925-2.667,3.4-4.387,7.535-6.025,11.5a100,100,0,0,0-4.494,13.7c-1.874,7.418-4.407,18.638-13.763,19.658-2.119.231-2.173,3.562,0,3.366Z"
									transform="translate(-1021.028 -453.12)"
									fill="url(#linear-gradient)"
								/>
							</g>
						</g>
						<g id="Group_15665" data-name="Group 15665" transform="translate(75.792 153.387)">
							<g id="Group_15662" data-name="Group 15662" transform="translate(136.913)">
								<path
									id="Path_27783"
									data-name="Path 27783"
									d="M1588.949,767.675a.724.724,0,0,1-.031-1.448c4.8-.209,9.672-.326,14.477-.347h0a.724.724,0,0,1,0,1.448c-4.786.021-9.638.138-14.42.346Z"
									transform="translate(-1588.226 -765.88)"
									fill="#fff"
								/>
							</g>
							<g id="Group_15663" data-name="Group 15663" transform="translate(102.547 0.591)">
								<path
									id="Path_27784"
									data-name="Path 27784"
									d="M1476.292,772.11a.724.724,0,0,1-.1-1.442c9.792-1.334,19.731-2.293,29.542-2.849a.724.724,0,1,1,.082,1.446c-9.773.554-19.675,1.509-29.429,2.838A.718.718,0,0,1,1476.292,772.11Z"
									transform="translate(-1475.569 -767.818)"
									fill="#fff"
								/>
							</g>
							<g id="Group_15664" data-name="Group 15664" transform="translate(0 4.167)">
								<path
									id="Path_27785"
									data-name="Path 27785"
									d="M1140.124,810.01a.724.724,0,0,1-.339-1.365c.382-.2,38.845-20.264,97.657-29.1a.724.724,0,0,1,.215,1.432c-58.553,8.793-96.816,28.744-97.2,28.944A.722.722,0,0,1,1140.124,810.01Z"
									transform="translate(-1139.399 -779.542)"
									fill="#fff"
								/>
							</g>
						</g>
						<g id="Group_15666" data-name="Group 15666" transform="translate(198.597 69.74)">
							<path
								id="Path_27786"
								data-name="Path 27786"
								d="M1557.252,508.348q-6.14.537-12.262,1.288.1-6.164.207-12.328,6.122-.747,12.263-1.281Q1557.356,502.188,1557.252,508.348Z"
								transform="translate(-1544.072 -494.697)"
								fill="url(#linear-gradient-2)"
							/>
							<path id="Path_27787" data-name="Path 27787" d="M1628.269,504.35q-6.161.16-12.313.534.1-6.158.208-12.316,6.151-.37,12.313-.526Q1628.374,498.2,1628.269,504.35Z" transform="translate(-1593.39 -491.927)" fill="#fff" />
							<path
								id="Path_27788"
								data-name="Path 27788"
								d="M1699.506,504.192q-6.164-.217-12.33-.221.1-6.151.209-12.3,6.164.007,12.33.228Q1699.611,498.044,1699.506,504.192Z"
								transform="translate(-1642.885 -491.668)"
								fill="#151617"
							/>
							<path id="Path_27789" data-name="Path 27789" d="M1770.762,507.194q-6.151-.594-12.312-.975l.209-12.29q6.161.384,12.312.982Q1770.866,501.053,1770.762,507.194Z" transform="translate(-1692.417 -493.239)" fill="#151617" />
							<path
								id="Path_27790"
								data-name="Path 27790"
								d="M1841.837,514.557q-6.12-.971-12.26-1.729.1-6.139.208-12.277,6.139.761,12.258,1.736Q1841.94,508.422,1841.837,514.557Z"
								transform="translate(-1741.847 -497.841)"
								fill="#fff"
							/>
							<path id="Path_27791" data-name="Path 27791" d="M1556.247,568q-6.14.542-12.261,1.3.1-6.164.207-12.329,6.12-.752,12.261-1.291Q1556.351,561.839,1556.247,568Z" transform="translate(-1543.374 -536.152)" fill="#151617" />
							<path
								id="Path_27792"
								data-name="Path 27792"
								d="M1627.261,563.939q-6.161.165-12.313.544.1-6.158.208-12.316,6.152-.376,12.313-.537Q1627.365,557.784,1627.261,563.939Z"
								transform="translate(-1592.689 -533.339)"
								fill="url(#linear-gradient-2)"
							/>
							<path id="Path_27793" data-name="Path 27793" d="M1698.5,563.742q-6.164-.212-12.33-.21l.209-12.3q6.164,0,12.33.217Q1698.6,557.594,1698.5,563.742Z" transform="translate(-1642.183 -533.06)" fill="url(#linear-gradient-2)" />
							<path
								id="Path_27794"
								data-name="Path 27794"
								d="M1769.752,566.684q-6.151-.589-12.312-.964.1-6.146.209-12.291,6.161.379,12.312.971Q1769.857,560.542,1769.752,566.684Z"
								transform="translate(-1691.715 -534.589)"
								fill="#fff"
							/>
							<path
								id="Path_27795"
								data-name="Path 27795"
								d="M1840.831,573.985q-6.12-.966-12.26-1.718.1-6.139.208-12.277,6.139.756,12.26,1.725Q1840.935,567.85,1840.831,573.985Z"
								transform="translate(-1741.148 -539.148)"
								fill="url(#linear-gradient-2)"
							/>
							<path
								id="Path_27796"
								data-name="Path 27796"
								d="M1555.243,627.651q-6.139.547-12.26,1.309.1-6.164.207-12.329,6.12-.758,12.261-1.3Q1555.347,621.49,1555.243,627.651Z"
								transform="translate(-1542.677 -577.607)"
								fill="#151617"
							/>
							<path
								id="Path_27797"
								data-name="Path 27797"
								d="M1626.251,623.528q-6.161.171-12.312.555.1-6.158.208-12.316,6.151-.381,12.313-.548Q1626.356,617.373,1626.251,623.528Z"
								transform="translate(-1591.988 -574.75)"
								fill="#fff"
							/>
							<path id="Path_27798" data-name="Path 27798" d="M1697.485,623.294q-6.164-.206-12.33-.2.1-6.152.209-12.3,6.164,0,12.33.207Q1697.59,617.146,1697.485,623.294Z" transform="translate(-1641.48 -574.454)" fill="#151617" />
							<path
								id="Path_27799"
								data-name="Path 27799"
								d="M1768.743,626.174q-6.151-.584-12.313-.954.1-6.145.209-12.291,6.161.373,12.313.961Q1768.847,620.033,1768.743,626.174Z"
								transform="translate(-1691.013 -575.94)"
								fill="url(#linear-gradient-2)"
							/>
							<path
								id="Path_27800"
								data-name="Path 27800"
								d="M1839.826,633.413q-6.121-.961-12.262-1.708.1-6.139.208-12.278,6.14.75,12.261,1.715Q1839.929,627.278,1839.826,633.413Z"
								transform="translate(-1740.448 -580.455)"
								fill="#fff"
							/>
							<path
								id="Path_27801"
								data-name="Path 27801"
								d="M1554.239,687.3q-6.139.553-12.259,1.32.1-6.164.207-12.329,6.119-.763,12.259-1.312Q1554.343,681.142,1554.239,687.3Z"
								transform="translate(-1541.98 -619.062)"
								fill="#151617"
							/>
							<path
								id="Path_27802"
								data-name="Path 27802"
								d="M1625.243,683.118q-6.16.176-12.312.566.1-6.159.208-12.317,6.15-.386,12.312-.558Q1625.347,676.964,1625.243,683.118Z"
								transform="translate(-1591.288 -616.163)"
								fill="url(#linear-gradient-2)"
							/>
							<path id="Path_27803" data-name="Path 27803" d="M1696.475,682.846q-6.165-.2-12.33-.188.1-6.152.209-12.3,6.164-.009,12.33.2Z" transform="translate(-1640.778 -615.846)" fill="url(#linear-gradient-2)" />
							<path
								id="Path_27804"
								data-name="Path 27804"
								d="M1767.734,685.666q-6.151-.578-12.313-.943.1-6.145.209-12.291,6.161.368,12.313.95Q1767.838,679.523,1767.734,685.666Z"
								transform="translate(-1690.311 -617.291)"
								fill="#151617"
							/>
							<path
								id="Path_27805"
								data-name="Path 27805"
								d="M1838.82,692.843q-6.121-.955-12.262-1.7.1-6.139.208-12.278,6.14.745,12.262,1.7Q1838.923,686.708,1838.82,692.843Z"
								transform="translate(-1739.748 -621.763)"
								fill="#151617"
							/>
						</g>
						<g id="Group_15667" data-name="Group 15667" transform="translate(330.786 38.65)">
							<path
								id="Path_27806"
								data-name="Path 27806"
								d="M2018.958,404.5c0,8.758,4.591,18.7,11.206,25.383a30.264,30.264,0,0,0,6.307,4.951c.049.028.1.051.146.079a17.581,17.581,0,0,0,8.6,2.537,11.614,11.614,0,0,0,5.869-1.535,11.425,11.425,0,0,0,3.344-2.922A16.612,16.612,0,0,0,2057.5,422.7c.021-8.775-4.567-18.721-11.2-25.4a30.184,30.184,0,0,0-6.325-4.944c-.046-.026-.092-.049-.137-.075-5.285-2.989-10.435-3.34-14.515-.978a11.414,11.414,0,0,0-3.311,2.9A16.549,16.549,0,0,0,2018.958,404.5Zm6.952,0a11.864,11.864,0,0,1,.833-4.653,5.184,5.184,0,0,1,2.072-2.531,4.79,4.79,0,0,1,2.426-.6,10.974,10.974,0,0,1,5.283,1.661,20.676,20.676,0,0,1,2.718,1.882,27.838,27.838,0,0,1,3.752,3.726c4.464,5.32,7.575,12.571,7.56,18.693a11.944,11.944,0,0,1-.841,4.66,5.206,5.206,0,0,1-2.091,2.549c-1.848,1.064-4.646.671-7.674-1.077a20.794,20.794,0,0,1-2.725-1.9,28.036,28.036,0,0,1-3.742-3.73C2029.024,417.859,2025.91,410.611,2025.91,404.5Z"
								transform="translate(-2005.647 -389.748)"
								fill="#020e50"
								opacity="0.52"
							/>
							<path
								id="Path_27807"
								data-name="Path 27807"
								d="M1985.577,421.188c0,8.758,4.591,18.7,11.206,25.383a30.244,30.244,0,0,0,6.307,4.951c.049.028.1.052.146.079a17.579,17.579,0,0,0,8.6,2.537,11.615,11.615,0,0,0,5.869-1.535,11.424,11.424,0,0,0,3.344-2.922,16.619,16.619,0,0,0,3.072-10.294c.022-8.775-4.567-18.721-11.2-25.4a30.2,30.2,0,0,0-6.325-4.944c-.046-.026-.092-.049-.137-.074-5.285-2.99-10.435-3.34-14.515-.978a11.421,11.421,0,0,0-3.311,2.9A16.55,16.55,0,0,0,1985.577,421.188Zm6.952,0a11.859,11.859,0,0,1,.833-4.653,5.184,5.184,0,0,1,2.072-2.532,4.79,4.79,0,0,1,2.426-.6,10.979,10.979,0,0,1,5.282,1.661,20.683,20.683,0,0,1,2.719,1.882,27.814,27.814,0,0,1,3.751,3.726c4.464,5.32,7.575,12.57,7.56,18.692a11.948,11.948,0,0,1-.841,4.66,5.206,5.206,0,0,1-2.091,2.549c-1.848,1.064-4.646.671-7.674-1.077a20.767,20.767,0,0,1-2.724-1.9,28.011,28.011,0,0,1-3.742-3.731C1995.643,434.55,1992.529,427.3,1992.529,421.188Z"
								transform="translate(-1982.449 -401.348)"
								fill="#2647c8"
							/>
							<path
								id="Path_27808"
								data-name="Path 27808"
								d="M1999.865,419.627a10.974,10.974,0,0,0-5.282-1.661,4.792,4.792,0,0,0-2.426.6,5.189,5.189,0,0,0-2.072,2.531l-4.721-5.651a11.416,11.416,0,0,1,3.31-2.9c4.08-2.362,9.231-2.012,14.515.978l-.6,7.986A20.671,20.671,0,0,0,1999.865,419.627Z"
								transform="translate(-1982.3 -404.515)"
								fill="url(#linear-gradient-9)"
							/>
							<path
								id="Path_27809"
								data-name="Path 27809"
								d="M2041.815,427.266l.6-7.986c.046.026.091.048.137.075a30.189,30.189,0,0,1,6.325,4.944l-3.316,6.693A27.829,27.829,0,0,0,2041.815,427.266Z"
								transform="translate(-2021.531 -410.271)"
								fill="#02126a"
							/>
							<path
								id="Path_27810"
								data-name="Path 27810"
								d="M2061.673,461.118c.015-6.122-3.1-13.373-7.56-18.692l3.316-6.693c6.629,6.681,11.218,16.627,11.2,25.4a16.618,16.618,0,0,1-3.072,10.294l-4.721-5.651A11.952,11.952,0,0,0,2061.673,461.118Z"
								transform="translate(-2030.078 -421.706)"
								fill="#151617"
							/>
							<path
								id="Path_27811"
								data-name="Path 27811"
								d="M1978.384,425.569l4.721,5.651a11.872,11.872,0,0,0-.832,4.653c0,6.113,3.114,13.362,7.571,18.687a28,28,0,0,0,3.742,3.73,20.74,20.74,0,0,0,2.724,1.9c3.028,1.748,5.825,2.14,7.673,1.077a5.206,5.206,0,0,0,2.091-2.549l4.721,5.651a11.438,11.438,0,0,1-3.344,2.922,11.614,11.614,0,0,1-5.869,1.535,17.58,17.58,0,0,1-8.6-2.537c-.049-.027-.1-.051-.146-.079a30.271,30.271,0,0,1-6.308-4.951c-6.614-6.685-11.206-16.624-11.206-25.382A16.545,16.545,0,0,1,1978.384,425.569Z"
								transform="translate(-1975.321 -414.642)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15668" data-name="Group 15668" transform="translate(391.998 67.13)">
							<path
								id="Path_27812"
								data-name="Path 27812"
								d="M2221.936,496.446c-1,8.7,2.425,19.1,8.232,26.5a30.27,30.27,0,0,0,5.7,5.639c.045.034.091.062.136.1a17.585,17.585,0,0,0,8.257,3.5,11.618,11.618,0,0,0,6.006-.854,11.43,11.43,0,0,0,3.656-2.521,16.618,16.618,0,0,0,4.228-9.875c1.024-8.715-2.4-19.12-8.22-26.514a30.163,30.163,0,0,0-5.719-5.635c-.042-.031-.085-.059-.128-.09-4.908-3.574-9.985-4.51-14.309-2.63a11.416,11.416,0,0,0-3.62,2.5A16.548,16.548,0,0,0,2221.936,496.446Zm6.906.794a11.863,11.863,0,0,1,1.358-4.527,5.184,5.184,0,0,1,2.348-2.278,4.785,4.785,0,0,1,2.479-.314,10.971,10.971,0,0,1,5.058,2.253,20.689,20.689,0,0,1,2.486,2.18,27.827,27.827,0,0,1,3.3,4.13c3.827,5.794,6.089,13.353,5.375,19.434a11.949,11.949,0,0,1-1.368,4.533,5.208,5.208,0,0,1-2.368,2.293c-1.958.846-4.692.136-7.5-1.947a20.79,20.79,0,0,1-2.49-2.195,27.971,27.971,0,0,1-3.291-4.133C2230.409,510.87,2228.143,503.314,2228.842,497.24Z"
								transform="translate(-2207.798 -483.112)"
								fill="#020e50"
								opacity="0.52"
							/>
							<path
								id="Path_27813"
								data-name="Path 27813"
								d="M2186.866,509.213c-1,8.7,2.425,19.1,8.232,26.5a30.243,30.243,0,0,0,5.7,5.639c.045.034.09.062.136.1a17.584,17.584,0,0,0,8.257,3.5,11.617,11.617,0,0,0,6.006-.854,11.421,11.421,0,0,0,3.656-2.521,16.617,16.617,0,0,0,4.228-9.875c1.024-8.715-2.4-19.12-8.22-26.515a30.188,30.188,0,0,0-5.719-5.635c-.043-.031-.086-.059-.128-.09-4.908-3.574-9.985-4.51-14.309-2.629a11.42,11.42,0,0,0-3.619,2.5A16.546,16.546,0,0,0,2186.866,509.213Zm6.906.794a11.868,11.868,0,0,1,1.359-4.527,5.186,5.186,0,0,1,2.348-2.278,4.792,4.792,0,0,1,2.479-.315,10.978,10.978,0,0,1,5.058,2.254,20.655,20.655,0,0,1,2.486,2.18,27.851,27.851,0,0,1,3.3,4.13c3.827,5.795,6.089,13.354,5.375,19.434a11.952,11.952,0,0,1-1.368,4.534,5.206,5.206,0,0,1-2.368,2.293c-1.958.846-4.692.136-7.5-1.946a20.806,20.806,0,0,1-2.49-2.194,28,28,0,0,1-3.291-4.134C2195.339,523.637,2193.073,516.081,2193.772,510.007Z"
								transform="translate(-2183.426 -491.984)"
								fill="#2647c8"
							/>
							<path
								id="Path_27814"
								data-name="Path 27814"
								d="M2208.441,502.9c-.042-.032-.086-.059-.128-.09-4.908-3.574-9.985-4.51-14.308-2.63a11.412,11.412,0,0,0-3.619,2.5l4.045,6.154a5.184,5.184,0,0,1,2.348-2.278,4.79,4.79,0,0,1,2.478-.314,10.973,10.973,0,0,1,5.058,2.253,20.7,20.7,0,0,1,2.486,2.18,27.809,27.809,0,0,1,3.3,4.13l4.059-6.27A30.172,30.172,0,0,0,2208.441,502.9Z"
								transform="translate(-2185.992 -494.317)"
								fill="#fff"
							/>
							<path
								id="Path_27815"
								data-name="Path 27815"
								d="M2260.392,555.435c.714-6.081-1.548-13.639-5.375-19.434l4.059-6.27c5.823,7.395,9.245,17.8,8.22,26.514a16.62,16.62,0,0,1-4.228,9.876l-4.044-6.153A11.941,11.941,0,0,0,2260.392,555.435Z"
								transform="translate(-2230.908 -515.51)"
								fill="url(#linear-gradient-10)"
							/>
							<path
								id="Path_27816"
								data-name="Path 27816"
								d="M2180.377,510.536l4.044,6.154a11.855,11.855,0,0,0-1.359,4.528c-.7,6.073,1.567,13.63,5.386,19.43a27.993,27.993,0,0,0,3.292,4.133,20.72,20.72,0,0,0,2.49,2.195c2.809,2.083,5.543,2.792,7.5,1.946a5.207,5.207,0,0,0,2.369-2.293l4.044,6.153a11.434,11.434,0,0,1-3.656,2.521,11.614,11.614,0,0,1-6.006.854,17.58,17.58,0,0,1-8.256-3.5c-.045-.033-.091-.061-.136-.095a30.261,30.261,0,0,1-5.7-5.639c-5.807-7.4-9.233-17.8-8.232-26.5A16.546,16.546,0,0,1,2180.377,510.536Z"
								transform="translate(-2175.984 -502.17)"
								fill="#151617"
							/>
						</g>
						<g id="Group_15676" data-name="Group 15676" transform="translate(332.945 105.89)">
							<g id="Group_15669" data-name="Group 15669">
								<path
									id="Path_27817"
									data-name="Path 27817"
									d="M1983.3,670.978h0a.905.905,0,0,1-.9-.906l.065-58.992a.905.905,0,0,1,.905-.9h0a.9.9,0,0,1,.9.906l-.065,58.992A.905.905,0,0,1,1983.3,670.978Z"
									transform="translate(-1982.396 -610.175)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15670" data-name="Group 15670" transform="translate(13.8 9.289)">
								<path
									id="Path_27818"
									data-name="Path 27818"
									d="M2028.54,690.566h0a.905.905,0,0,1-.9-.906l.065-48.13a.906.906,0,0,1,.906-.9h0a.906.906,0,0,1,.9.906l-.066,48.13A.905.905,0,0,1,2028.54,690.566Z"
									transform="translate(-2027.635 -640.626)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15671" data-name="Group 15671" transform="translate(27.6 20.882)">
								<path
									id="Path_27819"
									data-name="Path 27819"
									d="M2073.779,714.089h0a.905.905,0,0,1-.9-.907l.065-33.647a.905.905,0,0,1,.906-.9h0a.905.905,0,0,1,.9.907l-.065,33.648A.906.906,0,0,1,2073.779,714.089Z"
									transform="translate(-2072.874 -678.631)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15672" data-name="Group 15672" transform="translate(41.4 18.536)">
								<path
									id="Path_27820"
									data-name="Path 27820"
									d="M2119.018,720.881h0a.905.905,0,0,1-.9-.906l.065-48.13a.9.9,0,0,1,.905-.9h0a.905.905,0,0,1,.9.906l-.065,48.13A.905.905,0,0,1,2119.018,720.881Z"
									transform="translate(-2118.113 -670.941)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15673" data-name="Group 15673" transform="translate(55.2 13.474)">
								<path
									id="Path_27821"
									data-name="Path 27821"
									d="M2164.259,720.58h0a.906.906,0,0,1-.9-.906l.065-64.423a.905.905,0,0,1,.905-.9h0a.906.906,0,0,1,.9.906l-.065,64.423A.905.905,0,0,1,2164.259,720.58Z"
									transform="translate(-2163.353 -654.347)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15674" data-name="Group 15674" transform="translate(69 32.852)">
								<path
									id="Path_27822"
									data-name="Path 27822"
									d="M2209.5,758.76h0a.9.9,0,0,1-.9-.907l.065-39.079a.9.9,0,0,1,.905-.9h0a.9.9,0,0,1,.9.907l-.065,39.078A.905.905,0,0,1,2209.5,758.76Z"
									transform="translate(-2208.593 -717.871)"
									fill="#1187ae"
								/>
							</g>
							<g id="Group_15675" data-name="Group 15675" transform="translate(82.8 33.403)">
								<path
									id="Path_27823"
									data-name="Path 27823"
									d="M2254.737,780.478h0a.9.9,0,0,1-.9-.906l.065-58.992a.905.905,0,0,1,.905-.9h0a.905.905,0,0,1,.9.906l-.065,58.992A.905.905,0,0,1,2254.737,780.478Z"
									transform="translate(-2253.832 -719.675)"
									fill="#1187ae"
								/>
							</g>
						</g>
						<ellipse id="Ellipse_1351" data-name="Ellipse 1351" cx="4.386" cy="4.677" rx="4.386" ry="4.677" transform="translate(307.68 153.043) rotate(-2.122)" fill="#1187ae" />
						<path id="Path_27824" data-name="Path 27824" d="M1867.6,769.36a2.231,2.231,0,1,1-2.313-2.291A2.3,2.3,0,0,1,1867.6,769.36Z" transform="translate(-1566.578 -613.318)" fill="#1187ae" />
						<path id="Path_27825" data-name="Path 27825" d="M1834.785,770.817a1.639,1.639,0,1,1-1.7-1.683A1.693,1.693,0,0,1,1834.785,770.817Z" transform="translate(-1544.595 -614.753)" fill="#1187ae" />
						<path id="Path_27826" data-name="Path 27826" d="M1004.377,409.713c-45.424,18.446-60.365,49.853-60.365,49.853l.181,12.671s14.884-35.39,60.308-53.835Z" transform="translate(-927.822 -364.973)" fill="#1187ae" />
						<path id="Path_27827" data-name="Path 27827" d="M1010.708,458.97c-45.424,18.446-60.365,54.74-60.365,54.74l.181,12.671s14.884-40.277,60.308-58.723Z" transform="translate(-932.222 -399.204)" fill="#1187ae" />
						<g id="Group_15677" data-name="Group 15677" transform="translate(199.516 12.356)">
							<path id="Path_27828" data-name="Path 27828" d="M1630.881,317.049a229.187,229.187,0,0,0-85.891,0v-9.438a229.173,229.173,0,0,1,85.891,0Z" transform="translate(-1544.99 -303.551)" fill="#1187ae" />
							<path id="Path_27829" data-name="Path 27829" d="M1630.881,365.671a229.187,229.187,0,0,0-85.891,0v-9.438a229.187,229.187,0,0,1,85.891,0Z" transform="translate(-1544.99 -337.341)" fill="#1187ae" />
							<path id="Path_27830" data-name="Path 27830" d="M1585.3,410.281a229.194,229.194,0,0,0-40.308,4.045v-9.439a229.194,229.194,0,0,1,40.308-4.044Z" transform="translate(-1544.99 -371.164)" fill="#1187ae" />
						</g>
						<path
							id="Path_27831"
							data-name="Path 27831"
							d="M971.108,1245.5v-28.865a.675.675,0,0,1,1.1-.528l6.942,5.538a.675.675,0,0,1,.254.528v28.94a1.542,1.542,0,0,1-2.672,1.049l-5.209-5.612A1.542,1.542,0,0,1,971.108,1245.5Z"
							transform="translate(-946.653 -925.279)"
							fill="#00759b"
						/>
						<path
							id="Path_27832"
							data-name="Path 27832"
							d="M1029.678,1251.956V1200.42a.675.675,0,0,1,1.019-.581l6.942,4.106a.675.675,0,0,1,.332.581V1256.1a1.542,1.542,0,0,1-2.5,1.207l-5.208-4.139A1.542,1.542,0,0,1,1029.678,1251.956Z"
							transform="translate(-987.356 -914.008)"
							fill="#00759b"
						/>
						<path
							id="Path_27833"
							data-name="Path 27833"
							d="M1088.247,1210.237v-88.524a.675.675,0,0,1,1.005-.589l6.942,3.889a.675.675,0,0,1,.345.589v87.82a1.542,1.542,0,0,1-2.346,1.315l-5.208-3.185A1.542,1.542,0,0,1,1088.247,1210.237Z"
							transform="translate(-1028.059 -859.31)"
							fill="#00759b"
						/>
						<path
							id="Path_27834"
							data-name="Path 27834"
							d="M1146.694,1200.974v-106.6a.675.675,0,0,1,.949-.617l6.942,3.081a.675.675,0,0,1,.4.617v106.107a1.542,1.542,0,0,1-2.229,1.381l-5.208-2.591A1.543,1.543,0,0,1,1146.694,1200.974Z"
							transform="translate(-1068.677 -840.313)"
							fill="url(#linear-gradient-11)"
						/>
						<path
							id="Path_27835"
							data-name="Path 27835"
							d="M1206.123,1251.342v-95.949a.676.676,0,0,1,.918-.63l6.941,2.669a.675.675,0,0,1,.433.63v95.35a1.542,1.542,0,0,1-2.111,1.433l-5.209-2.069A1.542,1.542,0,0,1,1206.123,1251.342Z"
							transform="translate(-1109.977 -882.716)"
							fill="#00759b"
						/>
						<path id="Path_27836" data-name="Path 27836" d="M952.309,848.24c-66.272-38.961-61.284-74.922-61.284-74.922V784.18s-4.988,34.151,61.284,73.111Z" transform="translate(-890.939 -617.662)" fill="#1187ae" />
						<path id="Path_27837" data-name="Path 27837" d="M952.309,907.585c-66.272-38.961-61.284-74.921-61.284-74.921v10.862s-4.988,34.151,61.284,73.111Z" transform="translate(-890.939 -658.904)" fill="#1187ae" />
						<path id="Path_27838" data-name="Path 27838" d="M913.022,943.215c-23.891-25.282-22-45.272-22-45.272V908.8s-2.68,18.353,22,43.5Z" transform="translate(-890.939 -704.27)" fill="#1187ae" />
						<g id="Group_15682" data-name="Group 15682" transform="translate(133.799 262.766)">
							<g id="Group_15681" data-name="Group 15681">
								<g id="Group_15680" data-name="Group 15680" transform="translate(9.052)" style="mix-blend-mode: multiply; isolation: isolate;">
									<g id="Group_15679" data-name="Group 15679">
										<g id="Group_15678" data-name="Group 15678" clip-path="url(#clip-path)">
											<rect id="Rectangle_4993" data-name="Rectangle 4993" width="81.135" height="96.503" transform="translate(-0.716 -5.951)" fill="#fff" />
											<ellipse id="Ellipse_1352" data-name="Ellipse 1352" cx="21.401" cy="43.015" rx="21.401" ry="43.015" transform="matrix(0.835, -0.55, 0.55, 0.835, -3.155, 17.763)" fill="#fff" />
											<ellipse id="Ellipse_1353" data-name="Ellipse 1353" cx="21.295" cy="42.801" rx="21.295" ry="42.801" transform="translate(-2.949 17.883) rotate(-33.4)" fill="#fff" />
											<ellipse id="Ellipse_1354" data-name="Ellipse 1354" cx="21.188" cy="42.588" rx="21.188" ry="42.588" transform="translate(-2.743 18.002) rotate(-33.4)" fill="#fff" />
											<ellipse id="Ellipse_1355" data-name="Ellipse 1355" cx="21.082" cy="42.374" rx="21.082" ry="42.374" transform="matrix(0.835, -0.55, 0.55, 0.835, -2.537, 18.122)" fill="#fefeff" />
											<ellipse id="Ellipse_1356" data-name="Ellipse 1356" cx="20.976" cy="42.16" rx="20.976" ry="42.16" transform="matrix(0.835, -0.55, 0.55, 0.835, -2.33, 18.242)" fill="#fefefe" />
											<ellipse id="Ellipse_1357" data-name="Ellipse 1357" cx="20.869" cy="41.947" rx="20.869" ry="41.947" transform="matrix(0.835, -0.55, 0.55, 0.835, -2.124, 18.362)" fill="#fefefe" />
											<ellipse id="Ellipse_1358" data-name="Ellipse 1358" cx="20.763" cy="41.733" rx="20.763" ry="41.733" transform="translate(-1.918 18.482) rotate(-33.4)" fill="#fefefe" />
											<ellipse id="Ellipse_1359" data-name="Ellipse 1359" cx="20.657" cy="41.52" rx="20.657" ry="41.52" transform="matrix(0.835, -0.55, 0.55, 0.835, -1.711, 18.602)" fill="#fdfdfe" />
											<ellipse id="Ellipse_1360" data-name="Ellipse 1360" cx="20.551" cy="41.306" rx="20.551" ry="41.306" transform="matrix(0.835, -0.55, 0.55, 0.835, -1.505, 18.721)" fill="#fdfdfd" />
											<ellipse id="Ellipse_1361" data-name="Ellipse 1361" cx="20.444" cy="41.092" rx="20.444" ry="41.092" transform="matrix(0.835, -0.55, 0.55, 0.835, -1.299, 18.841)" fill="#fcfcfd" />
											<ellipse id="Ellipse_1362" data-name="Ellipse 1362" cx="20.338" cy="40.879" rx="20.338" ry="40.879" transform="matrix(0.835, -0.55, 0.55, 0.835, -1.092, 18.961)" fill="#fcfcfd" />
											<ellipse id="Ellipse_1363" data-name="Ellipse 1363" cx="20.232" cy="40.665" rx="20.232" ry="40.665" transform="translate(-0.886 19.081) rotate(-33.4)" fill="#fcfcfc" />
											<ellipse id="Ellipse_1364" data-name="Ellipse 1364" cx="20.126" cy="40.452" rx="20.126" ry="40.452" transform="translate(-0.68 19.201) rotate(-33.4)" fill="#fbfbfc" />
											<ellipse id="Ellipse_1365" data-name="Ellipse 1365" cx="20.019" cy="40.238" rx="20.019" ry="40.238" transform="matrix(0.835, -0.55, 0.55, 0.835, -0.473, 19.32)" fill="#fbfbfb" />
											<ellipse id="Ellipse_1366" data-name="Ellipse 1366" cx="19.913" cy="40.024" rx="19.913" ry="40.024" transform="matrix(0.835, -0.55, 0.55, 0.835, -0.267, 19.44)" fill="#fafafb" />
											<ellipse id="Ellipse_1367" data-name="Ellipse 1367" cx="19.807" cy="39.811" rx="19.807" ry="39.811" transform="translate(-0.061 19.56) rotate(-33.4)" fill="#fafafb" />
											<ellipse id="Ellipse_1368" data-name="Ellipse 1368" cx="19.7" cy="39.597" rx="19.7" ry="39.597" transform="matrix(0.835, -0.55, 0.55, 0.835, 0.145, 19.68)" fill="#f9f9fa" />
											<ellipse id="Ellipse_1369" data-name="Ellipse 1369" cx="19.594" cy="39.384" rx="19.594" ry="39.384" transform="translate(0.352 19.8) rotate(-33.4)" fill="#f9f9fa" />
											<ellipse id="Ellipse_1370" data-name="Ellipse 1370" cx="19.488" cy="39.17" rx="19.488" ry="39.17" transform="matrix(0.835, -0.55, 0.55, 0.835, 0.558, 19.92)" fill="#f8f8f9" />
											<ellipse id="Ellipse_1371" data-name="Ellipse 1371" cx="19.382" cy="38.956" rx="19.382" ry="38.956" transform="translate(0.764 20.039) rotate(-33.4)" fill="#f8f8f9" />
											<ellipse id="Ellipse_1372" data-name="Ellipse 1372" cx="19.275" cy="38.743" rx="19.275" ry="38.743" transform="matrix(0.835, -0.55, 0.55, 0.835, 0.971, 20.159)" fill="#f7f7f9" />
											<ellipse id="Ellipse_1373" data-name="Ellipse 1373" cx="19.169" cy="38.529" rx="19.169" ry="38.529" transform="translate(1.177 20.279) rotate(-33.4)" fill="#f6f6f8" />
											<ellipse id="Ellipse_1374" data-name="Ellipse 1374" cx="19.063" cy="38.316" rx="19.063" ry="38.316" transform="matrix(0.835, -0.55, 0.55, 0.835, 1.383, 20.399)" fill="#f6f6f8" />
											<ellipse id="Ellipse_1375" data-name="Ellipse 1375" cx="18.957" cy="38.102" rx="18.957" ry="38.102" transform="translate(1.59 20.519) rotate(-33.4)" fill="#f5f5f7" />
											<ellipse id="Ellipse_1376" data-name="Ellipse 1376" cx="18.85" cy="37.888" rx="18.85" ry="37.888" transform="matrix(0.835, -0.55, 0.55, 0.835, 1.796, 20.639)" fill="#f5f5f7" />
											<ellipse id="Ellipse_1377" data-name="Ellipse 1377" cx="18.744" cy="37.675" rx="18.744" ry="37.675" transform="translate(2.002 20.758) rotate(-33.4)" fill="#f4f4f6" />
											<ellipse id="Ellipse_1378" data-name="Ellipse 1378" cx="18.638" cy="37.461" rx="18.638" ry="37.461" transform="matrix(0.835, -0.55, 0.55, 0.835, 2.209, 20.878)" fill="#f3f3f6" />
											<ellipse id="Ellipse_1379" data-name="Ellipse 1379" cx="18.531" cy="37.248" rx="18.531" ry="37.248" transform="translate(2.415 20.998) rotate(-33.4)" fill="#f3f3f5" />
											<ellipse id="Ellipse_1380" data-name="Ellipse 1380" cx="18.425" cy="37.034" rx="18.425" ry="37.034" transform="matrix(0.835, -0.55, 0.55, 0.835, 2.621, 21.118)" fill="#f2f2f5" />
											<ellipse id="Ellipse_1381" data-name="Ellipse 1381" cx="18.319" cy="36.82" rx="18.319" ry="36.82" transform="translate(2.827 21.238) rotate(-33.4)" fill="#f1f1f4" />
											<ellipse id="Ellipse_1382" data-name="Ellipse 1382" cx="18.213" cy="36.607" rx="18.213" ry="36.607" transform="matrix(0.835, -0.55, 0.55, 0.835, 3.034, 21.357)" fill="#f1f1f3" />
											<ellipse id="Ellipse_1383" data-name="Ellipse 1383" cx="18.106" cy="36.393" rx="18.106" ry="36.393" transform="matrix(0.835, -0.55, 0.55, 0.835, 3.24, 21.477)" fill="#f0f0f3" />
											<ellipse id="Ellipse_1384" data-name="Ellipse 1384" cx="18" cy="36.18" rx="18" ry="36.18" transform="matrix(0.835, -0.55, 0.55, 0.835, 3.446, 21.597)" fill="#efeff2" />
											<ellipse id="Ellipse_1385" data-name="Ellipse 1385" cx="17.894" cy="35.966" rx="17.894" ry="35.966" transform="matrix(0.835, -0.55, 0.55, 0.835, 3.653, 21.717)" fill="#efeff2" />
											<ellipse id="Ellipse_1386" data-name="Ellipse 1386" cx="17.788" cy="35.752" rx="17.788" ry="35.752" transform="matrix(0.835, -0.55, 0.55, 0.835, 3.859, 21.837)" fill="#eeeef1" />
											<ellipse id="Ellipse_1387" data-name="Ellipse 1387" cx="17.681" cy="35.539" rx="17.681" ry="35.539" transform="translate(4.065 21.957) rotate(-33.4)" fill="#ededf1" />
											<ellipse id="Ellipse_1388" data-name="Ellipse 1388" cx="17.575" cy="35.325" rx="17.575" ry="35.325" transform="matrix(0.835, -0.55, 0.55, 0.835, 4.272, 22.076)" fill="#ededf0" />
											<ellipse id="Ellipse_1389" data-name="Ellipse 1389" cx="17.469" cy="35.111" rx="17.469" ry="35.111" transform="translate(4.478 22.196) rotate(-33.4)" fill="#ececef" />
											<ellipse id="Ellipse_1390" data-name="Ellipse 1390" cx="17.362" cy="34.898" rx="17.362" ry="34.898" transform="matrix(0.835, -0.55, 0.55, 0.835, 4.684, 22.316)" fill="#ebebef" />
											<ellipse id="Ellipse_1391" data-name="Ellipse 1391" cx="17.256" cy="34.684" rx="17.256" ry="34.684" transform="matrix(0.835, -0.55, 0.55, 0.835, 4.891, 22.436)" fill="#eaeaee" />
											<ellipse id="Ellipse_1392" data-name="Ellipse 1392" cx="17.15" cy="34.471" rx="17.15" ry="34.471" transform="translate(5.097 22.556) rotate(-33.4)" fill="#eaeaee" />
											<ellipse id="Ellipse_1393" data-name="Ellipse 1393" cx="17.044" cy="34.257" rx="17.044" ry="34.257" transform="matrix(0.835, -0.55, 0.55, 0.835, 5.303, 22.676)" fill="#e9e9ed" />
											<ellipse id="Ellipse_1394" data-name="Ellipse 1394" cx="16.937" cy="34.043" rx="16.937" ry="34.043" transform="matrix(0.835, -0.55, 0.55, 0.835, 5.509, 22.795)" fill="#e8e8ec" />
											<ellipse id="Ellipse_1395" data-name="Ellipse 1395" cx="16.831" cy="33.83" rx="16.831" ry="33.83" transform="translate(5.716 22.915) rotate(-33.4)" fill="#e7e7ec" />
											<ellipse id="Ellipse_1396" data-name="Ellipse 1396" cx="16.725" cy="33.616" rx="16.725" ry="33.616" transform="matrix(0.835, -0.55, 0.55, 0.835, 5.922, 23.035)" fill="#e7e7eb" />
											<ellipse id="Ellipse_1397" data-name="Ellipse 1397" cx="16.619" cy="33.403" rx="16.619" ry="33.403" transform="translate(6.128 23.155) rotate(-33.4)" fill="#e6e6ea" />
											<ellipse id="Ellipse_1398" data-name="Ellipse 1398" cx="16.512" cy="33.189" rx="16.512" ry="33.189" transform="matrix(0.835, -0.55, 0.55, 0.835, 6.335, 23.275)" fill="#e5e5ea" />
											<ellipse id="Ellipse_1399" data-name="Ellipse 1399" cx="16.406" cy="32.975" rx="16.406" ry="32.975" transform="matrix(0.835, -0.55, 0.55, 0.835, 6.541, 23.395)" fill="#e4e4e9" />
											<ellipse id="Ellipse_1400" data-name="Ellipse 1400" cx="16.3" cy="32.762" rx="16.3" ry="32.762" transform="translate(6.747 23.514) rotate(-33.4)" fill="#e3e3e9" />
											<ellipse id="Ellipse_1401" data-name="Ellipse 1401" cx="16.193" cy="32.548" rx="16.193" ry="32.548" transform="matrix(0.835, -0.55, 0.55, 0.835, 6.954, 23.634)" fill="#e3e3e8" />
											<ellipse id="Ellipse_1402" data-name="Ellipse 1402" cx="16.087" cy="32.335" rx="16.087" ry="32.335" transform="matrix(0.835, -0.55, 0.55, 0.835, 7.16, 23.754)" fill="#e2e2e7" />
											<ellipse id="Ellipse_1403" data-name="Ellipse 1403" cx="15.981" cy="32.121" rx="15.981" ry="32.121" transform="translate(7.366 23.874) rotate(-33.4)" fill="#e1e1e6" />
											<ellipse id="Ellipse_1404" data-name="Ellipse 1404" cx="15.875" cy="31.907" rx="15.875" ry="31.907" transform="matrix(0.835, -0.55, 0.55, 0.835, 7.573, 23.994)" fill="#e0e0e6" />
											<ellipse id="Ellipse_1405" data-name="Ellipse 1405" cx="15.768" cy="31.694" rx="15.768" ry="31.694" transform="matrix(0.835, -0.55, 0.55, 0.835, 7.779, 24.114)" fill="#dfdfe5" />
											<ellipse id="Ellipse_1406" data-name="Ellipse 1406" cx="15.662" cy="31.48" rx="15.662" ry="31.48" transform="translate(7.985 24.233) rotate(-33.4)" fill="#dedee4" />
											<ellipse id="Ellipse_1407" data-name="Ellipse 1407" cx="15.556" cy="31.267" rx="15.556" ry="31.267" transform="translate(8.191 24.353) rotate(-33.4)" fill="#dddde4" />
											<ellipse id="Ellipse_1408" data-name="Ellipse 1408" cx="15.45" cy="31.053" rx="15.45" ry="31.053" transform="translate(8.398 24.473) rotate(-33.4)" fill="#dddde3" />
											<ellipse id="Ellipse_1409" data-name="Ellipse 1409" cx="15.343" cy="30.839" rx="15.343" ry="30.839" transform="matrix(0.835, -0.55, 0.55, 0.835, 8.604, 24.593)" fill="#dcdce2" />
											<ellipse id="Ellipse_1410" data-name="Ellipse 1410" cx="15.237" cy="30.626" rx="15.237" ry="30.626" transform="matrix(0.835, -0.55, 0.55, 0.835, 8.81, 24.713)" fill="#dbdbe2" />
											<ellipse id="Ellipse_1411" data-name="Ellipse 1411" cx="15.131" cy="30.412" rx="15.131" ry="30.412" transform="matrix(0.835, -0.55, 0.55, 0.835, 9.017, 24.832)" fill="#dadae1" />
											<ellipse id="Ellipse_1412" data-name="Ellipse 1412" cx="15.024" cy="30.199" rx="15.024" ry="30.199" transform="matrix(0.835, -0.55, 0.55, 0.835, 9.223, 24.952)" fill="#d9d9e0" />
											<ellipse id="Ellipse_1413" data-name="Ellipse 1413" cx="14.918" cy="29.985" rx="14.918" ry="29.985" transform="translate(9.429 25.072) rotate(-33.4)" fill="#d8d8df" />
											<ellipse id="Ellipse_1414" data-name="Ellipse 1414" cx="14.812" cy="29.771" rx="14.812" ry="29.771" transform="translate(9.636 25.192) rotate(-33.4)" fill="#d7d7df" />
											<ellipse id="Ellipse_1415" data-name="Ellipse 1415" cx="14.706" cy="29.558" rx="14.706" ry="29.558" transform="translate(9.842 25.312) rotate(-33.4)" fill="#d6d6de" />
											<ellipse id="Ellipse_1416" data-name="Ellipse 1416" cx="14.599" cy="29.344" rx="14.599" ry="29.344" transform="matrix(0.835, -0.55, 0.55, 0.835, 10.048, 25.432)" fill="#d5d5dd" />
											<ellipse id="Ellipse_1417" data-name="Ellipse 1417" cx="14.493" cy="29.131" rx="14.493" ry="29.131" transform="matrix(0.835, -0.55, 0.55, 0.835, 10.254, 25.551)" fill="#d5d5dc" />
											<ellipse id="Ellipse_1418" data-name="Ellipse 1418" cx="14.387" cy="28.917" rx="14.387" ry="28.917" transform="matrix(0.835, -0.55, 0.55, 0.835, 10.461, 25.671)" fill="#d4d4dc" />
											<ellipse id="Ellipse_1419" data-name="Ellipse 1419" cx="14.281" cy="28.703" rx="14.281" ry="28.703" transform="matrix(0.835, -0.55, 0.55, 0.835, 10.667, 25.791)" fill="#d3d3db" />
											<ellipse id="Ellipse_1420" data-name="Ellipse 1420" cx="14.174" cy="28.49" rx="14.174" ry="28.49" transform="translate(10.873 25.911) rotate(-33.4)" fill="#d2d2da" />
											<ellipse id="Ellipse_1421" data-name="Ellipse 1421" cx="14.068" cy="28.276" rx="14.068" ry="28.276" transform="matrix(0.835, -0.55, 0.55, 0.835, 11.08, 26.031)" fill="#d1d1d9" />
											<ellipse id="Ellipse_1422" data-name="Ellipse 1422" cx="13.962" cy="28.063" rx="13.962" ry="28.063" transform="translate(11.286 26.151) rotate(-33.4)" fill="#d0d0d9" />
											<ellipse id="Ellipse_1423" data-name="Ellipse 1423" cx="13.855" cy="27.849" rx="13.855" ry="27.849" transform="matrix(0.835, -0.55, 0.55, 0.835, 11.492, 26.27)" fill="#cfcfd8" />
											<ellipse id="Ellipse_1424" data-name="Ellipse 1424" cx="13.749" cy="27.635" rx="13.749" ry="27.635" transform="matrix(0.835, -0.55, 0.55, 0.835, 11.699, 26.39)" fill="#ceced7" />
											<ellipse id="Ellipse_1425" data-name="Ellipse 1425" cx="13.643" cy="27.422" rx="13.643" ry="27.422" transform="matrix(0.835, -0.55, 0.55, 0.835, 11.905, 26.51)" fill="#cdcdd6" />
											<ellipse id="Ellipse_1426" data-name="Ellipse 1426" cx="13.537" cy="27.208" rx="13.537" ry="27.208" transform="translate(12.111 26.63) rotate(-33.4)" fill="#ccccd5" />
											<ellipse id="Ellipse_1427" data-name="Ellipse 1427" cx="13.43" cy="26.995" rx="13.43" ry="26.995" transform="translate(12.318 26.75) rotate(-33.4)" fill="#cbcbd5" />
											<ellipse id="Ellipse_1428" data-name="Ellipse 1428" cx="13.324" cy="26.781" rx="13.324" ry="26.781" transform="translate(12.524 26.87) rotate(-33.4)" fill="#cacad4" />
											<ellipse id="Ellipse_1429" data-name="Ellipse 1429" cx="13.218" cy="26.567" rx="13.218" ry="26.567" transform="translate(12.73 26.989) rotate(-33.4)" fill="#c9c9d3" />
											<ellipse id="Ellipse_1430" data-name="Ellipse 1430" cx="13.112" cy="26.354" rx="13.112" ry="26.354" transform="matrix(0.835, -0.55, 0.55, 0.835, 12.936, 27.109)" fill="#c8c8d2" />
											<ellipse id="Ellipse_1431" data-name="Ellipse 1431" cx="13.005" cy="26.14" rx="13.005" ry="26.14" transform="matrix(0.835, -0.55, 0.55, 0.835, 13.143, 27.229)" fill="#c7c7d1" />
											<ellipse id="Ellipse_1432" data-name="Ellipse 1432" cx="12.899" cy="25.927" rx="12.899" ry="25.927" transform="translate(13.349 27.349) rotate(-33.4)" fill="#c6c6d1" />
											<ellipse id="Ellipse_1433" data-name="Ellipse 1433" cx="12.793" cy="25.713" rx="12.793" ry="25.713" transform="matrix(0.835, -0.55, 0.55, 0.835, 13.555, 27.469)" fill="#c5c5d0" />
											<ellipse id="Ellipse_1434" data-name="Ellipse 1434" cx="12.686" cy="25.499" rx="12.686" ry="25.499" transform="translate(13.762 27.588) rotate(-33.4)" fill="#c4c4cf" />
											<ellipse id="Ellipse_1435" data-name="Ellipse 1435" cx="12.58" cy="25.286" rx="12.58" ry="25.286" transform="matrix(0.835, -0.55, 0.55, 0.835, 13.968, 27.708)" fill="#c3c3ce" />
											<ellipse id="Ellipse_1436" data-name="Ellipse 1436" cx="12.474" cy="25.072" rx="12.474" ry="25.072" transform="matrix(0.835, -0.55, 0.55, 0.835, 14.174, 27.828)" fill="#c2c2cd" />
											<ellipse id="Ellipse_1437" data-name="Ellipse 1437" cx="12.368" cy="24.858" rx="12.368" ry="24.858" transform="matrix(0.835, -0.55, 0.55, 0.835, 14.381, 27.948)" fill="#c1c1cc" />
											<ellipse id="Ellipse_1438" data-name="Ellipse 1438" cx="12.261" cy="24.645" rx="12.261" ry="24.645" transform="matrix(0.835, -0.55, 0.55, 0.835, 14.587, 28.068)" fill="#c0c0cc" />
											<ellipse id="Ellipse_1439" data-name="Ellipse 1439" cx="12.155" cy="24.431" rx="12.155" ry="24.431" transform="matrix(0.835, -0.55, 0.55, 0.835, 14.793, 28.188)" fill="#bfbfcb" />
											<ellipse id="Ellipse_1440" data-name="Ellipse 1440" cx="12.049" cy="24.218" rx="12.049" ry="24.218" transform="matrix(0.835, -0.55, 0.55, 0.835, 15, 28.307)" fill="#bebeca" />
											<ellipse id="Ellipse_1441" data-name="Ellipse 1441" cx="11.943" cy="24.004" rx="11.943" ry="24.004" transform="matrix(0.835, -0.55, 0.55, 0.835, 15.206, 28.427)" fill="#bdbdc9" />
											<ellipse id="Ellipse_1442" data-name="Ellipse 1442" cx="11.836" cy="23.79" rx="11.836" ry="23.79" transform="translate(15.412 28.547) rotate(-33.4)" fill="#bcbcc8" />
											<ellipse id="Ellipse_1443" data-name="Ellipse 1443" cx="11.73" cy="23.577" rx="11.73" ry="23.577" transform="translate(15.618 28.667) rotate(-33.4)" fill="#bbbbc7" />
											<ellipse id="Ellipse_1444" data-name="Ellipse 1444" cx="11.624" cy="23.363" rx="11.624" ry="23.363" transform="matrix(0.835, -0.55, 0.55, 0.835, 15.825, 28.787)" fill="#b9b9c6" />
											<ellipse id="Ellipse_1445" data-name="Ellipse 1445" cx="11.517" cy="23.15" rx="11.517" ry="23.15" transform="matrix(0.835, -0.55, 0.55, 0.835, 16.031, 28.907)" fill="#b8b8c6" />
											<ellipse id="Ellipse_1446" data-name="Ellipse 1446" cx="11.411" cy="22.936" rx="11.411" ry="22.936" transform="translate(16.237 29.026) rotate(-33.4)" fill="#b7b7c5" />
											<ellipse id="Ellipse_1447" data-name="Ellipse 1447" cx="11.305" cy="22.722" rx="11.305" ry="22.722" transform="translate(16.444 29.146) rotate(-33.4)" fill="#b6b6c4" />
											<ellipse id="Ellipse_1448" data-name="Ellipse 1448" cx="11.199" cy="22.509" rx="11.199" ry="22.509" transform="translate(16.65 29.266) rotate(-33.4)" fill="#b5b5c3" />
											<ellipse id="Ellipse_1449" data-name="Ellipse 1449" cx="11.092" cy="22.295" rx="11.092" ry="22.295" transform="translate(16.856 29.386) rotate(-33.4)" fill="#b4b4c2" />
											<ellipse id="Ellipse_1450" data-name="Ellipse 1450" cx="10.986" cy="22.082" rx="10.986" ry="22.082" transform="translate(17.063 29.506) rotate(-33.4)" fill="#b3b3c1" />
											<ellipse id="Ellipse_1451" data-name="Ellipse 1451" cx="10.88" cy="21.868" rx="10.88" ry="21.868" transform="translate(17.269 29.626) rotate(-33.4)" fill="#b2b2c0" />
											<ellipse id="Ellipse_1452" data-name="Ellipse 1452" cx="10.774" cy="21.654" rx="10.774" ry="21.654" transform="matrix(0.835, -0.55, 0.55, 0.835, 17.475, 29.745)" fill="#b1b1bf" />
											<ellipse id="Ellipse_1453" data-name="Ellipse 1453" cx="10.667" cy="21.441" rx="10.667" ry="21.441" transform="translate(17.681 29.865) rotate(-33.4)" fill="#b0b0be" />
											<ellipse id="Ellipse_1454" data-name="Ellipse 1454" cx="10.561" cy="21.227" rx="10.561" ry="21.227" transform="matrix(0.835, -0.55, 0.55, 0.835, 17.888, 29.985)" fill="#afafbd" />
											<ellipse id="Ellipse_1455" data-name="Ellipse 1455" cx="10.455" cy="21.014" rx="10.455" ry="21.014" transform="matrix(0.835, -0.55, 0.55, 0.835, 18.094, 30.105)" fill="#adadbd" />
											<ellipse id="Ellipse_1456" data-name="Ellipse 1456" cx="10.348" cy="20.8" rx="10.348" ry="20.8" transform="matrix(0.835, -0.55, 0.55, 0.835, 18.3, 30.225)" fill="#acacbc" />
											<ellipse id="Ellipse_1457" data-name="Ellipse 1457" cx="10.242" cy="20.586" rx="10.242" ry="20.586" transform="matrix(0.835, -0.55, 0.55, 0.835, 18.507, 30.344)" fill="#ababbb" />
											<ellipse id="Ellipse_1458" data-name="Ellipse 1458" cx="10.136" cy="20.373" rx="10.136" ry="20.373" transform="matrix(0.835, -0.55, 0.55, 0.835, 18.713, 30.464)" fill="#aaaaba" />
											<ellipse id="Ellipse_1459" data-name="Ellipse 1459" cx="10.03" cy="20.159" rx="10.03" ry="20.159" transform="translate(18.919 30.584) rotate(-33.4)" fill="#a9a9b9" />
											<ellipse id="Ellipse_1460" data-name="Ellipse 1460" cx="9.923" cy="19.946" rx="9.923" ry="19.946" transform="translate(19.126 30.704) rotate(-33.4)" fill="#a8a8b8" />
											<ellipse id="Ellipse_1461" data-name="Ellipse 1461" cx="9.817" cy="19.732" rx="9.817" ry="19.732" transform="matrix(0.835, -0.55, 0.55, 0.835, 19.332, 30.824)" fill="#a7a7b7" />
											<ellipse id="Ellipse_1462" data-name="Ellipse 1462" cx="9.711" cy="19.518" rx="9.711" ry="19.518" transform="translate(19.538 30.944) rotate(-33.4)" fill="#a5a5b6" />
											<ellipse id="Ellipse_1463" data-name="Ellipse 1463" cx="9.605" cy="19.305" rx="9.605" ry="19.305" transform="translate(19.745 31.063) rotate(-33.4)" fill="#a4a4b5" />
											<ellipse id="Ellipse_1464" data-name="Ellipse 1464" cx="9.498" cy="19.091" rx="9.498" ry="19.091" transform="translate(19.951 31.183) rotate(-33.4)" fill="#a3a3b4" />
											<ellipse id="Ellipse_1465" data-name="Ellipse 1465" cx="9.392" cy="18.878" rx="9.392" ry="18.878" transform="translate(20.157 31.303) rotate(-33.4)" fill="#a2a2b3" />
											<ellipse id="Ellipse_1466" data-name="Ellipse 1466" cx="9.286" cy="18.664" rx="9.286" ry="18.664" transform="matrix(0.835, -0.55, 0.55, 0.835, 20.363, 31.423)" fill="#a1a1b2" />
											<ellipse id="Ellipse_1467" data-name="Ellipse 1467" cx="9.179" cy="18.45" rx="9.179" ry="18.45" transform="matrix(0.835, -0.55, 0.55, 0.835, 20.57, 31.543)" fill="#a0a0b1" />
											<ellipse id="Ellipse_1468" data-name="Ellipse 1468" cx="9.073" cy="18.237" rx="9.073" ry="18.237" transform="translate(20.776 31.663) rotate(-33.4)" fill="#9e9eb0" />
											<ellipse id="Ellipse_1469" data-name="Ellipse 1469" cx="8.967" cy="18.023" rx="8.967" ry="18.023" transform="matrix(0.835, -0.55, 0.55, 0.835, 20.982, 31.782)" fill="#9d9daf" />
											<ellipse id="Ellipse_1470" data-name="Ellipse 1470" cx="8.861" cy="17.81" rx="8.861" ry="17.81" transform="matrix(0.835, -0.55, 0.55, 0.835, 21.189, 31.902)" fill="#9c9cae" />
											<ellipse id="Ellipse_1471" data-name="Ellipse 1471" cx="8.754" cy="17.596" rx="8.754" ry="17.596" transform="translate(21.395 32.022) rotate(-33.4)" fill="#9b9bad" />
											<ellipse id="Ellipse_1472" data-name="Ellipse 1472" cx="8.648" cy="17.382" rx="8.648" ry="17.382" transform="matrix(0.835, -0.55, 0.55, 0.835, 21.601, 32.142)" fill="#9a9aac" />
											<ellipse id="Ellipse_1473" data-name="Ellipse 1473" cx="8.542" cy="17.169" rx="8.542" ry="17.169" transform="matrix(0.835, -0.55, 0.55, 0.835, 21.808, 32.262)" fill="#9898ac" />
											<ellipse id="Ellipse_1474" data-name="Ellipse 1474" cx="8.436" cy="16.955" rx="8.436" ry="16.955" transform="matrix(0.835, -0.55, 0.55, 0.835, 22.014, 32.381)" fill="#9797ab" />
											<ellipse id="Ellipse_1475" data-name="Ellipse 1475" cx="8.329" cy="16.742" rx="8.329" ry="16.742" transform="matrix(0.835, -0.55, 0.55, 0.835, 22.22, 32.501)" fill="#9696aa" />
											<ellipse id="Ellipse_1476" data-name="Ellipse 1476" cx="8.223" cy="16.528" rx="8.223" ry="16.528" transform="translate(22.427 32.621) rotate(-33.4)" fill="#9595a9" />
											<ellipse id="Ellipse_1477" data-name="Ellipse 1477" cx="8.117" cy="16.314" rx="8.117" ry="16.314" transform="matrix(0.835, -0.55, 0.55, 0.835, 22.633, 32.741)" fill="#9494a8" />
											<ellipse id="Ellipse_1478" data-name="Ellipse 1478" cx="8.01" cy="16.101" rx="8.01" ry="16.101" transform="matrix(0.835, -0.55, 0.55, 0.835, 22.839, 32.861)" fill="#9292a7" />
											<ellipse id="Ellipse_1479" data-name="Ellipse 1479" cx="7.904" cy="15.887" rx="7.904" ry="15.887" transform="matrix(0.835, -0.55, 0.55, 0.835, 23.045, 32.981)" fill="#9191a6" />
											<ellipse id="Ellipse_1480" data-name="Ellipse 1480" cx="7.798" cy="15.674" rx="7.798" ry="15.674" transform="translate(23.252 33.1) rotate(-33.4)" fill="#9090a5" />
											<ellipse id="Ellipse_1481" data-name="Ellipse 1481" cx="7.692" cy="15.46" rx="7.692" ry="15.46" transform="matrix(0.835, -0.55, 0.55, 0.835, 23.458, 33.22)" fill="#8f8fa4" />
											<ellipse id="Ellipse_1482" data-name="Ellipse 1482" cx="7.585" cy="15.246" rx="7.585" ry="15.246" transform="translate(23.664 33.34) rotate(-33.4)" fill="#8d8da3" />
											<ellipse id="Ellipse_1483" data-name="Ellipse 1483" cx="7.479" cy="15.033" rx="7.479" ry="15.033" transform="matrix(0.835, -0.55, 0.55, 0.835, 23.871, 33.46)" fill="#8c8ca2" />
											<ellipse id="Ellipse_1484" data-name="Ellipse 1484" cx="7.373" cy="14.819" rx="7.373" ry="14.819" transform="translate(24.077 33.58) rotate(-33.4)" fill="#8b8ba1" />
											<ellipse id="Ellipse_1485" data-name="Ellipse 1485" cx="7.267" cy="14.606" rx="7.267" ry="14.606" transform="matrix(0.835, -0.55, 0.55, 0.835, 24.283, 33.7)" fill="#8a8aa0" />
											<ellipse id="Ellipse_1486" data-name="Ellipse 1486" cx="7.16" cy="14.392" rx="7.16" ry="14.392" transform="translate(24.49 33.819) rotate(-33.4)" fill="#88889e" />
											<ellipse id="Ellipse_1487" data-name="Ellipse 1487" cx="7.054" cy="14.178" rx="7.054" ry="14.178" transform="translate(24.696 33.939) rotate(-33.4)" fill="#87879d" />
											<ellipse id="Ellipse_1488" data-name="Ellipse 1488" cx="6.948" cy="13.965" rx="6.948" ry="13.965" transform="matrix(0.835, -0.55, 0.55, 0.835, 24.902, 34.059)" fill="#86869c" />
											<ellipse id="Ellipse_1489" data-name="Ellipse 1489" cx="6.841" cy="13.751" rx="6.841" ry="13.751" transform="matrix(0.835, -0.55, 0.55, 0.835, 25.109, 34.179)" fill="#85859b" />
											<ellipse id="Ellipse_1490" data-name="Ellipse 1490" cx="6.735" cy="13.537" rx="6.735" ry="13.537" transform="matrix(0.835, -0.55, 0.55, 0.835, 25.315, 34.299)" fill="#83839a" />
											<ellipse id="Ellipse_1491" data-name="Ellipse 1491" cx="6.629" cy="13.324" rx="6.629" ry="13.324" transform="matrix(0.835, -0.55, 0.55, 0.835, 25.521, 34.419)" fill="#828299" />
											<ellipse id="Ellipse_1492" data-name="Ellipse 1492" cx="6.523" cy="13.11" rx="6.523" ry="13.11" transform="matrix(0.835, -0.55, 0.55, 0.835, 25.727, 34.538)" fill="#818198" />
											<ellipse id="Ellipse_1493" data-name="Ellipse 1493" cx="6.416" cy="12.897" rx="6.416" ry="12.897" transform="translate(25.934 34.658) rotate(-33.4)" fill="#808097" />
											<ellipse id="Ellipse_1494" data-name="Ellipse 1494" cx="6.31" cy="12.683" rx="6.31" ry="12.683" transform="translate(26.14 34.778) rotate(-33.4)" fill="#7e7e96" />
											<ellipse id="Ellipse_1495" data-name="Ellipse 1495" cx="6.204" cy="12.469" rx="6.204" ry="12.469" transform="matrix(0.835, -0.55, 0.55, 0.835, 26.346, 34.898)" fill="#7d7d95" />
											<ellipse id="Ellipse_1496" data-name="Ellipse 1496" cx="6.098" cy="12.256" rx="6.098" ry="12.256" transform="matrix(0.835, -0.55, 0.55, 0.835, 26.553, 35.018)" fill="#7c7c94" />
											<ellipse id="Ellipse_1497" data-name="Ellipse 1497" cx="5.991" cy="12.042" rx="5.991" ry="12.042" transform="translate(26.759 35.137) rotate(-33.4)" fill="#7a7a93" />
											<ellipse id="Ellipse_1498" data-name="Ellipse 1498" cx="5.885" cy="11.829" rx="5.885" ry="11.829" transform="translate(26.965 35.257) rotate(-33.4)" fill="#797992" />
											<ellipse id="Ellipse_1499" data-name="Ellipse 1499" cx="5.779" cy="11.615" rx="5.779" ry="11.615" transform="matrix(0.835, -0.55, 0.55, 0.835, 27.172, 35.377)" fill="#787891" />
											<ellipse id="Ellipse_1500" data-name="Ellipse 1500" cx="5.672" cy="11.401" rx="5.672" ry="11.401" transform="translate(27.378 35.497) rotate(-33.4)" fill="#777790" />
											<ellipse id="Ellipse_1501" data-name="Ellipse 1501" cx="5.566" cy="11.188" rx="5.566" ry="11.188" transform="matrix(0.835, -0.55, 0.55, 0.835, 27.584, 35.617)" fill="#75758f" />
											<ellipse id="Ellipse_1502" data-name="Ellipse 1502" cx="5.46" cy="10.974" rx="5.46" ry="10.974" transform="matrix(0.835, -0.55, 0.55, 0.835, 27.79, 35.737)" fill="#74748e" />
											<ellipse id="Ellipse_1503" data-name="Ellipse 1503" cx="5.354" cy="10.761" rx="5.354" ry="10.761" transform="translate(27.997 35.856) rotate(-33.4)" fill="#73738d" />
											<ellipse id="Ellipse_1504" data-name="Ellipse 1504" cx="5.247" cy="10.547" rx="5.247" ry="10.547" transform="translate(28.203 35.976) rotate(-33.4)" fill="#71718c" />
											<ellipse id="Ellipse_1505" data-name="Ellipse 1505" cx="5.141" cy="10.333" rx="5.141" ry="10.333" transform="translate(28.409 36.096) rotate(-33.4)" fill="#70708b" />
											<ellipse id="Ellipse_1506" data-name="Ellipse 1506" cx="5.035" cy="10.12" rx="5.035" ry="10.12" transform="matrix(0.835, -0.55, 0.55, 0.835, 28.616, 36.216)" fill="#6f6f89" />
											<ellipse id="Ellipse_1507" data-name="Ellipse 1507" cx="4.929" cy="9.906" rx="4.929" ry="9.906" transform="matrix(0.835, -0.55, 0.55, 0.835, 28.822, 36.336)" fill="#6d6d88" />
											<ellipse id="Ellipse_1508" data-name="Ellipse 1508" cx="4.822" cy="9.693" rx="4.822" ry="9.693" transform="translate(29.028 36.456) rotate(-33.4)" fill="#6c6c87" />
											<ellipse id="Ellipse_1509" data-name="Ellipse 1509" cx="4.716" cy="9.479" rx="4.716" ry="9.479" transform="translate(29.235 36.575) rotate(-33.4)" fill="#6b6b86" />
											<ellipse id="Ellipse_1510" data-name="Ellipse 1510" cx="4.61" cy="9.265" rx="4.61" ry="9.265" transform="matrix(0.835, -0.55, 0.55, 0.835, 29.441, 36.695)" fill="#696985" />
											<ellipse id="Ellipse_1511" data-name="Ellipse 1511" cx="4.503" cy="9.052" rx="4.503" ry="9.052" transform="matrix(0.835, -0.55, 0.55, 0.835, 29.647, 36.815)" fill="#686884" />
											<ellipse id="Ellipse_1512" data-name="Ellipse 1512" cx="4.397" cy="8.838" rx="4.397" ry="8.838" transform="translate(29.854 36.935) rotate(-33.4)" fill="#676783" />
											<ellipse id="Ellipse_1513" data-name="Ellipse 1513" cx="4.291" cy="8.625" rx="4.291" ry="8.625" transform="matrix(0.835, -0.55, 0.55, 0.835, 30.06, 37.055)" fill="#656582" />
											<ellipse id="Ellipse_1514" data-name="Ellipse 1514" cx="4.185" cy="8.411" rx="4.185" ry="8.411" transform="matrix(0.835, -0.55, 0.55, 0.835, 30.266, 37.175)" fill="#646481" />
											<ellipse id="Ellipse_1515" data-name="Ellipse 1515" cx="4.078" cy="8.197" rx="4.078" ry="8.197" transform="matrix(0.835, -0.55, 0.55, 0.835, 30.472, 37.294)" fill="#626280" />
											<path
												id="Path_27839"
												data-name="Path 27839"
												d="M1476.99,1252.416c-1.788,1.272-5.232-.663-7.691-4.322s-3-7.657-1.214-8.929,5.231.663,7.691,4.322S1478.779,1251.144,1476.99,1252.416Z"
												transform="translate(-1434.148 -1203.898)"
												fill="#61617e"
											/>
											<ellipse id="Ellipse_1516" data-name="Ellipse 1516" cx="3.866" cy="7.77" rx="3.866" ry="7.77" transform="matrix(0.835, -0.55, 0.55, 0.835, 30.885, 37.534)" fill="#60607d" />
											<ellipse id="Ellipse_1517" data-name="Ellipse 1517" cx="3.76" cy="7.557" rx="3.76" ry="7.557" transform="translate(31.091 37.654) rotate(-33.4)" fill="#5e5e7c" />
											<ellipse id="Ellipse_1518" data-name="Ellipse 1518" cx="3.653" cy="7.343" rx="3.653" ry="7.343" transform="matrix(0.835, -0.55, 0.55, 0.835, 31.298, 37.774)" fill="#5d5d7b" />
											<ellipse id="Ellipse_1519" data-name="Ellipse 1519" cx="3.547" cy="7.129" rx="3.547" ry="7.129" transform="matrix(0.835, -0.55, 0.55, 0.835, 31.504, 37.893)" fill="#5c5c7a" />
											<ellipse id="Ellipse_1520" data-name="Ellipse 1520" cx="3.441" cy="6.916" rx="3.441" ry="6.916" transform="translate(31.71 38.013) rotate(-33.4)" fill="#5a5a79" />
											<ellipse id="Ellipse_1521" data-name="Ellipse 1521" cx="3.334" cy="6.702" rx="3.334" ry="6.702" transform="translate(31.917 38.133) rotate(-33.4)" fill="#595978" />
											<ellipse id="Ellipse_1522" data-name="Ellipse 1522" cx="3.228" cy="6.489" rx="3.228" ry="6.489" transform="translate(32.123 38.253) rotate(-33.4)" fill="#575777" />
											<ellipse id="Ellipse_1523" data-name="Ellipse 1523" cx="3.122" cy="6.275" rx="3.122" ry="6.275" transform="matrix(0.835, -0.55, 0.55, 0.835, 32.329, 38.373)" fill="#565675" />
											<path
												id="Path_27840"
												data-name="Path 27840"
												d="M1478.939,1254.67c-1.358.966-3.972-.5-5.839-3.281s-2.28-5.813-.922-6.779,3.972.5,5.839,3.281S1480.3,1253.7,1478.939,1254.67Z"
												transform="translate(-1437.168 -1207.747)"
												fill="#555574"
											/>
											<path
												id="Path_27841"
												data-name="Path 27841"
												d="M1479.155,1254.92c-1.31.932-3.832-.485-5.633-3.166s-2.2-5.608-.89-6.54,3.832.485,5.633,3.165S1480.465,1253.989,1479.155,1254.92Z"
												transform="translate(-1437.504 -1208.175)"
												fill="#535373"
											/>
											<path
												id="Path_27842"
												data-name="Path 27842"
												d="M1479.371,1255.171c-1.262.9-3.692-.468-5.427-3.05s-2.119-5.4-.857-6.3,3.692.468,5.427,3.05S1480.634,1254.273,1479.371,1255.171Z"
												transform="translate(-1437.839 -1208.602)"
												fill="#525272"
											/>
											<path
												id="Path_27843"
												data-name="Path 27843"
												d="M1479.588,1255.421c-1.214.864-3.552-.45-5.222-2.935s-2.039-5.2-.825-6.062,3.552.45,5.222,2.934S1480.8,1254.557,1479.588,1255.421Z"
												transform="translate(-1438.175 -1209.03)"
												fill="#505071"
											/>
											<path
												id="Path_27844"
												data-name="Path 27844"
												d="M1479.8,1255.671c-1.166.83-3.412-.432-5.016-2.819s-1.958-4.994-.792-5.824,3.412.432,5.016,2.819S1480.971,1254.842,1479.8,1255.671Z"
												transform="translate(-1438.511 -1209.458)"
												fill="#4f4f70"
											/>
											<path
												id="Path_27845"
												data-name="Path 27845"
												d="M1480.021,1255.922c-1.119.8-3.272-.414-4.81-2.7s-1.878-4.789-.76-5.585,3.272.415,4.81,2.7S1481.14,1255.126,1480.021,1255.922Z"
												transform="translate(-1438.846 -1209.885)"
												fill="#4e4e6f"
											/>
											<path
												id="Path_27846"
												data-name="Path 27846"
												d="M1480.238,1256.172c-1.071.762-3.132-.4-4.6-2.587s-1.8-4.584-.727-5.346,3.132.4,4.6,2.588S1481.308,1255.41,1480.238,1256.172Z"
												transform="translate(-1439.182 -1210.313)"
												fill="#4c4c6d"
											/>
											<path
												id="Path_27847"
												data-name="Path 27847"
												d="M1480.454,1256.423c-1.023.728-2.992-.379-4.4-2.472s-1.717-4.379-.695-5.107,2.992.379,4.4,2.472S1481.477,1255.7,1480.454,1256.423Z"
												transform="translate(-1439.518 -1210.74)"
												fill="#4b4b6c"
											/>
											<ellipse id="Ellipse_1524" data-name="Ellipse 1524" cx="2.165" cy="4.353" rx="2.165" ry="4.353" transform="translate(34.186 39.451) rotate(-33.4)" fill="#49496b" />
											<path
												id="Path_27848"
												data-name="Path 27848"
												d="M1480.887,1256.924c-.927.66-2.712-.344-3.987-2.24s-1.557-3.97-.63-4.629,2.712.344,3.987,2.24S1481.814,1256.264,1480.887,1256.924Z"
												transform="translate(-1440.189 -1211.596)"
												fill="#48486a"
											/>
										</g>
									</g>
								</g>
								<path
									id="Path_27850"
									data-name="Path 27850"
									d="M1409.342,1225.911c-.523-14.779-13.627-32.809-29.121-40.066-7.608-3.563-14.428-3.887-19.344-1.55l-.007,0-.073.039c-.392.189-.774.392-1.141.615l-9.58,5.169,3.431,3.752a21.584,21.584,0,0,0-.507,5.654c.522,14.779,13.627,32.809,29.121,40.066a34.5,34.5,0,0,0,6.458,2.306c1.618,2.423,2.981,4.485,2.981,4.485l10.086-5.321v0C1406.634,1238.6,1409.6,1233.346,1409.342,1225.911Z"
									transform="translate(-1343.817 -1165)"
									fill="#02126a"
								/>
								<path
									id="Path_27851"
									data-name="Path 27851"
									d="M1380.525,1186c-.1-.049-.2-.1-.3-.15-7.608-3.563-14.428-3.887-19.344-1.55l-.007,0-.073.039c-.392.189-.774.392-1.141.615l-9.58,5.169,1.931,2.112,19.02-1.462Z"
									transform="translate(-1343.817 -1165)"
									fill="#02126a"
								/>
								<path id="Path_27852" data-name="Path 27852" d="M1329.667,1254.629c.339,7.39,3.789,15.564,9.09,22.787l19.073-9.6Z" transform="translate(-1329.633 -1214.916)" fill="#151617" />
								<path
									id="Path_27853"
									data-name="Path 27853"
									d="M1356.794,1201.927h0c-15.494-7.257-27.743-1.1-27.22,13.677,0,.094.013.188.017.282l28.163,13.191Z"
									transform="translate(-1329.557 -1176.173)"
									fill="url(#linear-gradient-12)"
								/>
								<path
									id="Path_27854"
									data-name="Path 27854"
									d="M1377.58,1208.869l.96,27.15-19.073,9.6a54.413,54.413,0,0,0,20.013,17c15.494,7.257,27.743,1.1,27.22-13.676S1393.074,1216.126,1377.58,1208.869Z"
									transform="translate(-1350.343 -1183.115)"
									fill="#eff4fe"
								/>
							</g>
						</g>
					</g>
				</g>
			</g>
			<g id="Layer_12" data-name="Layer 12" transform="translate(0 8.543)">
				<g id="Group_15692" class="Group_15692" data-name="Group 15692" transform="translate(125.245 127.834)">
					<path id="Path_27935" data-name="Path 27935" d="M801.9,775.083l13.268-7.66-13.268-7.66-13.268,7.66Z" transform="translate(-788.63 -743.925)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15691" data-name="Group 15691" transform="translate(1.334)">
						<path id="Path_27936" data-name="Path 27936" d="M793,730.43v13.781l11.934,6.89V737.32Z" transform="translate(-793.002 -723.54)" fill="#d3ddf7" />
						<path id="Path_27937" data-name="Path 27937" d="M844.06,730.43v13.781l-11.934,6.89V737.32Z" transform="translate(-820.191 -723.54)" fill="#e2e9fa" />
						<path id="Path_27938" data-name="Path 27938" d="M804.937,721.623l11.934-6.89-11.934-6.89L793,714.733Z" transform="translate(-793.002 -707.843)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15694" class="Group_15694" data-name="Group 15694" transform="translate(631.015 70.336)">
					<path id="Path_27939" data-name="Path 27939" d="M2446.344,588.866l13.268-7.66-13.268-7.66-13.268,7.66Z" transform="translate(-2433.076 -557.707)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15693" data-name="Group 15693" transform="translate(1.334)">
						<path id="Path_27940" data-name="Path 27940" d="M2437.448,544.212v13.781l11.935,6.89V551.1Z" transform="translate(-2437.448 -537.322)" fill="#d3ddf7" />
						<path id="Path_27941" data-name="Path 27941" d="M2488.506,544.212v13.781l-11.934,6.89V551.1Z" transform="translate(-2464.637 -537.322)" fill="#e2e9fa" />
						<path id="Path_27942" data-name="Path 27942" d="M2449.383,535.405l11.934-6.89-11.934-6.89-11.935,6.89Z" transform="translate(-2437.448 -521.625)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15696" class="Group_15696" data-name="Group 15696" transform="translate(726.54 151.065)">
					<path id="Path_27943" data-name="Path 27943" d="M2759.5,850.823l13.268-7.66L2759.5,835.5l-13.268,7.66Z" transform="translate(-2746.228 -819.665)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15695" data-name="Group 15695" transform="translate(1.334)">
						<path id="Path_27944" data-name="Path 27944" d="M2750.6,806.17v13.781l11.935,6.89V813.06Z" transform="translate(-2750.599 -799.28)" fill="#d3ddf7" />
						<path id="Path_27945" data-name="Path 27945" d="M2801.657,806.17v13.781l-11.934,6.89V813.06Z" transform="translate(-2777.788 -799.28)" fill="#e2e9fa" />
						<path id="Path_27946" data-name="Path 27946" d="M2762.534,797.363l11.935-6.89-11.935-6.89-11.934,6.89Z" transform="translate(-2750.599 -783.583)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15698" class="Group_15698" transform="translate(0 149.496)">
					<path id="Path_27947" data-name="Path 27947" d="M394.146,845.708l13.268-7.66-13.268-7.66-13.268,7.66Z" transform="translate(-380.879 -814.549)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15697" data-name="Group 15697" transform="translate(1.334)">
						<path id="Path_27948" data-name="Path 27948" d="M385.25,801.055v13.781l11.934,6.89V807.945Z" transform="translate(-385.25 -794.164)" fill="#d3ddf7" />
						<path id="Path_27949" data-name="Path 27949" d="M436.308,801.055v13.781l-11.934,6.89V807.945Z" transform="translate(-412.439 -794.164)" fill="#e2e9fa" />
						<path id="Path_27950" data-name="Path 27950" d="M397.185,792.248l11.934-6.89-11.934-6.89-11.934,6.89Z" transform="translate(-385.25 -778.467)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15700" class="Group_15700" data-name="Group 15700" transform="translate(77.295 198.73)">
					<path id="Path_27951" data-name="Path 27951" d="M660.822,1073.357l26.555-15.331-26.555-15.331-26.555,15.331Z" transform="translate(-634.268 -1010.996)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15699" data-name="Group 15699" transform="translate(2.669)">
						<path id="Path_27952" data-name="Path 27952" d="M643.017,983.988v27.581l23.886,13.79V997.778Z" transform="translate(-643.017 -970.197)" fill="#d3ddf7" />
						<path id="Path_27953" data-name="Path 27953" d="M745.2,983.988v27.581l-23.886,13.79V997.778Z" transform="translate(-697.434 -970.197)" fill="#e2e9fa" />
						<path id="Path_27954" data-name="Path 27954" d="M666.9,966.361l23.886-13.79L666.9,938.781l-23.886,13.79Z" transform="translate(-643.017 -938.781)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15702" class="Group_15702" data-name="Group 15702" transform="translate(653.883 184.254)">
					<path id="Path_27955" data-name="Path 27955" d="M2533.926,1022.784l25.884-14.944L2533.926,992.9l-25.884,14.944Z" transform="translate(-2508.042 -961.999)" fill="#2647c8" opacity="0.3" />
					<g id="Group_15701" data-name="Group 15701" transform="translate(2.602)">
						<path id="Path_27956" data-name="Path 27956" d="M2516.57,935.672v26.884L2539.852,976V949.114Z" transform="translate(-2516.57 -922.23)" fill="#d3ddf7" />
						<path id="Path_27957" data-name="Path 27957" d="M2616.177,935.672v26.884L2592.895,976V949.114Z" transform="translate(-2569.612 -922.23)" fill="#e2e9fa" />
						<path id="Path_27958" data-name="Path 27958" d="M2539.853,918.491l23.282-13.442-23.282-13.442-23.282,13.442Z" transform="translate(-2516.57 -891.607)" fill="#f0f4fc" />
					</g>
				</g>
				<g id="Group_15712" class="Group_15712" data-name="Group 15712" transform="translate(636.847 0)">
					<path
						id="Path_27971"
						data-name="Path 27971"
						d="M2548.077,737.512c9.184-5.273,9.184-13.9,0-19.173s-24.171-5.273-33.3,0-9.133,13.9,0,19.173S2538.893,742.784,2548.077,737.512Z"
						transform="translate(-2490.924 -585.248)"
						fill="url(#radial-gradient)"
						style="mix-blend-mode: multiply; isolation: isolate;"
					/>
					<path
						id="Path_27972"
						data-name="Path 27972"
						d="M2557.75,701.062c6.78-3.892,6.78-22,0-25.891s-17.844-3.893-24.586,0-6.742,22,0,25.891c3.333,1.924,7.721,3.757,12.126,3.78C2549.8,704.864,2554.321,703.031,2557.75,701.062Z"
						transform="translate(-2504.951 -555.968)"
						fill="url(#linear-gradient-13)"
					/>
					<path
						id="Path_27973"
						data-name="Path 27973"
						d="M2562.011,671.512q0-.173,0-.346v-2.709h-.694A11.068,11.068,0,0,0,2556.75,664c-7.034-4.038-18.512-4.038-25.506,0a11.036,11.036,0,0,0-4.541,4.459h-.633v2.008a6.062,6.062,0,0,0,0,1.748v.048h0c.358,2.346,2.077,4.634,5.17,6.42,6.994,4.038,18.472,4.038,25.506,0,3.11-1.786,4.839-4.074,5.2-6.42h.062Z"
						transform="translate(-2503.491 -548.127)"
						fill="url(#linear-gradient-14)"
					/>
					<path
						id="Path_27974"
						data-name="Path 27974"
						d="M2556.729,670.218c7.034-4.038,7.034-10.646,0-14.684s-18.511-4.038-25.505,0-6.995,10.646,0,14.684S2549.7,674.257,2556.729,670.218Z"
						transform="translate(-2503.471 -542.245)"
						fill="#e2e9fa"
					/>
					<path
						id="Path_27975"
						data-name="Path 27975"
						d="M2559.031,671.543c6.462-3.71,6.462-9.781,0-13.49s-17.006-3.71-23.431,0-6.426,9.78,0,13.49S2552.569,675.252,2559.031,671.543Z"
						transform="translate(-2506.808 -544.167)"
						fill="#f0f4fc"
					/>
					<path
						id="Path_27976"
						data-name="Path 27976"
						d="M2563.75,679.927c5.289-3.036,5.289-8.005,0-11.042s-13.919-3.036-19.178,0-5.259,8.005,0,11.042S2558.461,682.963,2563.75,679.927Z"
						transform="translate(-2513.652 -552.046)"
						fill="#00759b"
					/>
					<g id="Group_15709" data-name="Group 15709" transform="translate(33.857 20.388)">
						<path
							id="Path_27977"
							data-name="Path 27977"
							d="M2570.887,461.755c.082-7.6.164-8.834.246-16.434.039-3.579.147-5.9-.107-9.472a49.321,49.321,0,0,0-1.92-10.118,108.83,108.83,0,0,1-4.274-21.231,137.428,137.428,0,0,1,.1-21.412c.609-8.169,1.717-16.29,2.844-24.4.111-.8-1.115-1.148-1.228-.339-1.979,14.244-3.959,28.627-3.2,43.044a93.177,93.177,0,0,0,3.439,20.956,81.646,81.646,0,0,1,2.621,10.315,53.135,53.135,0,0,1,.482,9.641c-.087,8.605-.186,10.845-.279,19.45a.637.637,0,0,0,1.273,0Z"
							transform="translate(-2563.185 -357.888)"
							fill="#05d3d8"
						/>
					</g>
					<g id="Group_15710" data-name="Group 15710" transform="translate(16.189 24.109)">
						<path
							id="Path_27978"
							data-name="Path 27978"
							d="M2524.538,415.212c-2.7-2.734-5.439-5.556-7.269-8.973a14.843,14.843,0,0,1-1.779-5.652,33.194,33.194,0,0,1,.456-6.726,19.2,19.2,0,0,0-2.3-11.72c-2.144-4.048-4.694-7.916-7.176-11.762-.443-.686-1.545-.049-1.1.642,2.521,3.907,5.132,7.836,7.283,11.963a18.081,18.081,0,0,1,2.165,6.473,31.3,31.3,0,0,1-.429,6.723,17.489,17.489,0,0,0,1.972,11.048,43.062,43.062,0,0,0,7.277,8.883c.577.584,1.477-.316.9-.9Z"
							transform="translate(-2505.265 -370.085)"
							fill="#05d3d8"
						/>
					</g>
					<g id="Group_15711" data-name="Group 15711" transform="translate(36.023 49.199)">
						<path
							id="Path_27979"
							data-name="Path 27979"
							d="M2571.565,481.477c.743-5.7,7.223-8.647,10.731-12.52a26.752,26.752,0,0,0,6.8-16.01c.059-.818-1.214-.814-1.273,0a25.34,25.34,0,0,1-8.122,16.812c-3.708,3.385-8.7,6.289-9.406,11.718-.105.81,1.169.8,1.273,0Z"
							transform="translate(-2570.285 -452.335)"
							fill="#05d3d8"
						/>
					</g>
					<path
						id="Path_27980"
						data-name="Path 27980"
						d="M2473.027,308.481c-.58-3.622-3.671-6.235-6.553-8.505-4.43-3.489-8.965-7.037-14.279-8.925a39.989,39.989,0,0,1,4.429,11.023c.64,2.7,1.085,5.647,3.006,7.653,2.673,2.791,7.737,3.247,9.024,6.892l2.795,3.981C2470.924,316.529,2473.675,312.534,2473.027,308.481Z"
						transform="translate(-2452.195 -291.051)"
						fill="#05d3d8"
					/>
					<path
						id="Path_27981"
						data-name="Path 27981"
						d="M2571.472,313.767c-2.084,4.812-8.823,6.47-10.447,11.456-1.678,5.151,3.143,10.655,1.78,15.9l1.289.666c3.749-3.323,5.945-8.129,6.913-13.044A57.491,57.491,0,0,0,2571.472,313.767Z"
						transform="translate(-2527.577 -306.838)"
						fill="#05d3d8"
					/>
					<path
						id="Path_27982"
						data-name="Path 27982"
						d="M2636.244,377.261c-4.233,2.66-7.5,6.572-10.7,10.418a7.485,7.485,0,0,0-2.352,6.7q.286,5.968.571,11.936l.356,1.556c1.892-3.029,6.977-3.127,8.268-6.457a8.412,8.412,0,0,0,.17-3.819A38.746,38.746,0,0,1,2636.244,377.261Z"
						transform="translate(-2571.007 -350.963)"
						fill="#05d3d8"
					/>
				</g>
				<g id="Group_15715" class="Group_15715" data-name="Group 15715" transform="translate(54.64 100.337)">
					<path id="Path_27983" data-name="Path 27983" d="M622.286,629.887s-11.139,23.458-6.794,51.142C615.492,681.029,631.666,633.963,622.286,629.887Z" transform="translate(-597.865 -626.254)" fill="#00759b" />
					<path
						id="Path_27984"
						data-name="Path 27984"
						d="M604.165,859.458c7.591-4.359,7.591-11.49,0-15.848s-19.978-4.358-27.527,0-7.549,11.489,0,15.848S596.573,863.815,604.165,859.458Z"
						transform="translate(-567.628 -772.51)"
						fill="url(#radial-gradient-2)"
						style="mix-blend-mode: multiply; isolation: isolate;"
					/>
					<path
						id="Path_27985"
						data-name="Path 27985"
						d="M612.16,829.33c5.6-3.217,5.6-18.183,0-21.4s-14.749-3.218-20.321,0-5.573,18.183,0,21.4a21.138,21.138,0,0,0,10.023,3.124A21.383,21.383,0,0,0,612.16,829.33Z"
						transform="translate(-579.221 -748.309)"
						fill="url(#linear-gradient-15)"
					/>
					<path
						id="Path_27986"
						data-name="Path 27986"
						d="M615.681,804.906c0-.1,0-.191,0-.286v-2.239h-.574a9.149,9.149,0,0,0-3.775-3.686c-5.814-3.337-15.3-3.337-21.081,0a9.124,9.124,0,0,0-3.753,3.686h-.523v1.66a5.037,5.037,0,0,0,0,1.445v.039h0c.3,1.939,1.717,3.831,4.273,5.307,5.781,3.338,15.268,3.338,21.081,0,2.571-1.476,4-3.367,4.3-5.307h.051Z"
						transform="translate(-578.015 -741.828)"
						fill="url(#linear-gradient-16)"
					/>
					<path id="Path_27987" data-name="Path 27987" d="M611.316,803.836c5.814-3.338,5.814-8.8,0-12.137s-15.3-3.338-21.081,0-5.781,8.8,0,12.137S605.5,807.174,611.316,803.836Z" transform="translate(-577.998 -736.966)" fill="#cdd5fe" />
					<path id="Path_27988" data-name="Path 27988" d="M613.218,804.931c5.341-3.067,5.341-8.084,0-11.15s-14.056-3.066-19.367,0-5.311,8.084,0,11.15S607.877,808,613.218,804.931Z" transform="translate(-580.756 -738.554)" fill="#e6eafe" />
					<path id="Path_27989" data-name="Path 27989" d="M617.119,811.861c4.372-2.51,4.372-6.616,0-9.126s-11.5-2.51-15.852,0-4.347,6.616,0,9.126S612.747,814.371,617.119,811.861Z" transform="translate(-586.413 -745.067)" fill="#00759b" />
					<path
						id="Path_27990"
						data-name="Path 27990"
						d="M583.835,682.513s-23.018-17.877-23.815-44.538c-.008-.268,2.119-.536,2.115-.8s-2.137-.532-2.136-.8a48.167,48.167,0,0,1,1.2-10.446c3.564-15.784,10.38-5.76,15.825,10.048.123.357-1.887.717-1.766,1.08.19.566,2.51,1.138,2.7,1.717C583.456,655.913,587.174,678.1,583.835,682.513Z"
						transform="translate(-559.999 -617.977)"
						fill="#05d3d8"
					/>
					<g id="Group_15713" data-name="Group 15713" transform="translate(6.42 6.754)">
						<path
							id="Path_27991"
							data-name="Path 27991"
							d="M596.147,688.164c-7.048-14.608-14.793-31.211-14.549-47.78a.275.275,0,0,0-.55,0c-.23,16.5,7.176,33.572,14.912,47.889.067.124.247.015.187-.109Z"
							transform="translate(-581.044 -640.118)"
							fill="#02126a"
						/>
					</g>
					<path
						id="Path_27992"
						data-name="Path 27992"
						d="M633.548,703.4s-9.425-37.079,10.034-51.829c.5-.376-.378,3.812.148,3.461s1.075-3.879,1.645-4.187a25.851,25.851,0,0,1,12.848-2.81c19.919.287,14.987,2.616,4.167,12.089-.389.341-5.051.691-5.455,1.05-.347.309,3.567.625,3.21.948C651.048,670.374,639.069,683.3,633.548,703.4Z"
						transform="translate(-609.526 -638.862)"
						fill="#05d3d8"
					/>
					<g id="Group_15714" data-name="Group 15714" transform="translate(23.977 12.278)">
						<path
							id="Path_27993"
							data-name="Path 27993"
							d="M638.734,702.372c1.376-19.872,10.808-36.2,29.723-43.8.205-.082.121-.417-.093-.338-18.523,6.924-29.531,24.506-29.763,44.135a.067.067,0,0,0,.133,0Z"
							transform="translate(-638.601 -658.225)"
							fill="#02126a"
						/>
					</g>
				</g>
				<g id="Group_15716" class="Group_15716" transform="translate(13.268 270.361)">
					<path
						id="Path_27994"
						data-name="Path 27994"
						d="M495.036,1296.419c-16.11-9.3-42.471-9.3-58.58,0s-16.11,24.52,0,33.821,42.47,9.3,58.58,0S511.145,1305.719,495.036,1296.419Z"
						transform="translate(-424.374 -1253.628)"
						fill="url(#radial-gradient-3)"
						style="mix-blend-mode: multiply; isolation: isolate;"
					/>
					<path
						id="Path_27995"
						data-name="Path 27995"
						d="M454.837,1305.411h3.592a23.392,23.392,0,0,1,5.777-4.559c12.491-7.212,32.931-7.212,45.423,0a23.4,23.4,0,0,1,5.777,4.559H519v8.486h0c.03,4.775-3.09,9.557-9.365,13.18-12.491,7.211-32.931,7.211-45.423,0-6.275-3.623-9.4-8.4-9.366-13.18h0Z"
						transform="translate(-445.544 -1257.798)"
						fill="url(#linear-gradient-17)"
					/>
					<path
						id="Path_27996"
						data-name="Path 27996"
						d="M509.628,1272.813c-12.491-7.212-32.931-7.212-45.423,0s-12.491,19.013,0,26.224,32.932,7.212,45.423,0S522.119,1280.024,509.628,1272.813Z"
						transform="translate(-445.545 -1238.311)"
						fill="#fff"
					/>
					<path
						id="Path_27997"
						data-name="Path 27997"
						d="M454.857,1296.52q0-.17,0-.341v-7.024h2.491a21.8,21.8,0,0,1,6.871-5.918c8.825-5.095,2.9,14.362,0,26.224v8.55c-6.117-3.531-9.231-8.165-9.357-12.82Z"
						transform="translate(-445.557 -1248.736)"
						fill="url(#linear-gradient-18)"
					/>
					<path id="Path_27998" data-name="Path 27998" d="M464.206,1261.55c-12.491,7.212-12.491,19.013,0,26.224l22.712-10.714Z" transform="translate(-445.545 -1234.243)" fill="url(#linear-gradient-19)" />
					<path id="Path_27999" data-name="Path 27999" d="M508.259,1312.4v7.194L485.548,1330.3v-7.195Z" transform="translate(-466.887 -1269.578)" fill="url(#linear-gradient-20)" />
					<path
						id="Path_28000"
						data-name="Path 28000"
						d="M511.618,1206.176c-12-6.927-31.63-6.927-43.627,0s-12,18.261,0,25.188,31.63,6.926,43.627,0S523.616,1213.1,511.618,1206.176Z"
						transform="translate(-448.433 -1192.151)"
						fill="url(#radial-gradient-4)"
						style="mix-blend-mode: multiply; isolation: isolate;"
					/>
					<path id="Path_28001" data-name="Path 28001" d="M485.548,1177.442c12.491-7.212,32.932-7.212,45.423,0l-22.711,15.51Z" transform="translate(-466.887 -1172.033)" fill="#354188" />
					<path id="Path_28002" data-name="Path 28002" d="M582.712,1189.764v14.389L560,1219.664v-14.389Z" transform="translate(-518.629 -1184.356)" fill="#1b2a79" />
					<path id="Path_28003" data-name="Path 28003" d="M508.259,1205.275l-22.712-15.51v14.389l22.712,15.51Z" transform="translate(-466.887 -1184.356)" fill="#02126a" />
				</g>
				<g id="Group_15718" class="Group_15718" transform="translate(304.693 455.135)">
					<g id="Group_15706" data-name="Group 15706" transform="translate(-15.179 52.165)">
						<path id="Path_27963" data-name="Path 27963" d="M1375.553,2056.317l52.923-30.555-52.923-30.554-52.922,30.554Z" transform="translate(-1322.63 -1979.661)" fill="#2647c8" opacity="0.3" />
						<g id="Group_15705" data-name="Group 15705" transform="translate(1.804)">
							<path id="Path_27964" data-name="Path 27964" d="M1328.546,2040.99v6.734l51.118,29.513V2070.5Z" transform="translate(-1328.545 -2011.478)" fill="#d3ddf7" />
							<path id="Path_27965" data-name="Path 27965" d="M1547.238,2040.99v6.734l-51.118,29.513V2070.5Z" transform="translate(-1445.002 -2011.478)" fill="#e2e9fa" />
							<path id="Path_27966" data-name="Path 27966" d="M1379.664,2003.268l51.118-29.513-51.118-29.512-51.118,29.512Z" transform="translate(-1328.546 -1944.243)" fill="#f0f4fc" />
						</g>
					</g>
					<ellipse id="Ellipse_1525" data-name="Ellipse 1525" cx="30.083" cy="17.368" rx="30.083" ry="17.368" transform="translate(6.202 65.915)" fill="url(#radial-gradient-5)" style="mix-blend-mode: multiply; isolation: isolate;" />
					<g id="Group_15717" data-name="Group 15717">
						<path
							id="Path_28004"
							data-name="Path 28004"
							d="M1470.171,2001.689l-1.211,1.013h-10.588l-1.149-1.058a16.466,16.466,0,0,1-5.315-12.116v-4.606h24.167v4.135A16.467,16.467,0,0,1,1470.171,2001.689Z"
							transform="translate(-1427.648 -1920.348)"
							fill="#02126a"
						/>
						<path id="Path_28005" data-name="Path 28005" d="M1479.566,2045.8h-3.95a3.514,3.514,0,0,1-3.514-3.514h10.977A3.514,3.514,0,0,1,1479.566,2045.8Z" transform="translate(-1441.682 -1960.217)" fill="#02126a" />
						<path
							id="Path_28006"
							data-name="Path 28006"
							d="M1472.489,1964.2c-4.692-2.709-12.37-2.709-17.063,0s-4.692,7.142,0,9.851,12.37,2.709,17.063,0S1477.181,1966.906,1472.489,1964.2Z"
							transform="translate(-1427.647 -1904.532)"
							fill="#2842a2"
						/>
						<path
							id="Path_28007"
							data-name="Path 28007"
							d="M1441.2,1836.289a22.085,22.085,0,0,0-12.079,40.58v5h0c.069,1.716,1.342,3.452,3.6,4.754,4.652,2.686,12.354,2.654,17.006-.032,2.255-1.3,3.408-3.006,3.476-4.722h.078v-5a22.085,22.085,0,0,0-12.079-40.58Z"
							transform="translate(-1404.85 -1817.055)"
							opacity="0.83"
							fill="url(#linear-gradient-21)"
						/>
						<path
							id="Path_28008"
							data-name="Path 28008"
							d="M1439.186,1869.671a14.446,14.446,0,0,1,14.447-14.447c7.385,0,6.814-6.158-2.6-6.158a17.047,17.047,0,0,0-17.047,17.047C1433.986,1872.086,1439.186,1874.733,1439.186,1869.671Z"
							transform="translate(-1415.193 -1825.934)"
							fill="#fff"
						/>
						<path
							id="Path_28009"
							data-name="Path 28009"
							d="M1472.536,1996.745c-4.653,2.686-12.354,2.718-17.006.032-2.255-1.3-3.528-3.038-3.6-4.754v1.655c.069,1.716,1.342,3.452,3.6,4.754,4.652,2.686,12.354,2.655,17.006-.032,2.256-1.3,3.408-3.006,3.476-4.722h.078v-1.655h-.078C1475.944,1993.739,1474.792,1995.443,1472.536,1996.745Z"
							transform="translate(-1427.666 -1925.283)"
							fill="#516cd3"
							opacity="0.49"
						/>
						<path
							id="Path_28010"
							data-name="Path 28010"
							d="M1473.905,2017.112c-4.653,2.686-12.354,2.718-17.007.032a8.117,8.117,0,0,1-2.9-2.656,16.48,16.48,0,0,0,1.223,3.094,9.843,9.843,0,0,0,1.681,1.218c4.653,2.687,12.354,2.654,17.007-.032a9.6,9.6,0,0,0,1.392-.973,16.434,16.434,0,0,0,1.475-3.381A7.543,7.543,0,0,1,1473.905,2017.112Z"
							transform="translate(-1429.099 -1940.843)"
							fill="#516cd3"
							opacity="0.49"
						/>
						<path
							id="Path_28011"
							data-name="Path 28011"
							d="M1408.648,1790.639h-.009a1.8,1.8,0,0,1-1.792-1.809l.067-13.8a1.8,1.8,0,0,1,1.8-1.792h.009a1.8,1.8,0,0,1,1.791,1.809l-.067,13.8A1.8,1.8,0,0,1,1408.648,1790.639Zm14.75,2.616,6.971-11.912a1.8,1.8,0,1,0-3.108-1.818l-6.971,11.912a1.8,1.8,0,0,0,3.108,1.818Zm9,10.3,12-6.818a1.8,1.8,0,0,0-1.779-3.131l-12,6.818a1.8,1.8,0,0,0,1.779,3.131Zm-44.826-.818a1.8,1.8,0,0,0-.621-2.469l-11.846-7.086a1.8,1.8,0,0,0-1.849,3.091l11.846,7.085a1.8,1.8,0,0,0,2.47-.621Zm9.066-8.921a1.8,1.8,0,0,0,.7-2.448l-6.7-12.066a1.8,1.8,0,0,0-3.147,1.749l6.7,12.066a1.8,1.8,0,0,0,2.447.7Z"
							transform="translate(-1372.38 -1773.236)"
							opacity="0.83"
							fill="url(#linear-gradient-21)"
						/>
					</g>
				</g>
				<g id="Group_15738" class="Group_15738" transform="translate(518.054 486.943)">
					<g id="Group_15704" data-name="Group 15704" transform="translate(-11.481 6.188)">
						<path id="Path_27959" data-name="Path 27959" d="M2064.077,2073.632l34.7-20.032-34.7-20.032-34.7,20.032Z" transform="translate(-2029.38 -1992.151)" fill="#2647c8" opacity="0.3" />
						<g id="Group_15703" data-name="Group 15703" transform="translate(3.487)">
							<path id="Path_27960" data-name="Path 27960" d="M2040.812,1956.861V1992.9l31.209,18.019V1974.88Z" transform="translate(-2040.812 -1938.843)" fill="#d3ddf7" />
							<path id="Path_27961" data-name="Path 27961" d="M2174.331,1956.861V1992.9l-31.209,18.019V1974.88Z" transform="translate(-2111.913 -1938.843)" fill="#e2e9fa" />
							<path id="Path_27962" data-name="Path 27962" d="M2072.022,1933.83l31.209-18.019-31.209-18.018-31.209,18.018Z" transform="translate(-2040.813 -1897.793)" fill="#f0f4fc" />
						</g>
					</g>
					<g id="Group_15725" data-name="Group 15725" transform="translate(0 11.637)">
						<g id="Group_15719" data-name="Group 15719">
							<path
								id="Path_28012"
								data-name="Path 28012"
								d="M2105.612,1919.453c-8.764-5.06-23.105-5.06-31.87,0s-8.764,13.34,0,18.4,23.105,5.06,31.87,0S2114.376,1924.513,2105.612,1919.453Z"
								transform="translate(-2067.169 -1915.658)"
								fill="#fff"
								opacity="0"
							/>
							<path
								id="Path_28013"
								data-name="Path 28013"
								d="M2106.171,1920.068c-8.625-4.98-22.739-4.98-31.364,0s-8.625,13.129,0,18.108,22.74,4.98,31.364,0S2114.8,1925.048,2106.171,1920.068Z"
								transform="translate(-2067.981 -1916.127)"
								fill="#fbfbfd"
								opacity="0.02"
							/>
							<path
								id="Path_28014"
								data-name="Path 28014"
								d="M2106.732,1920.683c-8.486-4.9-22.373-4.9-30.859,0s-8.486,12.917,0,17.816,22.373,4.9,30.859,0S2115.219,1925.583,2106.732,1920.683Z"
								transform="translate(-2068.794 -1916.597)"
								fill="#f7f8fb"
								opacity="0.039"
							/>
							<path
								id="Path_28015"
								data-name="Path 28015"
								d="M2107.293,1921.3c-8.348-4.819-22.007-4.819-30.354,0s-8.347,12.706,0,17.525,22.007,4.819,30.354,0S2115.64,1926.118,2107.293,1921.3Z"
								transform="translate(-2069.608 -1917.067)"
								fill="#f2f4fa"
								opacity="0.059"
							/>
							<path
								id="Path_28016"
								data-name="Path 28016"
								d="M2107.853,1921.914c-8.208-4.739-21.641-4.739-29.849,0s-8.208,12.494,0,17.233,21.641,4.74,29.849,0S2116.061,1926.653,2107.853,1921.914Z"
								transform="translate(-2070.42 -1917.536)"
								fill="#eef0f8"
								opacity="0.078"
							/>
							<ellipse id="Ellipse_1526" data-name="Ellipse 1526" cx="20.749" cy="11.98" rx="20.749" ry="11.98" transform="translate(1.759 1.015)" fill="#eaecf6" opacity="0.098" />
							<path
								id="Path_28017"
								data-name="Path 28017"
								d="M2108.974,1923.145c-7.931-4.579-20.908-4.579-28.839,0s-7.931,12.071,0,16.65,20.908,4.579,28.839,0S2116.9,1927.723,2108.974,1923.145Z"
								transform="translate(-2072.046 -1918.474)"
								fill="#e6e9f4"
								opacity="0.118"
							/>
							<path
								id="Path_28018"
								data-name="Path 28018"
								d="M2109.534,1923.76c-7.792-4.5-20.542-4.5-28.333,0s-7.792,11.86,0,16.358,20.542,4.5,28.333,0S2117.325,1928.258,2109.534,1923.76Z"
								transform="translate(-2072.859 -1918.944)"
								fill="#e1e5f2"
								opacity="0.137"
							/>
							<path
								id="Path_28019"
								data-name="Path 28019"
								d="M2110.094,1924.375c-7.653-4.418-20.175-4.418-27.828,0s-7.653,11.648,0,16.066,20.175,4.418,27.828,0S2117.747,1928.793,2110.094,1924.375Z"
								transform="translate(-2073.672 -1919.413)"
								fill="#dde1f0"
								opacity="0.157"
							/>
							<path
								id="Path_28020"
								data-name="Path 28020"
								d="M2110.655,1924.99c-7.514-4.338-19.809-4.338-27.323,0s-7.514,11.437,0,15.775,19.809,4.338,27.323,0S2118.168,1929.328,2110.655,1924.99Z"
								transform="translate(-2074.485 -1919.883)"
								fill="#d9deef"
								opacity="0.176"
							/>
							<path
								id="Path_28021"
								data-name="Path 28021"
								d="M2111.215,1925.606c-7.375-4.258-19.442-4.258-26.818,0s-7.375,11.225,0,15.483,19.443,4.258,26.818,0S2118.59,1929.864,2111.215,1925.606Z"
								transform="translate(-2075.298 -1920.352)"
								fill="#d5daed"
								opacity="0.196"
							/>
							<path
								id="Path_28022"
								data-name="Path 28022"
								d="M2111.775,1926.221c-7.236-4.178-19.076-4.178-26.312,0s-7.236,11.013,0,15.191,19.076,4.178,26.312,0S2119.011,1930.4,2111.775,1926.221Z"
								transform="translate(-2076.111 -1920.821)"
								fill="#d1d6eb"
								opacity="0.216"
							/>
							<path
								id="Path_28023"
								data-name="Path 28023"
								d="M2112.336,1926.836c-7.1-4.1-18.71-4.1-25.807,0s-7.1,10.8,0,14.9,18.71,4.1,25.807,0S2119.432,1930.934,2112.336,1926.836Z"
								transform="translate(-2076.924 -1921.291)"
								fill="#ccd3e9"
								opacity="0.235"
							/>
							<path
								id="Path_28024"
								data-name="Path 28024"
								d="M2112.9,1927.451c-6.958-4.017-18.343-4.017-25.3,0s-6.958,10.591,0,14.608,18.344,4.017,25.3,0S2119.854,1931.468,2112.9,1927.451Z"
								transform="translate(-2077.738 -1921.76)"
								fill="#c8cfe7"
								opacity="0.255"
							/>
							<path
								id="Path_28025"
								data-name="Path 28025"
								d="M2113.456,1928.067c-6.819-3.937-17.977-3.937-24.8,0s-6.819,10.379,0,14.316,17.978,3.937,24.8,0S2120.275,1932,2113.456,1928.067Z"
								transform="translate(-2078.55 -1922.23)"
								fill="#c4cbe5"
								opacity="0.275"
							/>
							<path
								id="Path_28026"
								data-name="Path 28026"
								d="M2114.017,1928.682c-6.68-3.857-17.611-3.857-24.291,0s-6.68,10.167,0,14.024,17.611,3.857,24.291,0S2120.7,1932.539,2114.017,1928.682Z"
								transform="translate(-2079.363 -1922.699)"
								fill="#c0c7e4"
								opacity="0.294"
							/>
							<path
								id="Path_28027"
								data-name="Path 28027"
								d="M2114.576,1929.3c-6.541-3.777-17.245-3.777-23.786,0s-6.541,9.956,0,13.732,17.245,3.777,23.786,0S2121.117,1933.073,2114.576,1929.3Z"
								transform="translate(-2080.176 -1923.168)"
								fill="#bcc4e2"
								opacity="0.314"
							/>
							<path
								id="Path_28028"
								data-name="Path 28028"
								d="M2115.137,1929.912c-6.4-3.7-16.878-3.7-23.281,0s-6.4,9.745,0,13.441,16.878,3.7,23.281,0S2121.539,1933.609,2115.137,1929.912Z"
								transform="translate(-2080.989 -1923.638)"
								fill="#b7c0e0"
								opacity="0.333"
							/>
							<path
								id="Path_28029"
								data-name="Path 28029"
								d="M2115.7,1930.528c-6.263-3.616-16.512-3.616-22.775,0s-6.263,9.533,0,13.149,16.512,3.616,22.775,0S2121.96,1934.144,2115.7,1930.528Z"
								transform="translate(-2081.802 -1924.107)"
								fill="#b3bcde"
								opacity="0.353"
							/>
							<ellipse id="Ellipse_1527" data-name="Ellipse 1527" cx="15.747" cy="9.092" rx="15.747" ry="9.092" transform="translate(6.761 3.904)" fill="#afb9dc" opacity="0.373" />
							<path
								id="Path_28030"
								data-name="Path 28030"
								d="M2116.818,1931.758c-5.985-3.455-15.78-3.455-21.765,0s-5.985,9.11,0,12.566,15.78,3.456,21.765,0S2122.8,1935.213,2116.818,1931.758Z"
								transform="translate(-2083.428 -1925.046)"
								fill="#abb5db"
								opacity="0.392"
							/>
							<path
								id="Path_28031"
								data-name="Path 28031"
								d="M2117.379,1932.373c-5.847-3.375-15.413-3.375-21.26,0s-5.846,8.9,0,12.274,15.413,3.375,21.26,0S2123.225,1935.748,2117.379,1932.373Z"
								transform="translate(-2084.241 -1925.515)"
								fill="#a6b1d9"
								opacity="0.412"
							/>
							<path
								id="Path_28032"
								data-name="Path 28032"
								d="M2117.939,1932.988c-5.708-3.295-15.047-3.295-20.754,0s-5.707,8.688,0,11.983,15.047,3.3,20.754,0S2123.647,1936.284,2117.939,1932.988Z"
								transform="translate(-2085.054 -1925.985)"
								fill="#a2add7"
								opacity="0.431"
							/>
							<ellipse id="Ellipse_1528" data-name="Ellipse 1528" cx="14.318" cy="8.266" rx="14.318" ry="8.266" transform="translate(8.19 4.729)" fill="#9eaad5" opacity="0.451" />
							<path
								id="Path_28033"
								data-name="Path 28033"
								d="M2119.059,1934.218c-5.429-3.134-14.314-3.134-19.743,0s-5.429,8.264,0,11.4,14.314,3.135,19.743,0S2124.489,1937.353,2119.059,1934.218Z"
								transform="translate(-2086.679 -1926.923)"
								fill="#9aa6d3"
								opacity="0.471"
							/>
							<ellipse id="Ellipse_1529" data-name="Ellipse 1529" cx="13.604" cy="7.854" rx="13.604" ry="7.854" transform="translate(8.904 5.141)" fill="#96a2d1" opacity="0.49" />
							<ellipse id="Ellipse_1530" data-name="Ellipse 1530" cx="13.246" cy="7.648" rx="13.246" ry="7.648" transform="translate(9.262 5.347)" fill="#919fd0" opacity="0.51" />
							<path
								id="Path_28034"
								data-name="Path 28034"
								d="M2120.74,1936.065c-5.013-2.894-13.215-2.894-18.228,0s-5.012,7.63,0,10.523,13.215,2.894,18.228,0S2125.753,1938.958,2120.74,1936.065Z"
								transform="translate(-2089.118 -1928.331)"
								fill="#8d9bce"
								opacity="0.529"
							/>
							<path
								id="Path_28035"
								data-name="Path 28035"
								d="M2121.3,1936.679c-4.874-2.814-12.849-2.814-17.723,0s-4.874,7.418,0,10.232,12.849,2.814,17.723,0S2126.174,1939.493,2121.3,1936.679Z"
								transform="translate(-2089.931 -1928.8)"
								fill="#8997cc"
								opacity="0.549"
							/>
							<path
								id="Path_28036"
								data-name="Path 28036"
								d="M2121.861,1937.295c-4.735-2.734-12.482-2.734-17.217,0s-4.735,7.207,0,9.94,12.483,2.733,17.217,0S2126.6,1940.028,2121.861,1937.295Z"
								transform="translate(-2090.744 -1929.27)"
								fill="#8594ca"
								opacity="0.569"
							/>
							<path
								id="Path_28037"
								data-name="Path 28037"
								d="M2122.421,1937.91c-4.6-2.654-12.116-2.654-16.712,0s-4.6,7,0,9.648,12.116,2.653,16.712,0S2127.017,1940.563,2122.421,1937.91Z"
								transform="translate(-2091.557 -1929.739)"
								fill="#8190c8"
								opacity="0.588"
							/>
							<path
								id="Path_28038"
								data-name="Path 28038"
								d="M2122.982,1938.525c-4.457-2.573-11.75-2.573-16.207,0s-4.457,6.784,0,9.357,11.75,2.573,16.207,0S2127.438,1941.1,2122.982,1938.525Z"
								transform="translate(-2092.371 -1930.208)"
								fill="#7c8cc6"
								opacity="0.608"
							/>
							<path
								id="Path_28039"
								data-name="Path 28039"
								d="M2123.542,1939.141c-4.318-2.493-11.384-2.493-15.7,0s-4.318,6.572,0,9.066,11.384,2.492,15.7,0S2127.86,1941.633,2123.542,1939.141Z"
								transform="translate(-2093.184 -1930.678)"
								fill="#7888c5"
								opacity="0.627"
							/>
							<path
								id="Path_28040"
								data-name="Path 28040"
								d="M2124.1,1939.755a16.856,16.856,0,0,0-15.2,0c-4.179,2.413-4.179,6.361,0,8.774a16.857,16.857,0,0,0,15.2,0C2128.281,1946.116,2128.281,1942.168,2124.1,1939.755Z"
								transform="translate(-2093.996 -1931.147)"
								fill="#7485c3"
								opacity="0.647"
							/>
							<ellipse id="Ellipse_1531" data-name="Ellipse 1531" cx="10.388" cy="5.998" rx="10.388" ry="5.998" transform="translate(12.12 6.998)" fill="#7081c1" opacity="0.667" />
							<path
								id="Path_28041"
								data-name="Path 28041"
								d="M2125.223,1940.986a15.732,15.732,0,0,0-14.186,0c-3.9,2.252-3.9,5.938,0,8.19a15.738,15.738,0,0,0,14.186,0C2129.124,1946.923,2129.124,1943.238,2125.223,1940.986Z"
								transform="translate(-2095.622 -1932.085)"
								fill="#6b7dbf"
								opacity="0.686"
							/>
							<path
								id="Path_28042"
								data-name="Path 28042"
								d="M2125.783,1941.6a15.174,15.174,0,0,0-13.68,0c-3.762,2.172-3.762,5.726,0,7.9a15.175,15.175,0,0,0,13.68,0C2129.545,1947.328,2129.545,1943.774,2125.783,1941.6Z"
								transform="translate(-2096.435 -1932.555)"
								fill="#677abd"
								opacity="0.706"
							/>
							<path
								id="Path_28043"
								data-name="Path 28043"
								d="M2126.344,1942.217a14.617,14.617,0,0,0-13.176,0c-3.623,2.092-3.623,5.515,0,7.607a14.616,14.616,0,0,0,13.176,0C2129.967,1947.732,2129.967,1944.308,2126.344,1942.217Z"
								transform="translate(-2097.248 -1933.025)"
								fill="#6376bc"
								opacity="0.725"
							/>
							<ellipse id="Ellipse_1532" data-name="Ellipse 1532" cx="8.959" cy="5.172" rx="8.959" ry="5.172" transform="translate(13.549 7.823)" fill="#5f72ba" opacity="0.745" />
							<path
								id="Path_28044"
								data-name="Path 28044"
								d="M2127.464,1943.447a13.493,13.493,0,0,0-12.165,0c-3.345,1.932-3.345,5.092,0,7.023a13.5,13.5,0,0,0,12.165,0C2130.81,1948.538,2130.81,1945.378,2127.464,1943.447Z"
								transform="translate(-2098.874 -1933.963)"
								fill="#5b6eb8"
								opacity="0.765"
							/>
							<path
								id="Path_28045"
								data-name="Path 28045"
								d="M2128.025,1944.062a12.932,12.932,0,0,0-11.659,0c-3.206,1.851-3.206,4.88,0,6.732a12.934,12.934,0,0,0,11.659,0C2131.231,1948.942,2131.231,1945.913,2128.025,1944.062Z"
								transform="translate(-2099.687 -1934.432)"
								fill="#566bb6"
								opacity="0.784"
							/>
							<path
								id="Path_28046"
								data-name="Path 28046"
								d="M2128.585,1944.677a12.375,12.375,0,0,0-11.155,0c-3.067,1.771-3.067,4.669,0,6.44a12.373,12.373,0,0,0,11.155,0C2131.653,1949.346,2131.653,1946.448,2128.585,1944.677Z"
								transform="translate(-2100.5 -1934.902)"
								fill="#5267b4"
								opacity="0.804"
							/>
							<path
								id="Path_28047"
								data-name="Path 28047"
								d="M2129.145,1945.292a11.814,11.814,0,0,0-10.649,0c-2.928,1.691-2.928,4.458,0,6.148a11.811,11.811,0,0,0,10.649,0C2132.073,1949.75,2132.073,1946.983,2129.145,1945.292Z"
								transform="translate(-2101.313 -1935.371)"
								fill="#4e63b2"
								opacity="0.824"
							/>
							<path
								id="Path_28048"
								data-name="Path 28048"
								d="M2129.705,1945.907a11.255,11.255,0,0,0-10.144,0c-2.789,1.611-2.789,4.246,0,5.857a11.252,11.252,0,0,0,10.144,0C2132.494,1950.154,2132.494,1947.518,2129.705,1945.907Z"
								transform="translate(-2102.125 -1935.841)"
								fill="#4a60b1"
								opacity="0.843"
							/>
							<path
								id="Path_28049"
								data-name="Path 28049"
								d="M2130.265,1946.523a10.692,10.692,0,0,0-9.638,0c-2.65,1.531-2.65,4.035,0,5.565a10.691,10.691,0,0,0,9.638,0C2132.916,1950.557,2132.916,1948.053,2130.265,1946.523Z"
								transform="translate(-2102.938 -1936.31)"
								fill="#465caf"
								opacity="0.863"
							/>
							<path
								id="Path_28050"
								data-name="Path 28050"
								d="M2130.826,1947.138a10.131,10.131,0,0,0-9.133,0c-2.512,1.45-2.512,3.823,0,5.273a10.131,10.131,0,0,0,9.133,0C2133.337,1950.961,2133.337,1948.588,2130.826,1947.138Z"
								transform="translate(-2103.751 -1936.78)"
								fill="#4158ad"
								opacity="0.882"
							/>
							<path
								id="Path_28051"
								data-name="Path 28051"
								d="M2131.387,1947.753a9.571,9.571,0,0,0-8.628,0c-2.373,1.37-2.373,3.611,0,4.981a9.568,9.568,0,0,0,8.628,0C2133.76,1951.365,2133.76,1949.123,2131.387,1947.753Z"
								transform="translate(-2104.565 -1937.249)"
								fill="#3d55ab"
								opacity="0.902"
							/>
							<ellipse id="Ellipse_1533" data-name="Ellipse 1533" cx="5.744" cy="3.316" rx="5.744" ry="3.316" transform="translate(16.764 9.679)" fill="#3951a9" opacity="0.922" />
							<path
								id="Path_28052"
								data-name="Path 28052"
								d="M2132.507,1948.984a8.451,8.451,0,0,0-7.617,0c-2.095,1.209-2.095,3.189,0,4.4a8.449,8.449,0,0,0,7.617,0C2134.6,1952.173,2134.6,1950.193,2132.507,1948.984Z"
								transform="translate(-2106.19 -1938.188)"
								fill="#354da7"
								opacity="0.941"
							/>
							<path
								id="Path_28053"
								data-name="Path 28053"
								d="M2133.068,1949.6a7.891,7.891,0,0,0-7.112,0c-1.956,1.129-1.956,2.977,0,4.106a7.888,7.888,0,0,0,7.112,0C2135.023,1952.576,2135.023,1950.728,2133.068,1949.6Z"
								transform="translate(-2107.004 -1938.657)"
								fill="#3049a6"
								opacity="0.961"
							/>
							<path
								id="Path_28054"
								data-name="Path 28054"
								d="M2133.627,1950.214a7.33,7.33,0,0,0-6.607,0c-1.817,1.049-1.817,2.766,0,3.814a7.328,7.328,0,0,0,6.607,0C2135.444,1952.98,2135.444,1951.263,2133.627,1950.214Z"
								transform="translate(-2107.816 -1939.126)"
								fill="#2c46a4"
								opacity="0.98"
							/>
							<path
								id="Path_28055"
								data-name="Path 28055"
								d="M2134.188,1950.829a6.771,6.771,0,0,0-6.1,0c-1.678.969-1.678,2.554,0,3.523a6.768,6.768,0,0,0,6.1,0C2135.866,1953.383,2135.866,1951.8,2134.188,1950.829Z"
								transform="translate(-2108.629 -1939.596)"
								fill="#2842a2"
							/>
						</g>
						<g id="Group_15724" data-name="Group 15724" transform="translate(9.95 0.18)">
							<path
								id="Path_28056"
								data-name="Path 28056"
								d="M2128.067,1934.06h-1.457a10.037,10.037,0,0,0-2.66-2.158c-5.49-3.169-14.471-3.169-19.96,0a10.042,10.042,0,0,0-2.66,2.158h-1.421v3.052h.009c-.263,2.269,1.085,4.59,4.072,6.314,5.489,3.17,14.471,3.17,19.96,0,2.987-1.724,4.334-4.045,4.072-6.314h.045Z"
								transform="translate(-2099.855 -1925.474)"
								fill="#ffc107"
							/>
							<g id="Group_15720" data-name="Group 15720" transform="translate(0.03 4.054)">
								<path id="Path_28057" data-name="Path 28057" d="M2119.531,1933.185q-.718.242-1.392.536v12.974q.673.295,1.392.535Z" transform="translate(-2112.571 -1932.072)" fill="#ffad33" />
								<path
									id="Path_28058"
									data-name="Path 28058"
									d="M2109.012,1938.125v9.733a11.519,11.519,0,0,0,1.32.9c.023.013.048.025.072.038v-11.6c-.023.013-.049.024-.072.037A11.289,11.289,0,0,0,2109.012,1938.125Z"
									transform="translate(-2106.228 -1934.858)"
									fill="#ffad33"
								/>
								<path id="Path_28059" data-name="Path 28059" d="M2128.657,1930.829q-.707.131-1.392.307V1946q.685.175,1.392.307Z" transform="translate(-2118.913 -1930.435)" fill="#ffad33" />
								<path id="Path_28060" data-name="Path 28060" d="M2182.024,1939.439v10.237a9.382,9.382,0,0,0,1.392-1.221v-7.8A9.537,9.537,0,0,0,2182.024,1939.439Z" transform="translate(-2156.968 -1936.418)" fill="#ffad33" />
								<path id="Path_28061" data-name="Path 28061" d="M2191.15,1949.717a4.915,4.915,0,0,0,.3-2.274h.045v-3.052h-.341Z" transform="translate(-2163.31 -1939.86)" fill="#ffad33" />
								<path id="Path_28062" data-name="Path 28062" d="M2165.162,1931.936c-.455-.144-.918-.275-1.392-.388v15.044c.475-.113.938-.244,1.392-.388Z" transform="translate(-2144.282 -1930.935)" fill="#ffad33" />
								<path id="Path_28063" data-name="Path 28063" d="M2101.278,1951.543v-7.152h-1.369v3.052h.009A5.386,5.386,0,0,0,2101.278,1951.543Z" transform="translate(-2099.886 -1939.86)" fill="#ffad33" />
								<path id="Path_28064" data-name="Path 28064" d="M2174.289,1935.14a15.21,15.21,0,0,0-1.392-.655v13.252a15.21,15.21,0,0,0,1.392-.655Z" transform="translate(-2150.625 -1932.976)" fill="#ffad33" />
								<path id="Path_28065" data-name="Path 28065" d="M2137.783,1929.7q-.7.045-1.392.13v15.911q.692.085,1.392.13Z" transform="translate(-2125.255 -1929.651)" fill="#ffad33" />
								<path id="Path_28066" data-name="Path 28066" d="M2146.909,1945.778v-16.21q-.695-.035-1.392-.03v16.269Q2146.214,1945.812,2146.909,1945.778Z" transform="translate(-2131.597 -1929.537)" fill="#ffad33" />
								<path id="Path_28067" data-name="Path 28067" d="M2156.036,1930.181c-.459-.078-.924-.14-1.392-.191v15.994c.468-.05.933-.113,1.392-.19Z" transform="translate(-2137.94 -1929.852)" fill="#ffad33" />
							</g>
							<ellipse id="Ellipse_1534" data-name="Ellipse 1534" cx="14.114" cy="8.149" rx="14.114" ry="8.149" fill="#ffcd39" />
							<path
								id="Path_28068"
								data-name="Path 28068"
								d="M2126.127,1920.233c-4.942-2.854-13.029-2.854-17.971,0s-4.942,7.522,0,10.375,13.029,2.853,17.971,0S2131.069,1923.086,2126.127,1920.233Z"
								transform="translate(-2103.027 -1917.53)"
								fill="#ffad33"
							/>
							<path
								id="Path_28069"
								data-name="Path 28069"
								d="M2128.572,1922.883c-4.336-2.459-11.431-2.459-15.767,0s-4.335,6.481,0,8.939,11.431,2.458,15.767,0S2132.907,1925.341,2128.572,1922.883Z"
								transform="translate(-2106.574 -1919.577)"
								fill="#ffcd39"
							/>
							<g id="Group_15723" data-name="Group 15723" transform="translate(9.609 3.789)">
								<g id="Group_15721" data-name="Group 15721" transform="translate(0 0.658)">
									<path
										id="Path_28070"
										data-name="Path 28070"
										d="M2136.843,1937.292h-3.921c-.9,0-1.636-.427-1.636-.951v-.487h2.328v.084h3.229c.621,0,1.125-.293,1.125-.654,0-.235-.329-.426-.732-.426h-2.89c-1.687,0-3.061-.8-3.061-1.78v-.244c0-1.108,1.55-2.009,3.454-2.009h3.921c.9,0,1.636.427,1.636.951v.553h-2.328v-.15h-3.229c-.621,0-1.126.294-1.126.655v.244c0,.235.329.426.732.426h2.89c1.688,0,3.061.8,3.061,1.78C2140.3,1936.391,2138.747,1937.292,2136.843,1937.292Z"
										transform="translate(-2131.286 -1930.825)"
										fill="#ff9800"
									/>
								</g>
								<g id="Group_15722" data-name="Group 15722" transform="translate(3.341)">
									<rect id="Rectangle_4994" data-name="Rectangle 4994" width="2.328" height="7.973" fill="#ff9800" />
								</g>
							</g>
						</g>
					</g>
					<g id="Group_15731" data-name="Group 15731" transform="translate(9.95 5.909)">
						<g id="Group_15730" data-name="Group 15730">
							<path
								id="Path_28071"
								data-name="Path 28071"
								d="M2128.067,1914.69h-1.457a10.032,10.032,0,0,0-2.66-2.158c-5.49-3.17-14.471-3.17-19.96,0a10.037,10.037,0,0,0-2.66,2.158h-1.421v3.052h.009c-.263,2.269,1.085,4.59,4.072,6.314,5.489,3.169,14.471,3.169,19.96,0,2.987-1.724,4.334-4.045,4.072-6.314h.045Z"
								transform="translate(-2099.855 -1906.105)"
								fill="#ffc107"
							/>
							<g id="Group_15726" data-name="Group 15726" transform="translate(0.03 4.054)">
								<path id="Path_28072" data-name="Path 28072" d="M2119.531,1913.817q-.718.242-1.392.535v12.974q.673.295,1.392.535Z" transform="translate(-2112.571 -1912.704)" fill="#ffad33" />
								<path
									id="Path_28073"
									data-name="Path 28073"
									d="M2109.012,1918.756v9.733a11.582,11.582,0,0,0,1.32.9c.023.013.048.025.072.038v-11.6c-.023.013-.049.024-.072.038A11.335,11.335,0,0,0,2109.012,1918.756Z"
									transform="translate(-2106.228 -1915.489)"
									fill="#ffad33"
								/>
								<path id="Path_28074" data-name="Path 28074" d="M2128.657,1911.46c-.471.087-.935.191-1.392.307v14.869c.457.116.92.219,1.392.307Z" transform="translate(-2118.913 -1911.066)" fill="#ffad33" />
								<path id="Path_28075" data-name="Path 28075" d="M2182.024,1920.07v10.237a9.4,9.4,0,0,0,1.392-1.221v-7.8A9.542,9.542,0,0,0,2182.024,1920.07Z" transform="translate(-2156.968 -1917.05)" fill="#ffad33" />
								<path id="Path_28076" data-name="Path 28076" d="M2191.15,1930.348a4.915,4.915,0,0,0,.3-2.274h.045v-3.052h-.341Z" transform="translate(-2163.31 -1920.491)" fill="#ffad33" />
								<path id="Path_28077" data-name="Path 28077" d="M2165.162,1912.567c-.455-.144-.918-.275-1.392-.388v15.044c.475-.113.938-.244,1.392-.388Z" transform="translate(-2144.282 -1911.566)" fill="#ffad33" />
								<path id="Path_28078" data-name="Path 28078" d="M2101.278,1932.174v-7.152h-1.369v3.052h.009A5.385,5.385,0,0,0,2101.278,1932.174Z" transform="translate(-2099.886 -1920.491)" fill="#ffad33" />
								<path id="Path_28079" data-name="Path 28079" d="M2174.289,1915.771a15.209,15.209,0,0,0-1.392-.655v13.252a15.209,15.209,0,0,0,1.392-.655Z" transform="translate(-2150.625 -1913.607)" fill="#ffad33" />
								<path id="Path_28080" data-name="Path 28080" d="M2137.783,1910.332q-.7.044-1.392.13v15.911q.692.085,1.392.13Z" transform="translate(-2125.255 -1910.282)" fill="#ffad33" />
								<path id="Path_28081" data-name="Path 28081" d="M2146.909,1926.409V1910.2q-.695-.034-1.392-.029v16.269Q2146.214,1926.443,2146.909,1926.409Z" transform="translate(-2131.597 -1910.168)" fill="#ffad33" />
								<path id="Path_28082" data-name="Path 28082" d="M2156.036,1910.812c-.459-.078-.924-.14-1.392-.191v15.994c.468-.051.933-.113,1.392-.191Z" transform="translate(-2137.94 -1910.483)" fill="#ffad33" />
							</g>
							<ellipse id="Ellipse_1535" data-name="Ellipse 1535" cx="14.114" cy="8.149" rx="14.114" ry="8.149" fill="#ffcd39" />
							<path
								id="Path_28083"
								data-name="Path 28083"
								d="M2126.127,1900.863c-4.942-2.853-13.029-2.853-17.971,0s-4.942,7.522,0,10.376,13.029,2.853,17.971,0S2131.069,1903.716,2126.127,1900.863Z"
								transform="translate(-2103.027 -1898.16)"
								fill="#ffad33"
							/>
							<path
								id="Path_28084"
								data-name="Path 28084"
								d="M2128.572,1903.514c-4.336-2.459-11.431-2.459-15.767,0s-4.335,6.481,0,8.939,11.431,2.458,15.767,0S2132.907,1905.972,2128.572,1903.514Z"
								transform="translate(-2106.574 -1900.208)"
								fill="#ffcd39"
							/>
							<g id="Group_15729" data-name="Group 15729" transform="translate(9.609 3.789)">
								<g id="Group_15727" data-name="Group 15727" transform="translate(0 0.658)">
									<path
										id="Path_28085"
										data-name="Path 28085"
										d="M2136.843,1917.923h-3.921c-.9,0-1.636-.427-1.636-.951v-.487h2.328v.085h3.229c.621,0,1.125-.293,1.125-.654,0-.236-.329-.427-.732-.427h-2.89c-1.687,0-3.061-.8-3.061-1.78v-.244c0-1.108,1.55-2.009,3.454-2.009h3.921c.9,0,1.636.427,1.636.951v.553h-2.328v-.151h-3.229c-.621,0-1.126.294-1.126.655v.244c0,.235.329.427.732.427h2.89c1.688,0,3.061.8,3.061,1.78C2140.3,1917.022,2138.747,1917.923,2136.843,1917.923Z"
										transform="translate(-2131.286 -1911.456)"
										fill="#ff9800"
									/>
								</g>
								<g id="Group_15728" data-name="Group 15728" transform="translate(3.341)">
									<rect id="Rectangle_4995" data-name="Rectangle 4995" width="2.328" height="7.973" fill="#ff9800" />
								</g>
							</g>
						</g>
					</g>
					<g id="Group_15737" data-name="Group 15737" transform="translate(9.95)">
						<g id="Group_15736" data-name="Group 15736">
							<path
								id="Path_28086"
								data-name="Path 28086"
								d="M2128.067,1895.321h-1.457a10.034,10.034,0,0,0-2.66-2.158c-5.49-3.169-14.471-3.169-19.96,0a10.04,10.04,0,0,0-2.66,2.158h-1.421v3.053h.009c-.263,2.268,1.085,4.589,4.072,6.314,5.489,3.169,14.471,3.169,19.96,0,2.987-1.725,4.334-4.046,4.072-6.314h.045Z"
								transform="translate(-2099.855 -1886.736)"
								fill="#ffc107"
							/>
							<g id="Group_15732" data-name="Group 15732" transform="translate(0.03 4.054)">
								<path id="Path_28087" data-name="Path 28087" d="M2119.531,1894.448q-.718.242-1.392.535v12.974q.673.295,1.392.536Z" transform="translate(-2112.571 -1893.335)" fill="#ffad33" />
								<path
									id="Path_28088"
									data-name="Path 28088"
									d="M2109.012,1899.386v9.733a11.615,11.615,0,0,0,1.32.9c.023.013.048.024.072.037v-11.6c-.023.013-.049.024-.072.038A11.35,11.35,0,0,0,2109.012,1899.386Z"
									transform="translate(-2106.228 -1896.119)"
									fill="#ffad33"
								/>
								<path id="Path_28089" data-name="Path 28089" d="M2128.657,1892.091q-.707.131-1.392.307v14.868q.685.174,1.392.307Z" transform="translate(-2118.913 -1891.697)" fill="#ffad33" />
								<path id="Path_28090" data-name="Path 28090" d="M2182.024,1900.7v10.237a9.368,9.368,0,0,0,1.392-1.221v-7.8A9.506,9.506,0,0,0,2182.024,1900.7Z" transform="translate(-2156.968 -1897.68)" fill="#ffad33" />
								<path id="Path_28091" data-name="Path 28091" d="M2191.15,1910.978a4.913,4.913,0,0,0,.3-2.273h.045v-3.053h-.341Z" transform="translate(-2163.31 -1901.121)" fill="#ffad33" />
								<path id="Path_28092" data-name="Path 28092" d="M2165.162,1893.2c-.455-.144-.918-.275-1.392-.388v15.044c.475-.113.938-.244,1.392-.388Z" transform="translate(-2144.282 -1892.196)" fill="#ffad33" />
								<path id="Path_28093" data-name="Path 28093" d="M2101.278,1912.8v-7.152h-1.369v3.053h.009A5.385,5.385,0,0,0,2101.278,1912.8Z" transform="translate(-2099.886 -1901.121)" fill="#ffad33" />
								<path id="Path_28094" data-name="Path 28094" d="M2174.289,1896.4a15.175,15.175,0,0,0-1.392-.655V1909a15.208,15.208,0,0,0,1.392-.655Z" transform="translate(-2150.625 -1894.237)" fill="#ffad33" />
								<path id="Path_28095" data-name="Path 28095" d="M2137.783,1890.963q-.7.044-1.392.13V1907q.692.085,1.392.13Z" transform="translate(-2125.255 -1890.913)" fill="#ffad33" />
								<path id="Path_28096" data-name="Path 28096" d="M2146.909,1907.039v-16.211q-.695-.034-1.392-.03v16.269Q2146.214,1907.073,2146.909,1907.039Z" transform="translate(-2131.597 -1890.798)" fill="#ffad33" />
								<path id="Path_28097" data-name="Path 28097" d="M2156.036,1891.443c-.459-.078-.924-.14-1.392-.191v15.994c.468-.051.933-.113,1.392-.191Z" transform="translate(-2137.94 -1891.114)" fill="#ffad33" />
							</g>
							<ellipse id="Ellipse_1536" data-name="Ellipse 1536" cx="14.114" cy="8.149" rx="14.114" ry="8.149" fill="#ffcd39" />
							<path
								id="Path_28098"
								data-name="Path 28098"
								d="M2126.127,1881.494c-4.942-2.853-13.029-2.853-17.971,0s-4.942,7.522,0,10.375,13.029,2.854,17.971,0S2131.069,1884.347,2126.127,1881.494Z"
								transform="translate(-2103.027 -1878.791)"
								fill="#ffad33"
							/>
							<path
								id="Path_28099"
								data-name="Path 28099"
								d="M2128.572,1884.145c-4.336-2.458-11.431-2.458-15.767,0s-4.335,6.481,0,8.939,11.431,2.458,15.767,0S2132.907,1886.6,2128.572,1884.145Z"
								transform="translate(-2106.574 -1880.839)"
								fill="#ffcd39"
							/>
							<g id="Group_15735" data-name="Group 15735" transform="translate(9.609 3.789)">
								<g id="Group_15733" data-name="Group 15733" transform="translate(0 0.658)">
									<path
										id="Path_28100"
										data-name="Path 28100"
										d="M2136.843,1898.554h-3.921c-.9,0-1.636-.427-1.636-.951v-.488h2.328v.085h3.229c.621,0,1.125-.294,1.125-.655,0-.235-.329-.426-.732-.426h-2.89c-1.687,0-3.061-.8-3.061-1.78v-.244c0-1.108,1.55-2.009,3.454-2.009h3.921c.9,0,1.636.427,1.636.951v.553h-2.328v-.151h-3.229c-.621,0-1.126.294-1.126.655v.244c0,.235.329.427.732.427h2.89c1.688,0,3.061.8,3.061,1.78C2140.3,1897.653,2138.747,1898.554,2136.843,1898.554Z"
										transform="translate(-2131.286 -1892.086)"
										fill="#ff9800"
									/>
								</g>
								<g id="Group_15734" data-name="Group 15734" transform="translate(3.341)">
									<rect id="Rectangle_4996" data-name="Rectangle 4996" width="2.328" height="7.973" fill="#ff9800" />
								</g>
							</g>
						</g>
					</g>
				</g>
				<g id="Group_15756" class="Group_15756" data-name="Group 15756" transform="translate(42.863 350.613)">
					<g id="Group_15708" data-name="Group 15708" transform="translate(-22.336 59.005)">
						<path id="Path_27967" data-name="Path 27967" d="M537.708,1813.64l89.539-51.695-89.539-51.694-89.538,51.694Z" transform="translate(-448.17 -1683.948)" fill="#2647c8" opacity="0.3" />
						<g id="Group_15707" data-name="Group 15707" transform="translate(3.053)">
							<path id="Path_27968" data-name="Path 27968" d="M458.178,1787.709V1799.1l86.485,49.932v-11.393Z" transform="translate(-458.177 -1737.778)" fill="#d3ddf7" />
							<path id="Path_27969" data-name="Path 27969" d="M828.178,1787.709V1799.1l-86.485,49.932v-11.393Z" transform="translate(-655.208 -1737.778)" fill="#e2e9fa" />
							<path id="Path_27970" data-name="Path 27970" d="M544.664,1723.888l86.485-49.932-86.485-49.931-86.485,49.931Z" transform="translate(-458.179 -1624.025)" fill="#f0f4fc" />
						</g>
					</g>
					<path
						id="Path_28101"
						data-name="Path 28101"
						d="M570.352,1665.537l-48.091,27.491a1.561,1.561,0,0,0-.006,2.706l74.877,43.231a6.205,6.205,0,0,0,6.182.013l48.091-27.491a1.561,1.561,0,0,0,.006-2.706l-74.877-43.23A6.2,6.2,0,0,0,570.352,1665.537Z"
						transform="translate(-521.45 -1593.301)"
						fill="#2647c8"
						opacity="0.3"
					/>
					<path
						id="Path_28102"
						data-name="Path 28102"
						d="M787.917,1474.867,711.6,1430.806a1.547,1.547,0,0,0-2.32,1.339l-14.2,57.515a3.361,3.361,0,0,0,1.68,2.911l76.317,44.062c1.031.6,1.833.1,2.32-1.339l14.2-57.515A3.362,3.362,0,0,0,787.917,1474.867Z"
						transform="translate(-642.101 -1430.596)"
						fill="#6e8fe4"
					/>
					<path
						id="Path_28103"
						data-name="Path 28103"
						d="M784.683,1477.022l-76.317-44.061a1.546,1.546,0,0,0-2.32,1.339l-14.2,57.515a3.363,3.363,0,0,0,1.681,2.911l76.317,44.061c1.031.6,1.984-.56,2.32-1.339l14.2-57.514A3.363,3.363,0,0,0,784.683,1477.022Z"
						transform="translate(-639.853 -1432.094)"
						fill="#02126a"
					/>
					<path
						id="Path_28104"
						data-name="Path 28104"
						d="M788.493,1486.032l-74.553-43.167a.7.7,0,0,0-1.03.437L699.3,1498.038a1,1,0,0,0,.468,1.1l74.567,43.2a.7.7,0,0,0,1.03-.437l13.6-54.769A1,1,0,0,0,788.493,1486.032Z"
						transform="translate(-645.008 -1439.056)"
						fill="#02126a"
					/>
					<path
						id="Path_28105"
						data-name="Path 28105"
						d="M570.3,1643.137l-48.871,25.779s-.269,3.816.774,4.418l74.877,43.23a6.2,6.2,0,0,0,6.182.013l48.091-27.491c1.989-1.234.786-4.427.786-4.427l-75.658-41.51A6.2,6.2,0,0,0,570.3,1643.137Z"
						transform="translate(-521.395 -1577.734)"
						fill="url(#linear-gradient-23)"
					/>
					<path
						id="Path_28106"
						data-name="Path 28106"
						d="M570.352,1633.437l-48.091,27.491a1.561,1.561,0,0,0-.006,2.706l74.877,43.231a6.205,6.205,0,0,0,6.182.013l48.091-27.491a1.561,1.561,0,0,0,.006-2.706l-74.877-43.231A6.2,6.2,0,0,0,570.352,1633.437Z"
						transform="translate(-521.45 -1570.993)"
						fill="#fff"
					/>
					<path
						id="Path_28107"
						data-name="Path 28107"
						d="M638.378,1751.5l-12.676,7.246a.411.411,0,0,0,0,.713l19.736,11.395a1.636,1.636,0,0,0,1.63,0l12.676-7.246a.412.412,0,0,0,0-.714l-19.736-11.394A1.635,1.635,0,0,0,638.378,1751.5Z"
						transform="translate(-593.74 -1653.463)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28108"
						data-name="Path 28108"
						d="M692.9,1648.905l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.533.533,0,0,1,692.9,1648.905Z"
						transform="translate(-638.698 -1582.261)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28109"
						data-name="Path 28109"
						d="M712.806,1660.762l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.535.535,0,0,1,712.806,1660.762Z"
						transform="translate(-652.529 -1590.501)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28110"
						data-name="Path 28110"
						d="M732.781,1671.987l4.143,2.393a.247.247,0,0,1,0,.428l-2.058,1.183a.534.534,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.535.535,0,0,1,732.781,1671.987Z"
						transform="translate(-666.411 -1598.302)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28111"
						data-name="Path 28111"
						d="M753.359,1683.581l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.533,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.533.533,0,0,1,753.359,1683.581Z"
						transform="translate(-680.712 -1606.359)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28112"
						data-name="Path 28112"
						d="M773.128,1694.6l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.533.533,0,0,1-.533,0l-4.143-2.393a.247.247,0,0,1,0-.428l2.058-1.183A.536.536,0,0,1,773.128,1694.6Z"
						transform="translate(-694.451 -1614.016)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28113"
						data-name="Path 28113"
						d="M792.348,1706.455l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.534.534,0,0,1,792.348,1706.455Z"
						transform="translate(-707.808 -1622.255)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28114"
						data-name="Path 28114"
						d="M812.47,1717.549l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.533.533,0,0,1,812.47,1717.549Z"
						transform="translate(-721.791 -1629.966)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28115"
						data-name="Path 28115"
						d="M832.292,1729.353l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.533.533,0,0,1-.533,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.534.534,0,0,1,832.292,1729.353Z"
						transform="translate(-735.567 -1638.169)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28116"
						data-name="Path 28116"
						d="M851.786,1740.856l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.534,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.534.534,0,0,1,851.786,1740.856Z"
						transform="translate(-749.114 -1646.162)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28117"
						data-name="Path 28117"
						d="M872.336,1752.695l4.143,2.392a.247.247,0,0,1,0,.428l-2.058,1.183a.535.535,0,0,1-.533,0l-4.143-2.392a.247.247,0,0,1,0-.428l2.058-1.183A.535.535,0,0,1,872.336,1752.695Z"
						transform="translate(-763.395 -1654.39)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28118"
						data-name="Path 28118"
						d="M892.293,1763.893l4.143,2.393a.247.247,0,0,1,0,.428l-2.058,1.183a.534.534,0,0,1-.534,0L889.7,1765.5a.247.247,0,0,1,0-.428l2.058-1.183A.533.533,0,0,1,892.293,1763.893Z"
						transform="translate(-777.265 -1662.172)"
						fill="#d3ddf7"
					/>
					<g id="Group_15739" data-name="Group 15739" transform="translate(45.488 69.347)">
						<path
							id="Path_28119"
							data-name="Path 28119"
							d="M670.8,1659.734l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,670.8,1659.734Z"
							transform="translate(-670.514 -1657.929)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28120"
							data-name="Path 28120"
							d="M691.407,1671.591l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,691.407,1671.591Z"
							transform="translate(-684.833 -1666.169)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28121"
							data-name="Path 28121"
							d="M711.412,1682.816l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,711.412,1682.816Z"
							transform="translate(-698.735 -1673.97)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28122"
							data-name="Path 28122"
							d="M732.693,1694.409l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.016l-2.812-1.619A.584.584,0,0,1,732.693,1694.409Z"
							transform="translate(-713.525 -1682.027)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28123"
							data-name="Path 28123"
							d="M751.443,1705.426l2.807-1.644a1.173,1.173,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,751.443,1705.426Z"
							transform="translate(-726.555 -1689.683)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28124"
							data-name="Path 28124"
							d="M770.493,1717.221l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.726,1.674a1.175,1.175,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,770.493,1717.221Z"
							transform="translate(-739.794 -1697.88)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28125"
							data-name="Path 28125"
							d="M790.849,1728.377l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,790.849,1728.377Z"
							transform="translate(-753.941 -1705.633)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28126"
							data-name="Path 28126"
							d="M810.771,1739.671l2.808-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,810.771,1739.671Z"
							transform="translate(-767.786 -1713.482)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28127"
							data-name="Path 28127"
							d="M830.358,1751.684l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,830.358,1751.684Z"
							transform="translate(-781.397 -1721.83)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28128"
							data-name="Path 28128"
							d="M851.7,1764.252l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,851.7,1764.252Z"
							transform="translate(-796.228 -1730.565)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28129"
							data-name="Path 28129"
							d="M871,1774.721l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,871,1774.721Z"
							transform="translate(-809.639 -1737.84)"
							fill="#d3ddf7"
						/>
					</g>
					<g id="Group_15740" data-name="Group 15740" transform="translate(39.234 72.748)">
						<path
							id="Path_28130"
							data-name="Path 28130"
							d="M650.3,1670.884l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.619A.584.584,0,0,1,650.3,1670.884Z"
							transform="translate(-650.01 -1669.079)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28131"
							data-name="Path 28131"
							d="M670.9,1682.74l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,670.9,1682.74Z"
							transform="translate(-664.33 -1677.319)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28132"
							data-name="Path 28132"
							d="M690.908,1693.966l2.808-1.644a1.173,1.173,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,690.908,1693.966Z"
							transform="translate(-678.231 -1685.12)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28133"
							data-name="Path 28133"
							d="M712.19,1705.559l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,712.19,1705.559Z"
							transform="translate(-693.021 -1693.177)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28134"
							data-name="Path 28134"
							d="M730.939,1716.576l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.741,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,730.939,1716.576Z"
							transform="translate(-706.051 -1700.833)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28135"
							data-name="Path 28135"
							d="M749.989,1728.371l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.673a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,749.989,1728.371Z"
							transform="translate(-719.29 -1709.03)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28136"
							data-name="Path 28136"
							d="M770.345,1739.527l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.173,1.173,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,770.345,1739.527Z"
							transform="translate(-733.437 -1716.783)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28137"
							data-name="Path 28137"
							d="M790.267,1750.821l2.807-1.644a1.173,1.173,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.583.583,0,0,1,790.267,1750.821Z"
							transform="translate(-747.281 -1724.632)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28138"
							data-name="Path 28138"
							d="M809.855,1762.833l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.726,1.674a1.176,1.176,0,0,1-1.2.016l-2.813-1.62A.584.584,0,0,1,809.855,1762.833Z"
							transform="translate(-760.894 -1732.98)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28139"
							data-name="Path 28139"
							d="M831.195,1775.4l2.807-1.644a1.176,1.176,0,0,1,1.181,0l2.741,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,831.195,1775.4Z"
							transform="translate(-775.724 -1741.714)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28140"
							data-name="Path 28140"
							d="M850.492,1785.871l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.726,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,850.492,1785.871Z"
							transform="translate(-789.135 -1748.99)"
							fill="#d3ddf7"
						/>
					</g>
					<g id="Group_15741" data-name="Group 15741" transform="translate(32.979 76.149)">
						<path
							id="Path_28141"
							data-name="Path 28141"
							d="M629.8,1682.033l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.016l-2.812-1.62A.584.584,0,0,1,629.8,1682.033Z"
							transform="translate(-629.507 -1680.229)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28142"
							data-name="Path 28142"
							d="M650.4,1693.89l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.583.583,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,650.4,1693.89Z"
							transform="translate(-643.826 -1688.469)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28143"
							data-name="Path 28143"
							d="M670.4,1705.116l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.619A.584.584,0,0,1,670.4,1705.116Z"
							transform="translate(-657.728 -1696.27)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28144"
							data-name="Path 28144"
							d="M691.686,1716.708l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.173,1.173,0,0,1-1.2.016l-2.813-1.619A.584.584,0,0,1,691.686,1716.708Z"
							transform="translate(-672.518 -1704.326)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28145"
							data-name="Path 28145"
							d="M710.436,1727.726l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,710.436,1727.726Z"
							transform="translate(-685.548 -1711.983)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28146"
							data-name="Path 28146"
							d="M729.486,1739.52l2.807-1.644a1.175,1.175,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,729.486,1739.52Z"
							transform="translate(-698.787 -1720.18)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28147"
							data-name="Path 28147"
							d="M749.842,1750.677l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.726,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,749.842,1750.677Z"
							transform="translate(-712.933 -1727.933)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28148"
							data-name="Path 28148"
							d="M769.763,1761.971l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.673a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,769.763,1761.971Z"
							transform="translate(-726.778 -1735.782)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28149"
							data-name="Path 28149"
							d="M789.351,1773.983l2.807-1.644a1.173,1.173,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.726,1.674a1.174,1.174,0,0,1-1.2.016l-2.813-1.619A.584.584,0,0,1,789.351,1773.983Z"
							transform="translate(-740.39 -1744.129)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28150"
							data-name="Path 28150"
							d="M810.691,1786.552l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.726,1.674a1.175,1.175,0,0,1-1.2.016l-2.812-1.62A.584.584,0,0,1,810.691,1786.552Z"
							transform="translate(-755.22 -1752.864)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28151"
							data-name="Path 28151"
							d="M829.988,1797.021l2.807-1.644a1.174,1.174,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1L834,1799.634a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,829.988,1797.021Z"
							transform="translate(-768.631 -1760.14)"
							fill="#d3ddf7"
						/>
					</g>
					<g id="Group_15742" data-name="Group 15742" transform="translate(26.725 79.551)">
						<path
							id="Path_28152"
							data-name="Path 28152"
							d="M609.292,1693.183l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,609.292,1693.183Z"
							transform="translate(-609.003 -1691.378)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28153"
							data-name="Path 28153"
							d="M629.9,1705.04l2.807-1.644a1.174,1.174,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.812-1.62A.584.584,0,0,1,629.9,1705.04Z"
							transform="translate(-623.323 -1699.618)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28154"
							data-name="Path 28154"
							d="M649.9,1716.265l2.807-1.644a1.173,1.173,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.173,1.173,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,649.9,1716.265Z"
							transform="translate(-637.224 -1707.419)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28155"
							data-name="Path 28155"
							d="M671.182,1727.858l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,671.182,1727.858Z"
							transform="translate(-652.014 -1715.476)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28156"
							data-name="Path 28156"
							d="M691.686,1740.1l2.807-1.644a1.175,1.175,0,0,1,1.181,0l14.272,8.243a.584.584,0,0,1,.013,1l-2.727,1.674a1.175,1.175,0,0,1-1.2.016l-14.343-8.28A.584.584,0,0,1,691.686,1740.1Z"
							transform="translate(-666.263 -1723.981)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28157"
							data-name="Path 28157"
							d="M749.26,1773.121l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.741,1.583a.584.584,0,0,1,.014,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.813-1.619A.584.584,0,0,1,749.26,1773.121Z"
							transform="translate(-706.274 -1746.931)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28158"
							data-name="Path 28158"
							d="M768.847,1785.133l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.016l-2.812-1.62A.584.584,0,0,1,768.847,1785.133Z"
							transform="translate(-719.887 -1755.279)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28159"
							data-name="Path 28159"
							d="M790.188,1797.7l2.807-1.644a1.173,1.173,0,0,1,1.18,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.174,1.174,0,0,1-1.2.017l-2.813-1.62A.584.584,0,0,1,790.188,1797.7Z"
							transform="translate(-734.717 -1764.014)"
							fill="#d3ddf7"
						/>
						<path
							id="Path_28160"
							data-name="Path 28160"
							d="M809.484,1808.17l2.807-1.644a1.175,1.175,0,0,1,1.181,0l2.742,1.583a.584.584,0,0,1,.013,1l-2.727,1.674a1.173,1.173,0,0,1-1.2.017l-2.812-1.619A.584.584,0,0,1,809.484,1808.17Z"
							transform="translate(-748.128 -1771.289)"
							fill="#d3ddf7"
						/>
					</g>
					<g id="Group_15755" data-name="Group 15755" transform="translate(62.055 13.12)">
						<path
							id="Path_28161"
							data-name="Path 28161"
							d="M791.569,1491.664l-31.119-18.019a.292.292,0,0,0-.43.182l-.351,1.735a.416.416,0,0,0,.2.46l31.125,18.032a.292.292,0,0,0,.43-.183l.346-1.749A.416.416,0,0,0,791.569,1491.664Z"
							transform="translate(-749.031 -1473.606)"
							fill="#c5d2f4"
						/>
						<path
							id="Path_28162"
							data-name="Path 28162"
							d="M787.748,1507.234l-31.119-18.019a.292.292,0,0,0-.43.182l-.172.914a.416.416,0,0,0,.2.46l31.124,18.032a.292.292,0,0,0,.43-.182l.167-.927A.416.416,0,0,0,787.748,1507.234Z"
							transform="translate(-746.5 -1484.426)"
							fill="#c5d2f4"
						/>
						<path
							id="Path_28163"
							data-name="Path 28163"
							d="M774.495,1512.342l-20.355-11.8a.292.292,0,0,0-.43.182l-.172.914a.416.416,0,0,0,.2.46l20.36,11.813a.293.293,0,0,0,.43-.182l.167-.928A.416.416,0,0,0,774.495,1512.342Z"
							transform="translate(-744.771 -1492.298)"
							fill="#c5d2f4"
						/>
						<g id="Group_15743" data-name="Group 15743" transform="translate(0.541 22.602)">
							<path
								id="Path_28164"
								data-name="Path 28164"
								d="M732.288,1564.66a4.508,4.508,0,0,1-3.478-2.116,13.263,13.263,0,0,1-1.387-11.9c.745-1.726,1.9-2.764,3.248-2.921s2.711.587,3.833,2.1h0a13.263,13.263,0,0,1,1.388,11.9c-.745,1.726-1.9,2.764-3.248,2.921A3.109,3.109,0,0,1,732.288,1564.66Zm-1.263-16.6a2.67,2.67,0,0,0-.312.018c-1.214.142-2.264,1.1-2.955,2.7a12.859,12.859,0,0,0,1.345,11.541,3.97,3.97,0,0,0,3.5,1.951c1.215-.142,2.264-1.1,2.956-2.7a12.859,12.859,0,0,0-1.346-11.54A4.164,4.164,0,0,0,731.025,1548.064Z"
								transform="translate(-726.597 -1547.699)"
								fill="#c5d2f4"
							/>
						</g>
						<g id="Group_15744" data-name="Group 15744" transform="translate(0 24.096)">
							<path
								id="Path_28165"
								data-name="Path 28165"
								d="M731.053,1568.613a5.025,5.025,0,0,1-3.913-2.337,13.869,13.869,0,0,1-1.451-12.447.73.73,0,1,1,1.341.579,12.441,12.441,0,0,0,1.282,11,2.895,2.895,0,0,0,5.511-.642,12.441,12.441,0,0,0-1.282-11,.73.73,0,1,1,1.172-.872,13.869,13.869,0,0,1,1.451,12.447c-.826,1.914-2.136,3.067-3.688,3.248A3.62,3.62,0,0,1,731.053,1568.613Z"
								transform="translate(-724.824 -1552.598)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15745" data-name="Group 15745" transform="translate(15.088 30.899)">
							<path
								id="Path_28166"
								data-name="Path 28166"
								d="M779.978,1591.861a4.508,4.508,0,0,1-3.478-2.116,13.264,13.264,0,0,1-1.388-11.9c.746-1.727,1.9-2.764,3.248-2.921s2.711.586,3.833,2.1h0a13.262,13.262,0,0,1,1.388,11.9c-.745,1.726-1.9,2.764-3.248,2.921A3.076,3.076,0,0,1,779.978,1591.861Zm-1.263-16.6a2.747,2.747,0,0,0-.312.018c-1.214.142-2.264,1.1-2.956,2.7a12.859,12.859,0,0,0,1.346,11.541c1.041,1.4,2.285,2.092,3.5,1.951s2.264-1.1,2.955-2.7a12.858,12.858,0,0,0-1.346-11.541A4.163,4.163,0,0,0,778.715,1575.265Z"
								transform="translate(-774.287 -1574.9)"
								fill="#c5d2f4"
							/>
						</g>
						<g id="Group_15746" data-name="Group 15746" transform="translate(14.873 32.394)">
							<path
								id="Path_28167"
								data-name="Path 28167"
								d="M779.484,1595.814a5.024,5.024,0,0,1-3.913-2.337,11.962,11.962,0,0,1-1.973-4.574.73.73,0,1,1,1.427-.311,10.5,10.5,0,0,0,1.718,4.013,2.895,2.895,0,0,0,5.511-.642,12.443,12.443,0,0,0-1.282-11,.73.73,0,1,1,1.172-.872,13.87,13.87,0,0,1,1.451,12.447c-.826,1.914-2.135,3.067-3.687,3.248A3.677,3.677,0,0,1,779.484,1595.814Z"
								transform="translate(-773.58 -1579.799)"
								fill="#2647c8"
							/>
						</g>
						<g id="Group_15747" data-name="Group 15747" transform="translate(30.426 42.48)">
							<path
								id="Path_28168"
								data-name="Path 28168"
								d="M824.932,1627.336a.362.362,0,0,1-.089-.011.366.366,0,0,1-.267-.443l3.413-13.741a.365.365,0,0,1,.709.176l-3.412,13.741A.365.365,0,0,1,824.932,1627.336Z"
								transform="translate(-824.567 -1612.864)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15748" data-name="Group 15748" transform="translate(35.132 34.477)">
							<path
								id="Path_28169"
								data-name="Path 28169"
								d="M840.361,1612.027a.373.373,0,0,1-.089-.01.365.365,0,0,1-.267-.442l6.126-24.669a.365.365,0,1,1,.709.176l-6.126,24.669A.365.365,0,0,1,840.361,1612.027Z"
								transform="translate(-839.996 -1586.627)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15749" data-name="Group 15749" transform="translate(39.839 46.042)">
							<path
								id="Path_28170"
								data-name="Path 28170"
								d="M855.79,1641.3a.365.365,0,0,1-.355-.453l3.98-16.028a.365.365,0,1,1,.709.176l-3.98,16.029A.365.365,0,0,1,855.79,1641.3Z"
								transform="translate(-855.425 -1624.54)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15750" data-name="Group 15750" transform="translate(44.546 31.092)">
							<path
								id="Path_28171"
								data-name="Path 28171"
								d="M871.219,1610.164a.365.365,0,0,1-.355-.453l8.419-33.9a.365.365,0,1,1,.709.176l-8.419,33.9A.365.365,0,0,1,871.219,1610.164Z"
								transform="translate(-870.854 -1575.53)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15751" data-name="Group 15751" transform="translate(49.252 42.48)">
							<path
								id="Path_28172"
								data-name="Path 28172"
								d="M886.647,1639.033a.373.373,0,0,1-.088-.011.365.365,0,0,1-.266-.442l6.317-25.439a.365.365,0,0,1,.709.176L887,1638.756A.366.366,0,0,1,886.647,1639.033Z"
								transform="translate(-886.281 -1612.864)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15752" data-name="Group 15752" transform="translate(53.958 32.937)">
							<path
								id="Path_28173"
								data-name="Path 28173"
								d="M902.076,1620.218a.361.361,0,0,1-.088-.011.365.365,0,0,1-.266-.443l9.413-37.906a.365.365,0,1,1,.709.176l-9.413,37.906A.365.365,0,0,1,902.076,1620.218Z"
								transform="translate(-901.71 -1581.581)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15753" data-name="Group 15753" transform="translate(58.665 53.135)">
							<path
								id="Path_28174"
								data-name="Path 28174"
								d="M917.505,1669.157a.365.365,0,0,1-.355-.453l5.123-20.633a.365.365,0,0,1,.709.176l-5.123,20.632A.365.365,0,0,1,917.505,1669.157Z"
								transform="translate(-917.14 -1647.793)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
						<g id="Group_15754" data-name="Group 15754" transform="translate(63.371 49.351)">
							<path
								id="Path_28175"
								data-name="Path 28175"
								d="M932.934,1663.459a.387.387,0,0,1-.089-.011.366.366,0,0,1-.266-.443l6.789-27.341a.365.365,0,1,1,.709.176l-6.789,27.341A.366.366,0,0,1,932.934,1663.459Z"
								transform="translate(-932.568 -1635.387)"
								fill="url(#linear-gradient-21)"
							/>
						</g>
					</g>
				</g>
				<g id="Group_15801" class="Group_15801" data-name="Group 15801" transform="translate(567.229 384.298)">
					<g id="Group_15796" data-name="Group 15796">
						<g id="Group_15784" data-name="Group 15784">
							<path
								id="Path_28626"
								data-name="Path 28626"
								d="M2312.685,1550.408l-88.712,49.035v2.8a1.913,1.913,0,0,0,.956,1.656l39.373,22.759a3.466,3.466,0,0,0,3.489-.012l85.536-50.205a1.913,1.913,0,0,0,.945-1.65v-2.829Z"
								transform="translate(-2223.973 -1547.544)"
								fill="#dce4f9"
							/>
							<path
								id="Path_28627"
								data-name="Path 28627"
								d="M2311.369,1541.375l-86.738,50.3a1.318,1.318,0,0,0,0,2.281l40.095,23.149a2.627,2.627,0,0,0,2.64-.008l86.252-50.495a1.318,1.318,0,0,0-.005-2.277L2314,1541.375A2.626,2.626,0,0,0,2311.369,1541.375Z"
								transform="translate(-2223.973 -1541.021)"
								fill="#eef2fc"
							/>
						</g>
						<g id="Group_15785" data-name="Group 15785" transform="translate(7.57 44.378)">
							<path
								id="Path_28628"
								data-name="Path 28628"
								d="M2258.188,1688.5l-9.4,4.888v.6a.2.2,0,0,0,.1.175l4.171,2.411a.367.367,0,0,0,.37,0l9.061-5.318a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2248.79 -1687.887)"
								fill="#eaedff"
							/>
							<path
								id="Path_28629"
								data-name="Path 28629"
								d="M2258.049,1686.537l-9.189,5.328a.14.14,0,0,0,0,.242l4.248,2.452a.278.278,0,0,0,.28,0l9.137-5.349a.14.14,0,0,0,0-.241l-4.2-2.431A.278.278,0,0,0,2258.049,1686.537Z"
								transform="translate(-2248.79 -1686.499)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15786" data-name="Group 15786" transform="translate(20.307 30.52)">
							<path
								id="Path_28630"
								data-name="Path 28630"
								d="M2310.942,1643.07l-20.4,11.31v.6a.2.2,0,0,0,.1.176l4.171,2.411a.367.367,0,0,0,.37,0l20.062-11.74a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2290.544 -1642.46)"
								fill="#eaedff"
							/>
							<path
								id="Path_28631"
								data-name="Path 28631"
								d="M2310.8,1641.109l-20.189,11.751a.14.14,0,0,0,0,.242l4.248,2.452a.278.278,0,0,0,.279,0l20.138-11.771a.14.14,0,0,0,0-.241l-4.2-2.431A.279.279,0,0,0,2310.8,1641.109Z"
								transform="translate(-2290.544 -1641.071)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15787" data-name="Group 15787" transform="translate(43.852 16.794)">
							<path
								id="Path_28632"
								data-name="Path 28632"
								d="M2388.127,1598.074l-20.4,11.31v.6a.2.2,0,0,0,.1.175l4.171,2.411a.368.368,0,0,0,.37,0l20.062-11.741a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2367.729 -1597.464)"
								fill="#eaedff"
							/>
							<path
								id="Path_28633"
								data-name="Path 28633"
								d="M2387.988,1596.113l-20.189,11.751a.14.14,0,0,0,0,.242l4.247,2.452a.279.279,0,0,0,.28,0l20.138-11.771a.139.139,0,0,0,0-.241l-4.2-2.432A.279.279,0,0,0,2387.988,1596.113Z"
								transform="translate(-2367.729 -1596.075)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15788" data-name="Group 15788" transform="translate(66.341 6.548)">
							<path
								id="Path_28634"
								data-name="Path 28634"
								d="M2456.738,1564.485l-15.285,8.359v.6a.2.2,0,0,0,.1.175l4.171,2.411a.367.367,0,0,0,.37,0l14.949-8.789a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2441.453 -1563.875)"
								fill="#eaedff"
							/>
							<path
								id="Path_28635"
								data-name="Path 28635"
								d="M2456.6,1562.524l-15.076,8.8a.14.14,0,0,0,0,.242l4.248,2.452a.279.279,0,0,0,.28,0l15.024-8.82a.14.14,0,0,0,0-.241l-4.2-2.431A.278.278,0,0,0,2456.6,1562.524Z"
								transform="translate(-2441.453 -1562.486)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15789" data-name="Group 15789" transform="translate(14.117 6.865)">
							<path
								id="Path_28636"
								data-name="Path 28636"
								d="M2349.937,1565.523l-79.687,46.13v.6a.2.2,0,0,0,.1.176l4.171,2.411a.367.367,0,0,0,.369,0l79.351-46.561a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2270.25 -1564.913)"
								fill="#eaedff"
							/>
							<path
								id="Path_28637"
								data-name="Path 28637"
								d="M2349.8,1563.562l-79.478,46.571a.14.14,0,0,0,0,.242l4.248,2.452a.279.279,0,0,0,.28,0l79.427-46.591a.14.14,0,0,0,0-.241l-4.2-2.432A.279.279,0,0,0,2349.8,1563.562Z"
								transform="translate(-2270.25 -1563.524)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15790" data-name="Group 15790" transform="translate(20.663 10.594)">
							<path
								id="Path_28638"
								data-name="Path 28638"
								d="M2371.4,1577.748l-79.687,46.13v.6a.2.2,0,0,0,.1.175l4.171,2.411a.368.368,0,0,0,.37,0l79.351-46.561a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2291.709 -1577.139)"
								fill="#eaedff"
							/>
							<path
								id="Path_28639"
								data-name="Path 28639"
								d="M2371.257,1575.787l-79.478,46.57a.14.14,0,0,0,0,.242l4.247,2.452a.279.279,0,0,0,.28,0l79.426-46.591a.14.14,0,0,0,0-.241l-4.2-2.432A.279.279,0,0,0,2371.257,1575.787Z"
								transform="translate(-2291.709 -1575.75)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15791" data-name="Group 15791" transform="translate(27.209 14.323)">
							<path
								id="Path_28640"
								data-name="Path 28640"
								d="M2392.856,1589.973l-79.687,46.13v.6a.2.2,0,0,0,.1.175l4.171,2.411a.366.366,0,0,0,.369,0l79.351-46.561a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2313.169 -1589.364)"
								fill="#eaedff"
							/>
							<path
								id="Path_28641"
								data-name="Path 28641"
								d="M2392.716,1588.013l-79.478,46.57a.14.14,0,0,0,0,.242l4.248,2.452a.278.278,0,0,0,.28,0l79.427-46.591a.14.14,0,0,0,0-.241l-4.2-2.431A.278.278,0,0,0,2392.716,1588.013Z"
								transform="translate(-2313.169 -1587.975)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15792" data-name="Group 15792" transform="translate(33.755 18.023)">
							<path
								id="Path_28642"
								data-name="Path 28642"
								d="M2414.315,1602.1l-79.687,46.13v.6a.2.2,0,0,0,.1.175l4.171,2.411a.367.367,0,0,0,.37,0l79.351-46.56a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2334.628 -1601.493)"
								fill="#eaedff"
							/>
							<path
								id="Path_28643"
								data-name="Path 28643"
								d="M2414.175,1600.141l-79.478,46.571a.14.14,0,0,0,0,.242l4.247,2.452a.278.278,0,0,0,.28,0l79.426-46.591a.139.139,0,0,0,0-.241l-4.2-2.432A.279.279,0,0,0,2414.175,1600.141Z"
								transform="translate(-2334.628 -1600.104)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15793" data-name="Group 15793" transform="translate(46.018 53.808)">
							<path
								id="Path_28644"
								data-name="Path 28644"
								d="M2395.1,1719.411l-20.275,11.069v.6a.2.2,0,0,0,.1.175l4.171,2.411a.366.366,0,0,0,.369,0l19.938-11.5a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2374.828 -1718.802)"
								fill="#eaedff"
							/>
							<path
								id="Path_28645"
								data-name="Path 28645"
								d="M2394.964,1717.45l-20.066,11.509a.14.14,0,0,0,0,.242l4.248,2.452a.278.278,0,0,0,.28,0l20.014-11.53a.139.139,0,0,0,0-.241l-4.2-2.432A.277.277,0,0,0,2394.964,1717.45Z"
								transform="translate(-2374.828 -1717.412)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15794" data-name="Group 15794" transform="translate(69.178 40.584)">
							<path
								id="Path_28646"
								data-name="Path 28646"
								d="M2471.026,1676.062l-20.275,11.069v.6a.2.2,0,0,0,.1.175l4.171,2.411a.367.367,0,0,0,.37,0l19.938-11.5a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2450.751 -1675.452)"
								fill="#eaedff"
							/>
							<path
								id="Path_28647"
								data-name="Path 28647"
								d="M2470.887,1674.1l-20.066,11.509a.14.14,0,0,0,0,.242l4.247,2.452a.279.279,0,0,0,.28,0l20.014-11.53a.14.14,0,0,0,0-.241l-4.2-2.431A.278.278,0,0,0,2470.887,1674.1Z"
								transform="translate(-2450.751 -1674.063)"
								fill="#fff"
							/>
						</g>
						<g id="Group_15795" data-name="Group 15795" transform="translate(92.722 27.092)">
							<path
								id="Path_28648"
								data-name="Path 28648"
								d="M2548.208,1631.834l-20.275,11.069v.6a.2.2,0,0,0,.1.175l4.171,2.411a.366.366,0,0,0,.369,0l19.938-11.5a.2.2,0,0,0,.1-.175v-.606Z"
								transform="translate(-2527.933 -1631.224)"
								fill="#eaedff"
							/>
							<path
								id="Path_28649"
								data-name="Path 28649"
								d="M2548.068,1629.873,2528,1641.382a.139.139,0,0,0,0,.242l4.248,2.452a.279.279,0,0,0,.28,0l20.014-11.53a.14.14,0,0,0,0-.241l-4.2-2.431A.278.278,0,0,0,2548.068,1629.873Z"
								transform="translate(-2527.933 -1629.835)"
								fill="#fff"
							/>
						</g>
					</g>
					<path id="Path_28658" data-name="Path 28658" d="M2540.222,1617.216s7.118-1.085,8.232-3.871l.289,3.1-10.323,4.527Z" transform="translate(-2442.499 -1591.283)" fill="#fff" />
				</g>
				<g id="Group_16038" class="Group_16038" transform="translate(567.229 384.298)">
					<g id="Group_15777" data-name="Group 15777" transform="translate(98.779 114.16)" opacity="0.2">
						<path id="Path_28503" data-name="Path 28503" d="M2580.612,1915.26l54.828,31.655-33.305,19.372-54.345-32.078Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0" />
						<path id="Path_28504" data-name="Path 28504" d="M2580.612,1915.26l53.827,31.077-33.294,19.366-53.355-31.493Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.02" />
						<path id="Path_28505" data-name="Path 28505" d="M2580.612,1915.26l52.826,30.5-33.283,19.36-52.365-30.909Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.039" />
						<path id="Path_28506" data-name="Path 28506" d="M2580.612,1915.26l51.824,29.921-33.272,19.353-51.375-30.324Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.059" />
						<path id="Path_28507" data-name="Path 28507" d="M2580.612,1915.26l50.823,29.343-33.261,19.347-50.385-29.74Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.078" />
						<path id="Path_28508" data-name="Path 28508" d="M2580.612,1915.26l49.822,28.765-33.25,19.34-49.395-29.155Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.098" />
						<path id="Path_28509" data-name="Path 28509" d="M2580.612,1915.26l48.821,28.187-33.239,19.334-48.4-28.571Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.118" />
						<path id="Path_28510" data-name="Path 28510" d="M2580.612,1915.26l47.82,27.609L2595.2,1962.2l-47.415-27.986Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.137" />
						<path id="Path_28511" data-name="Path 28511" d="M2580.612,1915.26l46.818,27.031-33.216,19.321-46.424-27.4Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.157" />
						<path id="Path_28512" data-name="Path 28512" d="M2580.612,1915.26l45.817,26.453-33.205,19.314-45.434-26.817Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.176" />
						<path id="Path_28513" data-name="Path 28513" d="M2580.612,1915.26l44.816,25.874-33.194,19.308-44.444-26.233Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.196" />
						<path id="Path_28514" data-name="Path 28514" d="M2580.612,1915.26l43.815,25.3-33.183,19.3-43.454-25.648Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.216" />
						<path id="Path_28515" data-name="Path 28515" d="M2580.612,1915.26l42.814,24.718-33.172,19.3-42.464-25.064Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.235" />
						<path id="Path_28516" data-name="Path 28516" d="M2580.612,1915.26l41.813,24.14-33.161,19.289-41.474-24.479Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.255" />
						<path id="Path_28517" data-name="Path 28517" d="M2580.612,1915.26l40.811,23.562-33.15,19.282-40.483-23.895Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.275" />
						<path id="Path_28518" data-name="Path 28518" d="M2580.612,1915.26l39.81,22.984-33.139,19.276-39.493-23.31Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.294" />
						<path id="Path_28519" data-name="Path 28519" d="M2580.612,1915.26l38.809,22.406-33.127,19.269-38.5-22.725Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.314" />
						<path id="Path_28520" data-name="Path 28520" d="M2580.612,1915.26l37.808,21.828-33.117,19.263-37.513-22.141Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.333" />
						<path id="Path_28521" data-name="Path 28521" d="M2580.612,1915.26l36.806,21.25-33.106,19.256-36.523-21.557Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.353" />
						<path id="Path_28522" data-name="Path 28522" d="M2580.612,1915.26l35.805,20.672-33.095,19.25-35.533-20.972Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.373" />
						<path id="Path_28523" data-name="Path 28523" d="M2580.612,1915.26l34.8,20.094-33.083,19.244-34.543-20.387Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.392" />
						<path id="Path_28524" data-name="Path 28524" d="M2580.612,1915.26l33.8,19.516-33.072,19.237-33.553-19.8Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.412" />
						<path id="Path_28525" data-name="Path 28525" d="M2580.612,1915.26l32.8,18.938-33.061,19.231-32.562-19.219Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.431" />
						<path id="Path_28526" data-name="Path 28526" d="M2580.612,1915.26l31.8,18.36-33.05,19.224-31.572-18.634Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.451" />
						<path id="Path_28527" data-name="Path 28527" d="M2580.612,1915.26l30.8,17.782-33.039,19.218-30.582-18.049Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.471" />
						<path id="Path_28528" data-name="Path 28528" d="M2580.612,1915.26l29.8,17.2-33.028,19.211-29.592-17.465Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.49" />
						<path id="Path_28529" data-name="Path 28529" d="M2580.612,1915.26l28.8,16.626-33.017,19.2-28.6-16.88Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.51" />
						<path id="Path_28530" data-name="Path 28530" d="M2580.612,1915.26l27.8,16.047-33.006,19.2-27.612-16.3Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.529" />
						<path id="Path_28531" data-name="Path 28531" d="M2580.612,1915.26l26.794,15.47-32.995,19.192-26.622-15.712Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.549" />
						<path id="Path_28532" data-name="Path 28532" d="M2580.612,1915.26l25.793,14.891-32.984,19.185-25.632-15.127Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.569" />
						<path id="Path_28533" data-name="Path 28533" d="M2580.612,1915.26l24.792,14.313-32.972,19.179-24.642-14.542Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.588" />
						<path id="Path_28534" data-name="Path 28534" d="M2580.612,1915.26,2604.4,1929l-32.961,19.173-23.651-13.958Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.608" />
						<path id="Path_28535" data-name="Path 28535" d="M2580.612,1915.26l22.789,13.157-32.95,19.166-22.661-13.374Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.627" />
						<path id="Path_28536" data-name="Path 28536" d="M2580.612,1915.26l21.788,12.579L2569.46,1947l-21.671-12.789Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.647" />
						<path id="Path_28537" data-name="Path 28537" d="M2580.612,1915.26l20.787,12-32.928,19.153-20.681-12.2Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.667" />
						<path id="Path_28538" data-name="Path 28538" d="M2580.612,1915.26l19.786,11.423-32.917,19.147-19.691-11.62Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.686" />
						<path id="Path_28539" data-name="Path 28539" d="M2580.612,1915.26l18.784,10.845-32.906,19.14-18.7-11.036Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.706" />
						<path id="Path_28540" data-name="Path 28540" d="M2580.612,1915.26l17.783,10.267-32.9,19.134-17.71-10.451Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.725" />
						<path id="Path_28541" data-name="Path 28541" d="M2580.612,1915.26l16.782,9.689-32.884,19.127-16.72-9.866Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.745" />
						<path id="Path_28542" data-name="Path 28542" d="M2580.612,1915.26l15.781,9.111-32.873,19.121-15.73-9.282Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.765" />
						<path id="Path_28543" data-name="Path 28543" d="M2580.612,1915.26l14.779,8.533-32.861,19.114-14.74-8.7Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.784" />
						<path id="Path_28544" data-name="Path 28544" d="M2580.612,1915.26l13.778,7.955-32.851,19.108-13.75-8.113Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.804" />
						<path id="Path_28545" data-name="Path 28545" d="M2580.612,1915.26l12.777,7.377-32.84,19.1-12.76-7.528Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.824" />
						<path id="Path_28546" data-name="Path 28546" d="M2580.612,1915.26l11.776,6.8-32.828,19.1-11.77-6.944Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.843" />
						<path id="Path_28547" data-name="Path 28547" d="M2580.612,1915.26l10.774,6.221-32.817,19.089-10.78-6.359Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.863" />
						<path id="Path_28548" data-name="Path 28548" d="M2580.612,1915.26l9.773,5.642-32.806,19.082-9.79-5.775Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.882" />
						<path id="Path_28549" data-name="Path 28549" d="M2580.612,1915.26l8.772,5.065-32.8,19.076-8.8-5.19Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.902" />
						<path id="Path_28550" data-name="Path 28550" d="M2580.612,1915.26l7.771,4.486-32.784,19.069-7.809-4.606Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.922" />
						<path id="Path_28551" data-name="Path 28551" d="M2580.612,1915.26l6.77,3.908-32.773,19.063-6.819-4.021Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.941" />
						<path id="Path_28552" data-name="Path 28552" d="M2580.612,1915.26l5.769,3.33-32.762,19.057-5.829-3.437Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.961" />
						<path id="Path_28553" data-name="Path 28553" d="M2580.612,1915.26l4.767,2.752-32.75,19.05-4.839-2.852Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" opacity="0.98" />
						<path id="Path_28554" data-name="Path 28554" d="M2580.612,1915.26l3.766,2.174-32.74,19.044-3.849-2.268Z" transform="translate(-2547.79 -1915.26)" fill="#6e8fe4" />
					</g>
					<g id="Group_15781" data-name="Group 15781" transform="translate(56.41 58.897)">
						<g id="Group_15780" data-name="Group 15780" transform="translate(0 32.052)" opacity="0.18">
							<path
								id="Path_28562"
								data-name="Path 28562"
								d="M2455.259,1890.3l41.242-23.811a1.7,1.7,0,0,0,0-2.936l-41.242-23.811a4.275,4.275,0,0,0-4.274,0l-41.242,23.811a1.7,1.7,0,0,0,0,2.936l41.242,23.811A4.274,4.274,0,0,0,2455.259,1890.3Z"
								transform="translate(-2408.895 -1839.17)"
								fill="#fff"
								opacity="0"
							/>
							<path
								id="Path_28563"
								data-name="Path 28563"
								d="M2456.1,1890.587l40.892-23.609a1.681,1.681,0,0,0,0-2.911l-40.892-23.608a4.238,4.238,0,0,0-4.237,0l-40.891,23.608a1.68,1.68,0,0,0,0,2.911l40.891,23.609A4.238,4.238,0,0,0,2456.1,1890.587Z"
								transform="translate(-2409.753 -1839.671)"
								fill="#fbfcfe"
								opacity="0.02"
							/>
							<path
								id="Path_28564"
								data-name="Path 28564"
								d="M2456.938,1890.872l40.541-23.406a1.666,1.666,0,0,0,0-2.886l-40.541-23.406a4.2,4.2,0,0,0-4.2,0l-40.54,23.406a1.666,1.666,0,0,0,0,2.886l40.54,23.406A4.2,4.2,0,0,0,2456.938,1890.872Z"
								transform="translate(-2410.61 -1840.172)"
								fill="#f7f8fc"
								opacity="0.039"
							/>
							<path
								id="Path_28565"
								data-name="Path 28565"
								d="M2457.778,1891.158l40.189-23.2a1.652,1.652,0,0,0,0-2.861l-40.189-23.2a4.165,4.165,0,0,0-4.165,0l-40.189,23.2a1.652,1.652,0,0,0,0,2.861l40.189,23.2A4.165,4.165,0,0,0,2457.778,1891.158Z"
								transform="translate(-2411.469 -1840.674)"
								fill="#f3f5fb"
								opacity="0.059"
							/>
							<path
								id="Path_28566"
								data-name="Path 28566"
								d="M2458.617,1891.445l39.838-23a1.637,1.637,0,0,0,0-2.836l-39.838-23a4.128,4.128,0,0,0-4.128,0l-39.838,23a1.637,1.637,0,0,0,0,2.836l39.838,23A4.128,4.128,0,0,0,2458.617,1891.445Z"
								transform="translate(-2412.326 -1841.175)"
								fill="#eff2f9"
								opacity="0.078"
							/>
							<path
								id="Path_28567"
								data-name="Path 28567"
								d="M2459.457,1891.731l39.487-22.8a1.623,1.623,0,0,0,0-2.811l-39.487-22.8a4.092,4.092,0,0,0-4.092,0l-39.487,22.8a1.622,1.622,0,0,0,0,2.811l39.487,22.8A4.09,4.09,0,0,0,2459.457,1891.731Z"
								transform="translate(-2413.184 -1841.677)"
								fill="#ebeff8"
								opacity="0.098"
							/>
							<path
								id="Path_28568"
								data-name="Path 28568"
								d="M2460.3,1892.017l39.136-22.595a1.608,1.608,0,0,0,0-2.786l-39.136-22.595a4.057,4.057,0,0,0-4.055,0l-39.136,22.595a1.609,1.609,0,0,0,0,2.786l39.136,22.595A4.055,4.055,0,0,0,2460.3,1892.017Z"
								transform="translate(-2414.042 -1842.178)"
								fill="#e7ebf6"
								opacity="0.118"
							/>
							<path
								id="Path_28569"
								data-name="Path 28569"
								d="M2461.136,1892.3l38.785-22.392a1.594,1.594,0,0,0,0-2.76l-38.785-22.392a4.019,4.019,0,0,0-4.019,0l-38.785,22.392a1.594,1.594,0,0,0,0,2.76l38.784,22.392A4.019,4.019,0,0,0,2461.136,1892.3Z"
								transform="translate(-2414.9 -1842.68)"
								fill="#e3e8f5"
								opacity="0.137"
							/>
							<path
								id="Path_28570"
								data-name="Path 28570"
								d="M2461.976,1892.589l38.434-22.19a1.579,1.579,0,0,0,0-2.736l-38.434-22.189a3.983,3.983,0,0,0-3.982,0l-38.434,22.189a1.58,1.58,0,0,0,0,2.736l38.434,22.19A3.983,3.983,0,0,0,2461.976,1892.589Z"
								transform="translate(-2415.758 -1843.18)"
								fill="#dfe5f3"
								opacity="0.157"
							/>
							<path
								id="Path_28571"
								data-name="Path 28571"
								d="M2462.815,1892.875l38.083-21.987a1.565,1.565,0,0,0,0-2.711l-38.083-21.987a3.946,3.946,0,0,0-3.946,0l-38.083,21.987a1.565,1.565,0,0,0,0,2.711l38.083,21.987A3.946,3.946,0,0,0,2462.815,1892.875Z"
								transform="translate(-2416.615 -1843.682)"
								fill="#dbe1f2"
								opacity="0.176"
							/>
							<path
								id="Path_28572"
								data-name="Path 28572"
								d="M2463.655,1893.162l37.731-21.784a1.55,1.55,0,0,0,0-2.686l-37.731-21.784a3.91,3.91,0,0,0-3.91,0l-37.731,21.784a1.55,1.55,0,0,0,0,2.686l37.731,21.784A3.911,3.911,0,0,0,2463.655,1893.162Z"
								transform="translate(-2417.473 -1844.184)"
								fill="#d7def0"
								opacity="0.196"
							/>
							<path
								id="Path_28573"
								data-name="Path 28573"
								d="M2464.495,1893.448l37.38-21.581a1.536,1.536,0,0,0,0-2.661l-37.38-21.581a3.874,3.874,0,0,0-3.874,0l-37.38,21.581a1.536,1.536,0,0,0,0,2.661l37.38,21.581A3.874,3.874,0,0,0,2464.495,1893.448Z"
								transform="translate(-2418.331 -1844.685)"
								fill="#d3dbef"
								opacity="0.216"
							/>
							<path
								id="Path_28574"
								data-name="Path 28574"
								d="M2465.334,1893.734l37.029-21.378a1.522,1.522,0,0,0,0-2.636l-37.029-21.378a3.836,3.836,0,0,0-3.837,0l-37.029,21.378a1.522,1.522,0,0,0,0,2.636l37.029,21.378A3.836,3.836,0,0,0,2465.334,1893.734Z"
								transform="translate(-2419.189 -1845.187)"
								fill="#cfd7ed"
								opacity="0.235"
							/>
							<path
								id="Path_28575"
								data-name="Path 28575"
								d="M2466.173,1894.021l36.678-21.176a1.507,1.507,0,0,0,0-2.611l-36.678-21.176a3.8,3.8,0,0,0-3.8,0l-36.678,21.176a1.507,1.507,0,0,0,0,2.611l36.678,21.176A3.8,3.8,0,0,0,2466.173,1894.021Z"
								transform="translate(-2420.047 -1845.688)"
								fill="#cbd4ec"
								opacity="0.255"
							/>
							<path
								id="Path_28576"
								data-name="Path 28576"
								d="M2467.013,1894.307l36.327-20.973a1.493,1.493,0,0,0,0-2.586l-36.327-20.973a3.763,3.763,0,0,0-3.764,0l-36.327,20.973a1.493,1.493,0,0,0,0,2.586l36.327,20.973A3.764,3.764,0,0,0,2467.013,1894.307Z"
								transform="translate(-2420.904 -1846.189)"
								fill="#c7d1ea"
								opacity="0.275"
							/>
							<path
								id="Path_28577"
								data-name="Path 28577"
								d="M2467.853,1894.593l35.976-20.77a1.479,1.479,0,0,0,0-2.561l-35.976-20.77a3.727,3.727,0,0,0-3.728,0l-35.976,20.77a1.478,1.478,0,0,0,0,2.561l35.976,20.77A3.727,3.727,0,0,0,2467.853,1894.593Z"
								transform="translate(-2421.762 -1846.691)"
								fill="#c3cee9"
								opacity="0.294"
							/>
							<path
								id="Path_28578"
								data-name="Path 28578"
								d="M2468.692,1894.879l35.625-20.568a1.464,1.464,0,0,0,0-2.536l-35.625-20.567a3.691,3.691,0,0,0-3.691,0l-35.624,20.567a1.464,1.464,0,0,0,0,2.536L2465,1894.879A3.692,3.692,0,0,0,2468.692,1894.879Z"
								transform="translate(-2422.62 -1847.192)"
								fill="#bfcae7"
								opacity="0.314"
							/>
							<path
								id="Path_28579"
								data-name="Path 28579"
								d="M2469.532,1895.165l35.273-20.365a1.45,1.45,0,0,0,0-2.511l-35.273-20.365a3.656,3.656,0,0,0-3.655,0L2430.6,1872.29a1.45,1.45,0,0,0,0,2.511l35.273,20.365A3.655,3.655,0,0,0,2469.532,1895.165Z"
								transform="translate(-2423.478 -1847.693)"
								fill="#bbc7e6"
								opacity="0.333"
							/>
							<path
								id="Path_28580"
								data-name="Path 28580"
								d="M2470.372,1895.452l34.923-20.162a1.435,1.435,0,0,0,0-2.486l-34.923-20.162a3.618,3.618,0,0,0-3.618,0l-34.922,20.162a1.435,1.435,0,0,0,0,2.486l34.922,20.162A3.619,3.619,0,0,0,2470.372,1895.452Z"
								transform="translate(-2424.336 -1848.195)"
								fill="#b7c4e5"
								opacity="0.353"
							/>
							<path
								id="Path_28581"
								data-name="Path 28581"
								d="M2471.212,1895.738l34.571-19.96a1.421,1.421,0,0,0,0-2.461l-34.572-19.959a3.583,3.583,0,0,0-3.582,0l-34.571,19.959a1.421,1.421,0,0,0,0,2.461l34.571,19.96A3.582,3.582,0,0,0,2471.212,1895.738Z"
								transform="translate(-2425.194 -1848.697)"
								fill="#b3c0e3"
								opacity="0.373"
							/>
							<path
								id="Path_28582"
								data-name="Path 28582"
								d="M2472.051,1896.024l34.22-19.757a1.406,1.406,0,0,0,0-2.436l-34.22-19.757a3.545,3.545,0,0,0-3.546,0l-34.22,19.757a1.407,1.407,0,0,0,0,2.436l34.22,19.757A3.546,3.546,0,0,0,2472.051,1896.024Z"
								transform="translate(-2426.052 -1849.197)"
								fill="#afbde2"
								opacity="0.392"
							/>
							<path
								id="Path_28583"
								data-name="Path 28583"
								d="M2472.891,1896.31l33.869-19.554a1.392,1.392,0,0,0,0-2.411l-33.869-19.554a3.509,3.509,0,0,0-3.509,0l-33.869,19.554a1.392,1.392,0,0,0,0,2.411l33.869,19.554A3.509,3.509,0,0,0,2472.891,1896.31Z"
								transform="translate(-2426.909 -1849.699)"
								fill="#abbae0"
								opacity="0.412"
							/>
							<path
								id="Path_28584"
								data-name="Path 28584"
								d="M2473.73,1896.6l33.518-19.352a1.377,1.377,0,0,0,0-2.386l-33.518-19.351a3.474,3.474,0,0,0-3.473,0l-33.517,19.351a1.377,1.377,0,0,0,0,2.386l33.517,19.352A3.475,3.475,0,0,0,2473.73,1896.6Z"
								transform="translate(-2427.767 -1850.2)"
								fill="#a7b7df"
								opacity="0.431"
							/>
							<path
								id="Path_28585"
								data-name="Path 28585"
								d="M2474.57,1896.882l33.167-19.149a1.363,1.363,0,0,0,0-2.361l-33.167-19.149a3.437,3.437,0,0,0-3.437,0l-33.167,19.149a1.363,1.363,0,0,0,0,2.361l33.167,19.149A3.437,3.437,0,0,0,2474.57,1896.882Z"
								transform="translate(-2428.625 -1850.702)"
								fill="#a3b3dd"
								opacity="0.451"
							/>
							<path
								id="Path_28586"
								data-name="Path 28586"
								d="M2475.41,1897.169l32.816-18.946a1.348,1.348,0,0,0,0-2.336l-32.816-18.946a3.4,3.4,0,0,0-3.4,0l-32.816,18.946a1.349,1.349,0,0,0,0,2.336l32.815,18.946A3.4,3.4,0,0,0,2475.41,1897.169Z"
								transform="translate(-2429.483 -1851.203)"
								fill="#9fb0dc"
								opacity="0.471"
							/>
							<path
								id="Path_28587"
								data-name="Path 28587"
								d="M2476.25,1897.455l32.465-18.743a1.334,1.334,0,0,0,0-2.311l-32.465-18.743a3.366,3.366,0,0,0-3.364,0l-32.464,18.743a1.334,1.334,0,0,0,0,2.311l32.464,18.743A3.363,3.363,0,0,0,2476.25,1897.455Z"
								transform="translate(-2430.341 -1851.705)"
								fill="#9badda"
								opacity="0.49"
							/>
							<path
								id="Path_28588"
								data-name="Path 28588"
								d="M2477.089,1897.741,2509.2,1879.2a1.32,1.32,0,0,0,0-2.286l-32.113-18.54a3.326,3.326,0,0,0-3.327,0l-32.113,18.54a1.319,1.319,0,0,0,0,2.286l32.113,18.541A3.327,3.327,0,0,0,2477.089,1897.741Z"
								transform="translate(-2431.198 -1852.206)"
								fill="#98a9d9"
								opacity="0.51"
							/>
							<path
								id="Path_28589"
								data-name="Path 28589"
								d="M2477.929,1898.027l31.762-18.338a1.305,1.305,0,0,0,0-2.261l-31.762-18.338a3.291,3.291,0,0,0-3.291,0l-31.762,18.338a1.306,1.306,0,0,0,0,2.261l31.762,18.338A3.291,3.291,0,0,0,2477.929,1898.027Z"
								transform="translate(-2432.056 -1852.707)"
								fill="#94a6d7"
								opacity="0.529"
							/>
							<path
								id="Path_28590"
								data-name="Path 28590"
								d="M2478.768,1898.313l31.411-18.135a1.29,1.29,0,0,0,0-2.236l-31.411-18.135a3.255,3.255,0,0,0-3.255,0l-31.411,18.135a1.291,1.291,0,0,0,0,2.236l31.411,18.135A3.256,3.256,0,0,0,2478.768,1898.313Z"
								transform="translate(-2432.914 -1853.209)"
								fill="#90a3d6"
								opacity="0.549"
							/>
							<path
								id="Path_28591"
								data-name="Path 28591"
								d="M2479.608,1898.6l31.06-17.932a1.277,1.277,0,0,0,0-2.211l-31.06-17.932a3.217,3.217,0,0,0-3.218,0l-31.06,17.932a1.276,1.276,0,0,0,0,2.211l31.06,17.932A3.218,3.218,0,0,0,2479.608,1898.6Z"
								transform="translate(-2433.772 -1853.711)"
								fill="#8c9fd4"
								opacity="0.569"
							/>
							<path
								id="Path_28592"
								data-name="Path 28592"
								d="M2480.447,1898.886l30.709-17.729a1.262,1.262,0,0,0,0-2.186l-30.709-17.73a3.183,3.183,0,0,0-3.182,0l-30.709,17.73a1.262,1.262,0,0,0,0,2.186l30.709,17.729A3.181,3.181,0,0,0,2480.447,1898.886Z"
								transform="translate(-2434.63 -1854.212)"
								fill="#889cd3"
								opacity="0.588"
							/>
							<path
								id="Path_28593"
								data-name="Path 28593"
								d="M2481.287,1899.172l30.358-17.527a1.247,1.247,0,0,0,0-2.161l-30.358-17.526a3.146,3.146,0,0,0-3.146,0l-30.358,17.526a1.248,1.248,0,0,0,0,2.161l30.358,17.527A3.146,3.146,0,0,0,2481.287,1899.172Z"
								transform="translate(-2435.488 -1854.714)"
								fill="#8499d1"
								opacity="0.608"
							/>
							<path
								id="Path_28594"
								data-name="Path 28594"
								d="M2482.127,1899.458l30.007-17.324a1.233,1.233,0,0,0,0-2.136l-30.007-17.324a3.109,3.109,0,0,0-3.109,0L2449.011,1880a1.233,1.233,0,0,0,0,2.136l30.006,17.324A3.109,3.109,0,0,0,2482.127,1899.458Z"
								transform="translate(-2436.345 -1855.214)"
								fill="#8096d0"
								opacity="0.627"
							/>
							<path
								id="Path_28595"
								data-name="Path 28595"
								d="M2482.966,1899.744l29.656-17.122a1.219,1.219,0,0,0,0-2.111l-29.656-17.121a3.072,3.072,0,0,0-3.073,0l-29.655,17.121a1.219,1.219,0,0,0,0,2.111l29.655,17.122A3.073,3.073,0,0,0,2482.966,1899.744Z"
								transform="translate(-2437.203 -1855.716)"
								fill="#7c92ce"
								opacity="0.647"
							/>
							<path
								id="Path_28596"
								data-name="Path 28596"
								d="M2483.806,1900.031l29.3-16.919a1.2,1.2,0,0,0,0-2.086l-29.3-16.918a3.037,3.037,0,0,0-3.036,0l-29.3,16.918a1.2,1.2,0,0,0,0,2.086l29.3,16.919A3.037,3.037,0,0,0,2483.806,1900.031Z"
								transform="translate(-2438.061 -1856.218)"
								fill="#788fcd"
								opacity="0.667"
							/>
							<path
								id="Path_28597"
								data-name="Path 28597"
								d="M2484.646,1900.317,2513.6,1883.6a1.19,1.19,0,0,0,0-2.061l-28.953-16.716a3,3,0,0,0-3,0l-28.953,16.716a1.19,1.19,0,0,0,0,2.061l28.953,16.716A3,3,0,0,0,2484.646,1900.317Z"
								transform="translate(-2438.919 -1856.719)"
								fill="#748ccc"
								opacity="0.686"
							/>
							<path
								id="Path_28598"
								data-name="Path 28598"
								d="M2485.486,1900.6l28.6-16.513a1.175,1.175,0,0,0,0-2.036l-28.6-16.513a2.964,2.964,0,0,0-2.964,0l-28.6,16.513a1.175,1.175,0,0,0,0,2.036l28.6,16.513A2.963,2.963,0,0,0,2485.486,1900.6Z"
								transform="translate(-2439.777 -1857.22)"
								fill="#7088ca"
								opacity="0.706"
							/>
							<path
								id="Path_28599"
								data-name="Path 28599"
								d="M2486.325,1900.89l28.251-16.311a1.161,1.161,0,0,0,0-2.011l-28.251-16.31a2.928,2.928,0,0,0-2.927,0l-28.251,16.31a1.161,1.161,0,0,0,0,2.011l28.251,16.311A2.928,2.928,0,0,0,2486.325,1900.89Z"
								transform="translate(-2440.634 -1857.722)"
								fill="#6c85c9"
								opacity="0.725"
							/>
							<path
								id="Path_28600"
								data-name="Path 28600"
								d="M2487.165,1901.176l27.9-16.108a1.147,1.147,0,0,0,0-1.986l-27.9-16.108a2.892,2.892,0,0,0-2.891,0l-27.9,16.108a1.147,1.147,0,0,0,0,1.986l27.9,16.108A2.891,2.891,0,0,0,2487.165,1901.176Z"
								transform="translate(-2441.492 -1858.223)"
								fill="#6882c7"
								opacity="0.745"
							/>
							<path
								id="Path_28601"
								data-name="Path 28601"
								d="M2488,1901.462l27.549-15.905a1.132,1.132,0,0,0,0-1.961l-27.549-15.9a2.853,2.853,0,0,0-2.854,0l-27.548,15.9a1.132,1.132,0,0,0,0,1.961l27.548,15.905A2.855,2.855,0,0,0,2488,1901.462Z"
								transform="translate(-2442.35 -1858.724)"
								fill="#647fc6"
								opacity="0.765"
							/>
							<path
								id="Path_28602"
								data-name="Path 28602"
								d="M2488.844,1901.748l27.2-15.7a1.118,1.118,0,0,0,0-1.936l-27.2-15.7a2.819,2.819,0,0,0-2.818,0l-27.2,15.7a1.118,1.118,0,0,0,0,1.936l27.2,15.7A2.819,2.819,0,0,0,2488.844,1901.748Z"
								transform="translate(-2443.208 -1859.226)"
								fill="#607bc4"
								opacity="0.784"
							/>
							<path
								id="Path_28603"
								data-name="Path 28603"
								d="M2489.684,1902.034l26.846-15.5a1.1,1.1,0,0,0,0-1.911l-26.846-15.5a2.782,2.782,0,0,0-2.782,0l-26.846,15.5a1.1,1.1,0,0,0,0,1.911l26.846,15.5A2.783,2.783,0,0,0,2489.684,1902.034Z"
								transform="translate(-2444.066 -1859.728)"
								fill="#5c78c3"
								opacity="0.804"
							/>
							<path
								id="Path_28604"
								data-name="Path 28604"
								d="M2490.523,1902.32l26.5-15.3a1.089,1.089,0,0,0,0-1.886l-26.5-15.3a2.745,2.745,0,0,0-2.746,0l-26.495,15.3a1.089,1.089,0,0,0,0,1.886l26.495,15.3A2.745,2.745,0,0,0,2490.523,1902.32Z"
								transform="translate(-2444.924 -1860.229)"
								fill="#5875c1"
								opacity="0.824"
							/>
							<path
								id="Path_28605"
								data-name="Path 28605"
								d="M2491.363,1902.606l26.144-15.094a1.075,1.075,0,0,0,0-1.861l-26.144-15.094a2.709,2.709,0,0,0-2.709,0l-26.144,15.094a1.075,1.075,0,0,0,0,1.861l26.144,15.094A2.707,2.707,0,0,0,2491.363,1902.606Z"
								transform="translate(-2445.782 -1860.73)"
								fill="#5471c0"
								opacity="0.843"
							/>
							<path
								id="Path_28606"
								data-name="Path 28606"
								d="M2492.2,1902.892,2518,1888a1.06,1.06,0,0,0,0-1.836l-25.793-14.891a2.671,2.671,0,0,0-2.673,0l-25.793,14.891a1.06,1.06,0,0,0,0,1.836l25.793,14.891A2.673,2.673,0,0,0,2492.2,1902.892Z"
								transform="translate(-2446.639 -1861.231)"
								fill="#506ebe"
								opacity="0.863"
							/>
							<path
								id="Path_28607"
								data-name="Path 28607"
								d="M2493.042,1903.178l25.442-14.688a1.046,1.046,0,0,0,0-1.811l-25.442-14.688a2.635,2.635,0,0,0-2.636,0l-25.442,14.688a1.046,1.046,0,0,0,0,1.811l25.442,14.688A2.636,2.636,0,0,0,2493.042,1903.178Z"
								transform="translate(-2447.497 -1861.733)"
								fill="#4c6bbd"
								opacity="0.882"
							/>
							<path
								id="Path_28608"
								data-name="Path 28608"
								d="M2493.881,1903.465l25.091-14.486a1.032,1.032,0,0,0,0-1.786l-25.091-14.486a2.6,2.6,0,0,0-2.6,0l-25.091,14.486a1.031,1.031,0,0,0,0,1.786l25.091,14.486A2.6,2.6,0,0,0,2493.881,1903.465Z"
								transform="translate(-2448.355 -1862.235)"
								fill="#4867bb"
								opacity="0.902"
							/>
							<path
								id="Path_28609"
								data-name="Path 28609"
								d="M2494.721,1903.751l24.74-14.283a1.017,1.017,0,0,0,0-1.761l-24.74-14.283a2.565,2.565,0,0,0-2.564,0l-24.739,14.283a1.017,1.017,0,0,0,0,1.761l24.739,14.283A2.564,2.564,0,0,0,2494.721,1903.751Z"
								transform="translate(-2449.213 -1862.736)"
								fill="#4464ba"
								opacity="0.922"
							/>
							<path
								id="Path_28610"
								data-name="Path 28610"
								d="M2495.561,1904.038l24.388-14.081a1,1,0,0,0,0-1.736l-24.388-14.08a2.527,2.527,0,0,0-2.527,0l-24.388,14.08a1,1,0,0,0,0,1.736l24.388,14.081A2.527,2.527,0,0,0,2495.561,1904.038Z"
								transform="translate(-2450.071 -1863.237)"
								fill="#4061b8"
								opacity="0.941"
							/>
							<path
								id="Path_28611"
								data-name="Path 28611"
								d="M2496.4,1904.323l24.037-13.878a.988.988,0,0,0,0-1.711l-24.037-13.878a2.491,2.491,0,0,0-2.491,0l-24.037,13.878a.988.988,0,0,0,0,1.711l24.037,13.878A2.491,2.491,0,0,0,2496.4,1904.323Z"
								transform="translate(-2450.928 -1863.739)"
								fill="#3c5eb7"
								opacity="0.961"
							/>
							<path
								id="Path_28612"
								data-name="Path 28612"
								d="M2497.24,1904.61l23.686-13.675a.974.974,0,0,0,0-1.686l-23.686-13.675a2.455,2.455,0,0,0-2.454,0l-23.686,13.675a.973.973,0,0,0,0,1.686l23.686,13.675A2.455,2.455,0,0,0,2497.24,1904.61Z"
								transform="translate(-2451.786 -1864.24)"
								fill="#385ab5"
								opacity="0.98"
							/>
							<path
								id="Path_28613"
								data-name="Path 28613"
								d="M2498.08,1904.9l23.335-13.472a.959.959,0,0,0,0-1.661l-23.335-13.472a2.418,2.418,0,0,0-2.418,0l-23.335,13.472a.959.959,0,0,0,0,1.661l23.335,13.472A2.418,2.418,0,0,0,2498.08,1904.9Z"
								transform="translate(-2452.644 -1864.741)"
								fill="#3457b4"
							/>
						</g>
						<path id="Path_28614" data-name="Path 28614" d="M2444.551,1797.337v36.91a2.661,2.661,0,0,0,1.355,2.318l31.734,17.867v-38.215Z" transform="translate(-2433.674 -1778.046)" fill="#e2e9fa" />
						<path id="Path_28615" data-name="Path 28615" d="M2586.111,1796.6v37.133a2.66,2.66,0,0,1-1.355,2.318l-31.734,17.867v-38.215Z" transform="translate(-2509.057 -1777.537)" fill="#d3ddf7" />
						<path
							id="Path_28616"
							data-name="Path 28616"
							d="M2479.238,1772.352l30.856-17.815a1.268,1.268,0,0,0,0-2.2l-30.856-17.814a3.2,3.2,0,0,0-3.2,0l-30.856,17.814a1.268,1.268,0,0,0,0,2.2l30.856,17.815A3.2,3.2,0,0,0,2479.238,1772.352Z"
							transform="translate(-2433.674 -1734.098)"
							fill="#f0f4fc"
						/>
					</g>
				</g>
				<g id="Group_15803" class="Group_15803" transform="translate(676.459 244.852)">
					<path
						id="Path_28671"
						data-name="Path 28671"
						d="M2622.86,1310.112l-38.9,22.461a3.811,3.811,0,0,0,.036,6.622l38.943,21.925a7.992,7.992,0,0,0,7.841,0l38.943-21.925a3.811,3.811,0,0,0,.036-6.622l-38.9-22.461A7.99,7.99,0,0,0,2622.86,1310.112Z"
						transform="translate(-2582.05 -1240.359)"
						fill="#2647c8"
						opacity="0.3"
					/>
					<path
						id="Path_28672"
						data-name="Path 28672"
						d="M2622.861,1279.343l-40.809,18.409v6.764a4.428,4.428,0,0,0,2.239,3.85l38.645,21.985a7.992,7.992,0,0,0,7.841,0l38.533-21.714a4.431,4.431,0,0,0,2.255-3.859v-6.23l-40.712-19.2A7.99,7.99,0,0,0,2622.861,1279.343Z"
						transform="translate(-2582.051 -1218.976)"
						fill="#d3ddf7"
					/>
					<path
						id="Path_28673"
						data-name="Path 28673"
						d="M2622.86,1255.112l-38.9,22.461a3.811,3.811,0,0,0,.036,6.622l38.943,21.925a7.991,7.991,0,0,0,7.841,0l38.943-21.925a3.811,3.811,0,0,0,.036-6.622l-38.9-22.461A7.99,7.99,0,0,0,2622.86,1255.112Z"
						transform="translate(-2582.05 -1202.136)"
						fill="#f0f4fc"
					/>
					<g id="Group_15802" data-name="Group 15802" transform="translate(23.971)">
						<path id="Path_28674" data-name="Path 28674" d="M2749.3,1088.772l8.459-4.884,8.252,4.884-8.252,4.884Z" transform="translate(-2722.253 -1083.888)" fill="#8ba5e9" />
						<path id="Path_28675" data-name="Path 28675" d="M2749.3,1099.9v67.867l8.459,4.619v-67.6Z" transform="translate(-2722.253 -1095.015)" fill="#6e8fe4" />
						<path id="Path_28676" data-name="Path 28676" d="M2785.284,1099.9v67.6l-8.252,4.884v-67.6Z" transform="translate(-2741.525 -1095.015)" fill="#7d9ae7" />
						<path id="Path_28677" data-name="Path 28677" d="M2704.966,1190.45l8.46-4.884,8.252,4.884-8.252,4.884Z" transform="translate(-2691.442 -1154.55)" fill="#ffc107" />
						<path id="Path_28678" data-name="Path 28678" d="M2704.966,1201.577v44.6l8.46,4.619V1206.46Z" transform="translate(-2691.442 -1165.676)" fill="url(#linear-gradient-33)" />
						<path id="Path_28679" data-name="Path 28679" d="M2740.95,1201.577v44.331l-8.251,4.884V1206.46Z" transform="translate(-2710.715 -1165.676)" fill="url(#linear-gradient-34)" />
						<path id="Path_28680" data-name="Path 28680" d="M2660.633,1164.076l8.459-4.884,8.252,4.884-8.252,4.884Z" transform="translate(-2660.633 -1136.22)" fill="#516cd3" />
						<path id="Path_28681" data-name="Path 28681" d="M2660.633,1175.2v60.386l8.459,4.62v-60.122Z" transform="translate(-2660.633 -1147.348)" fill="#2647c8" />
						<path id="Path_28682" data-name="Path 28682" d="M2696.616,1175.2v60.122l-8.252,4.884v-60.122Z" transform="translate(-2679.905 -1147.348)" fill="#3c59cd" />
					</g>
				</g>
			</g>
		</svg>
	</div>	
		
        </div>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <!-- about-section" -->
  <section class="about-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="title-section text-center">
            <h2 class="title"> <?php echo $about[4]->$Page_title;?></h2>
            <p class="info">
              <?php echo $about[4]->$lang_content; ?>
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
              <p class="number"> +<span class="count"><?=$no?></span></p>
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
              <p class="number"> +<span class="count"><?=$no?></span></p>
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
              <p class="number"> +<span class="count"><?=$no?></span></p>
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
              <p class="number"> +<span class="count"><?=$no?></span></p>
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
              <p class="number"> +<span class="count"><?=$no?></span></p>
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

      <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
          <a href="<?=base_url('aboutus')?>" class="btn" title="<?=getSystemString('view_dnet_portfolio')?>"><?=getSystemString('know_more')?> </a>
        </div>
      </div>
    </div>
  </section>
  <!-- End about-section -->
  <!-- tech-section" -->
  <?php if($solutions) { ?>
  <section class="tech-section">
    <div class="container">
      <div class="row justify-content-center tech-boxs">
        <div class="col-lg-4 col-md-12">
          <div class="title-section text-center text-white d-flex justify-content-center align-items-center h-100">
            <div class="title-section-content">
              <h2 class="title"><?=getSystemString('solutions')?> </h2>
              <p class="info"><?=getSystemString('solutions_note')?></p>
            </div>
          </div>
        </div>
        <?php
          foreach ($solutions as $solution) {
            $title = 'Title_'.$__lang;
            $svg_file = file_get_contents(dirname(__DIR__, 4). '/content/solutions/'.$solution->Icon);
            $out = strip_tags($solution->$lang_content);

            $url = base_url('solutions/'.$solution->ID);
        ?>
        <div class="col-lg-4 col-md-6">
          <a href="<?=$url?>" class="tech-box" title="<?php echo mb_strimwidth($out, 0, 50, "...", "utf-8"); ?>">
          <div class="pic">
			  	<div style='width:100%; height:100%;' >
                	<?=$svg_file?>
				  </div>
              </div>
            <div class="content">
              <h3 class="title"><?=$solution->$title?></h3>
              <p class="info"><?php echo mb_strimwidth($out, 0, 170, "...", "utf-8"); ?></p>
              <div class="arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>


      </div>
    </div>
  </section>
  <?php } ?>
  <!-- End tech-section -->
  <!-- portfolio-section" -->
  <?php if($portfolio) { ?>
  <section class="portfolio-section">
    <div class="container mb-5">
      <div class="row justify-content-center tech-boxs">
        <div class="col-lg-4 col-md-12">
          <div class="title-section text-center">
            <h2 class="title text-primary"> <?=getSystemString('Portfolios')?> </h2>
            <p class="info"><?=getSystemString('Portfolios_note')?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="owl-carousel owl-theme" id="owl-portfolio">
        <?php
          foreach($portfolio as $row):
            $text = $row->$title;
            $url = $row->Link;
            $img = base_url('content/work/'.$row->Thumbnail);
        ?>
        <div class="portfolio-box">
          <img src="<?=$img?>" alt="<?=$text?>">
          <h3 class="title"><?=$text?></h3>
          <p class="view d-none"> <?=getSystemString(324)?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left arrow ml-3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php } ?>
  <!-- End portfolio-section -->
  <!-- partner-section" -->
  <?php if($clients) { ?>
  <section class="portfolio-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
          <div class="title-section text-center">
            <h2 class="title text-primary"> <?=getSystemString(445)?> </h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <?php
        foreach ($clients as $value) {
          $title = 'Title_'.$__lang;
          $img = base_url('content/clients/'.$value->Picture);
          $link = $value->Client_Link;
          if($link){
            $url = $link;
            $target = 'target="_blank"';
          }
        ?>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="<?php if($link){echo $url;}else{echo'#!';}?>" <?=$target?> class="partner-box" title="<?=$value->$title?>" data-toggle="tooltip">
            <img src="<?=$img?>" alt="<?=$value->$title?>">
          </a>
        </div>
        <?php } ?>
    </div>
    <div class="row justify-content-center mt-5 pt-5 align-items-center">
      <div class="col-lg-4 col-sm-12 col-6 col-sm-mb-5">
        <a href="https://www.citc.gov.sa/ar/Pages/default.aspx" target="_blank" class="banner-box text-center" title="" data-toggle="tooltip">
          <img src="<?=base_url('style/site/assets/images/citc_logo.svg')?>" class="img-fluid" alt="banner-box">
        </a>
      </div>
      <div class="col-lg-3 col-sm-12 col-6">
        <a href="https://cloud.google.com" target="_blank" class="banner-box" title="" data-toggle="tooltip">
          <img src="<?=base_url('style/site/dnet/assets/img/google.png')?>" class="img-fluid" alt="banner-box">
        </a>
      </div>
    </div>
  </section>
  <?php } ?>
  <!-- End partner-section -->
  <!-- support-section -->
  <section class="support-section pb-0">
    <div class="container">
      <div class="row justify-content-center mt-5 pt-5 align-items-center">
        <div class="col-lg-12">
          <div class="support-box text-center text-lg-left">
            <h2 class="title"><?=getSystemString('support_24H')?></h2>
            <p class="info"><?=getSystemString('support_24H_note')?></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-between">
        <div class="col-lg-5 col-md-6 col-sm-12">
          <a href="tel:<?=$settings['web_settings'][0]->Website_MobileNo?>" class="support-label">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/phone.svg')?>" alt="phone">
            </div>
            <p class="title" dir="ltr"><?=$settings['web_settings'][0]->Website_MobileNo?></p>
          </a>
          <a href="mailto:<?=$settings['web_settings'][0]->Website_Email?>" class="support-label">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/mail.svg')?>" alt="phone">
            </div>
            <p class="title" dir="ltr"><?=$settings['web_settings'][0]->Website_Email?></p>
          </a>
          <a href="<?=base_url('cu/support/new_ticket')?>" class="support-label">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/ticket.svg')?>" alt="phone">
            </div>
            <p class="title"><?=getSystemString('support_24H_create_ticket')?></p>
          </a>
        </div>
        <div class="col-md-6">
          <img src="<?=base_url('style/site/dnet/assets/img/support.svg')?>" class="img-fluid support-pic" alt="support-box">
        </div>
      </div>
    </div>
  </section>
  <!-- End support-section -->
<?PHP
  $this->load->view('includes/footer', $website_config);
  $this->load->view('includes/analytics');
?>
<script>

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
	
	$(document).ready(function(){
		$('body').removeClass('inner-page');
	});
	$(function() {
      
	    var current = location.pathname;
	    //console.log(current)
	    $('#nav li a').each(function(){
	        var $this = $(this);
	        // if the current path is like this link, make it active
	        if($this.attr('href').indexOf(current) !== -1){
		        $('#nav .actives').addClass('active');
	            $this.removeClass('active');
	        }
	    })
	})
</script>
