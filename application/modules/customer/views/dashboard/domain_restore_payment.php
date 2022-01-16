


<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>

<!-- Header -->
  <header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

</style>
    <div class="container dashboard">
        <div class="form-container p-lg-5 p-3">


            <div class="col-md-10 mx-auto">

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain">
                        <div class="stepper">
                            <h3 class="color-primary py-4 pb-5 mb-5 14em">
                                  <?= getSystemString('restore_domain') ?>  <?= $domain->Domain_Name.$domain->TLD ?>
                            </h3>

                  


                            <div class="row">
                <div class="col-lg-8">
                  <div class="card border-0">
                    <div class="form-group row">
                      <div class="col-12">
                        <h5 class="title mb-4"><b> <?= getSystemString('choose_payment_method'); ?> </b></h5>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-12">
                        <div class="payment-way-box ">
                          <input type="radio" id="payment-1" class="input-hidden payment_type" name="payment-method" value="MADA" checked data-parsley-required-message="<?=getSystemString('required')?>" autocomplete="off">
                          <label for="payment-1" class="payment-way active">
                            <svg id="Mada_-_Logo" data-name="Mada - Logo" xmlns="http://www.w3.org/2000/svg" width="75" height="25.011" viewBox="0 0 75 25.011">
                              <path id="Union_32" data-name="Union 32" d="M54.418,24.6l-.227-.038-.038-.01-.036.01a9.711,9.711,0,0,1-2.092.284c-1.895,0-3.015-.926-3.015-2.461,0-1.8,1.224-2.637,3.854-2.637h1.441v-.488c0-1.121-1.037-1.121-1.376-1.121a9.123,9.123,0,0,0-2.572.432l-.771.255-.266-1.79.793-.236a10.385,10.385,0,0,1,3.145-.545c2.261,0,3.41.959,3.4,2.882v5.879C55.916,24.858,55.164,24.728,54.418,24.6Zm-2.985-2.318c0,.612.434.971,1.157.971a4.8,4.8,0,0,0,1.14-.178l.473-.123.132-.038-.01-1.7H52.79C51.611,21.212,51.433,21.882,51.433,22.277ZM72.72,24.6l-.234-.038-.039-.01-.038.01a9.7,9.7,0,0,1-2.092.284c-1.882,0-3-.926-3-2.461,0-1.8,1.214-2.637,3.841-2.637H72.6v-.488c0-1.121-1.037-1.121-1.374-1.121a9.109,9.109,0,0,0-2.571.432l-.773.255-.263-1.79.791-.236a10.443,10.443,0,0,1,3.147-.545c2.261,0,3.408.969,3.408,2.873V25C74.219,24.858,73.455,24.728,72.72,24.6Zm-2.986-2.318c0,.612.434.971,1.159.971a4.9,4.9,0,0,0,1.14-.178l.47-.123.133-.038v-1.7H71.1C69.912,21.212,69.734,21.882,69.734,22.277ZM0,24.991V14.421H31.727v10.57Zm58.017-4.4c0-1.96.651-4.3,3.738-4.3a5.218,5.218,0,0,1,1.405.246l.064.02.227.064V12.934l.255-.048c.742-.12,1.506-.253,2.241-.385V23.1a1.216,1.216,0,0,1-1.036,1.337,8.319,8.319,0,0,1-2.759.387C59.523,24.82,58.017,23.277,58.017,20.593Zm2.458-.01c0,2,.979,2.42,1.808,2.42a4.621,4.621,0,0,0,1.026-.13l.142-.029v-4.4l-.123-.039A4.5,4.5,0,0,0,62.2,18.19h-.009C60.644,18.19,60.475,19.557,60.475,20.583ZM45.2,24.746V19.434a1,1,0,0,0-1.092-1.14,2.975,2.975,0,0,0-1.224.253l-.171.075.084.161a1.763,1.763,0,0,1,.078.547v5.416H40.4V19.434c0-.755-.366-1.14-1.092-1.14a3.136,3.136,0,0,0-1.1.2l-.123.035v6.208H35.578V18.019c0-.723.311-1.11,1.113-1.354a9.286,9.286,0,0,1,2.7-.408,3.861,3.861,0,0,1,2.29.557l.084.068.094-.049a6.394,6.394,0,0,1,2.555-.565c2.184,0,3.239.951,3.239,2.92v5.559ZM0,10.58V0H31.727V10.58Zm49.558-.736H46.09l-4.2-.009H39.6c-2.345,0-3.964-1.31-4.022-4.052V4.56C35.636,1.819,37.255.245,39.6.245h3.138c-.094.66-.159,1.1-.263,1.8h-2.3c-1.385,0-2.036,1.018-2.036,2.655V5.783c0,1.574.839,2.254,2.036,2.254h1.413l7.752.017h.4A1.183,1.183,0,0,0,51.1,6.839a1.143,1.143,0,0,0-1.16-1.176H47.524c-1.884,0-3.005-.923-3.005-2.694C44.519,1.179,45.808.1,48.37.1h5.5c-.1.689-.162,1.123-.273,1.81H48.3c-1.188,0-1.366.584-1.366,1.056A1.043,1.043,0,0,0,48.1,4.08h2.42a2.751,2.751,0,0,1,3.005,2.759c0,2.138-1.224,3-3.852,3ZM68.134,8.515c-.415.066-.9.145-1.311.229H54.72c.1-.65.2-1.3.273-1.8H58.93a1.673,1.673,0,0,1,.537.076l.159.083V4.485C59.626,2.921,59,1.9,57.8,1.9H55.521c.093-.669.168-1.14.263-1.81h2.289c2.347,0,3.966,1.509,4.022,4.249h.01v2.6h4.55l.084-.158a1.123,1.123,0,0,0,.075-.473V2.571a2.371,2.371,0,0,1,.453-1.4C67.794.395,69.273,0,70.715,0h.065A4.156,4.156,0,0,1,75,4.5a4.133,4.133,0,0,1-4.333,4.475A6.787,6.787,0,0,1,68.134,8.515Zm1.46-6.28a.268.268,0,0,0-.067.019c-.056.017-.113.036-.168.056l-.029.019c-.046.021-.084.029-.123.047l-.159.067.075.148a1.726,1.726,0,0,1,.068.52V6.735l.14.029a8.462,8.462,0,0,0,1.46.13c.819,0,1.808-.422,1.817-2.419,0-1.027-.178-2.394-1.713-2.394h-.009A5.8,5.8,0,0,0,69.594,2.234Z"></path>
                            </svg>
                          </label>

                          <input type="radio"  id="payment-2" class="input-hidden" name="payment-method" value="MASTER" autocomplete="off">
                          <label for="payment-2" class="payment-way">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40.238" viewBox="0 0 50 40.238">
                              <g id="mastercard" transform="translate(49.999 56248.238)">
                                <path id="Shape" d="M46.2,5.73a.4.4,0,0,1,0-.319.428.428,0,0,1,.091-.128.379.379,0,0,1,.133-.086.43.43,0,0,1,.159-.031h0a.443.443,0,0,1,.165.031.433.433,0,0,1,.134.086.439.439,0,0,1,.09.128.413.413,0,0,1,0,.319.423.423,0,0,1-.09.129.418.418,0,0,1-.134.086.409.409,0,0,1-.163.034A.431.431,0,0,1,46.2,5.73Zm.263-.43a.291.291,0,0,0-.1.069.316.316,0,0,0,0,.43.324.324,0,0,0,.1.07.316.316,0,0,0,.122.025h0a.04.04,0,0,1,.017,0,.276.276,0,0,0,.109-.023.337.337,0,0,0,.1-.07.321.321,0,0,0,0-.43.314.314,0,0,0-.224-.095A.33.33,0,0,0,46.461,5.3Zm-27.5.585c-1.059,0-1.428-.568-1.428-1.523V2.469H16.7V1.652h.817V.405h.9V1.652H19.89l.008.817H18.436V4.345c0,.413.163.689.593.689a1.657,1.657,0,0,0,.792-.233l.257.766a2.1,2.1,0,0,1-1.112.319Zm-6.539-.551.43-.7a2.184,2.184,0,0,0,1.368.431c.611,0,.938-.181.938-.5,0-.232-.232-.361-.722-.43L14,4.078c-.921-.129-1.42-.542-1.42-1.213,0-.818.68-1.317,1.721-1.317a3.082,3.082,0,0,1,1.678.43l-.4.724A2.647,2.647,0,0,0,14.3,2.349c-.491,0-.784.206-.784.482s.31.352.7.4l.43.06c.9.129,1.438.448,1.438,1.23S15.389,5.868,14.2,5.868h-.083A2.968,2.968,0,0,1,12.421,5.335Zm10.312.516H22.7A2.15,2.15,0,0,1,21.162,2.2a2.135,2.135,0,0,1,1.511-.651l.013.008a1.949,1.949,0,0,1,1.953,2.152v.345H21.585a1.14,1.14,0,0,0,1.133,1.01c.032,0,.065,0,.1,0a1.978,1.978,0,0,0,1.2-.431l.43.663a2.507,2.507,0,0,1-1.577.563C22.82,5.855,22.777,5.852,22.733,5.851Zm-1.17-2.5h2.151a1.019,1.019,0,0,0-1.017-1H22.62A1.06,1.06,0,0,0,21.563,3.348ZM29.043,5.26A2.078,2.078,0,0,1,28.421,3.7V3.683a2.078,2.078,0,0,1,2.194-2.152,2.151,2.151,0,0,1,1.48.491l-.431.722a1.809,1.809,0,0,0-1.075-.371,1.321,1.321,0,0,0,0,2.634,1.8,1.8,0,0,0,1.075-.371l.431.724a2.156,2.156,0,0,1-1.48.49q-.059,0-.118,0A2.078,2.078,0,0,1,29.043,5.26Zm13.9.591a2.151,2.151,0,0,1,0-4.3H43a1.571,1.571,0,0,1,1.232.6V0h.861V5.748h-.861v-.5a1.568,1.568,0,0,1-1.232.6ZM41.784,3.709A1.237,1.237,0,0,0,43.02,5.026h.012a1.244,1.244,0,0,0,.039-2.487h-.046A1.247,1.247,0,0,0,41.784,3.709ZM34.616,5.851a2.151,2.151,0,0,1,0-4.3h.059a1.573,1.573,0,0,1,1.233.6v-.5h.9v4.1h-.9v-.5a1.568,1.568,0,0,1-1.232.6ZM33.473,3.7A1.231,1.231,0,0,0,34.7,5.016h.017a1.249,1.249,0,0,0,1.237-1.223,1.236,1.236,0,0,0-1.2-1.262h-.046A1.244,1.244,0,0,0,33.473,3.7ZM9.384,5.851a2.151,2.151,0,0,1,0-4.3h.058a1.573,1.573,0,0,1,1.233.6v-.5h.9v4.1h-.9v-.5a1.573,1.573,0,0,1-1.233.6ZM8.569,4.643a1.241,1.241,0,0,0,.9.383h.021a1.244,1.244,0,0,0,.04-2.487H9.481A1.243,1.243,0,0,0,8.24,3.709H8.23A1.24,1.24,0,0,0,8.569,4.643Zm-2.95-1.15c0-.7-.293-1.084-.9-1.084A.967.967,0,0,0,3.709,3.5V5.783h-.9V3.493c0-.7-.3-1.084-.9-1.084A.964.964,0,0,0,.9,3.5V5.765H0V1.652H.9V2.16a1.357,1.357,0,0,1,1.2-.611,1.51,1.51,0,0,1,1.359.732,1.593,1.593,0,0,1,1.446-.732A1.531,1.531,0,0,1,6.523,3.183V5.765l-.9.018ZM46.667,5.765l-.116-.142h-.039v.142h-.082V5.387l.181,0a.173.173,0,0,1,.111.034.107.107,0,0,1,.039.09.1.1,0,0,1-.031.078.15.15,0,0,1-.09.038l.124.142Zm-8.686,0V1.652h.886v.5a1.213,1.213,0,0,1,1.085-.6l-.018-.018a1.92,1.92,0,0,1,.637.113L40.3,2.5a1.476,1.476,0,0,0-.559-.1c-.568,0-.861.379-.861,1.059V5.765Zm-12.429,0V1.652h.886v.5a1.213,1.213,0,0,1,1.085-.6L27.5,1.531a1.92,1.92,0,0,1,.637.113l-.276.86a1.477,1.477,0,0,0-.559-.1c-.568,0-.861.379-.861,1.059V5.765Z" transform="translate(-47.461 -56213.98)"></path>
                                <path id="mastercard-2" data-name="mastercard" d="M33.92,0A15.989,15.989,0,0,0,25,2.707a16.077,16.077,0,1,0-8.92,29.45A15.989,15.989,0,0,0,25,29.45,16.077,16.077,0,1,0,33.92,0ZM16.08,29.227A13.149,13.149,0,1,1,22.605,4.665a16.05,16.05,0,0,0,0,22.826,13.072,13.072,0,0,1-6.525,1.736ZM29.23,16.079A13.114,13.114,0,0,1,25,25.73a13.225,13.225,0,0,1-2.366-2.911h1.69a1.465,1.465,0,0,0,0-2.93h-2.99a13.086,13.086,0,0,1-.416-1.837h5.75a1.465,1.465,0,1,0,0-2.93H20.8a13.065,13.065,0,0,1,.265-1.837h3.255a1.465,1.465,0,0,0,0-2.93H22.081A13.222,13.222,0,0,1,25,6.426a13.116,13.116,0,0,1,4.231,9.652ZM33.92,29.227a13.072,13.072,0,0,1-6.525-1.736,16.05,16.05,0,0,0,0-22.826A13.148,13.148,0,1,1,33.92,29.228Zm0,0" transform="translate(-49.999 -56248.238)"></path>
                              </g>
                            </svg>
                          </label>
                          <input type="radio" id="payment-3"  name="payment-method" value="VISA" class="input-hidden" autocomplete="off">
                          <label for="payment-3" class="payment-way">
                            <svg xmlns="http://www.w3.org/2000/svg" width="74.997" height="23.571" viewBox="0 0 74.997 23.571">
                              <g id="visa_-_Logo" data-name="visa - Logo" transform="translate(74.377 56196.559)">
                                <path id="Path_10658" data-name="Path 10658" d="M3.812,0,0,22.837H6.1L9.911,0Z" transform="translate(-48.159 -56196.164)"></path>
                                <path id="Path_10659" data-name="Path 10659" d="M15.052,0,9.081,15.579l-.637-2.352C7.267,10.394,3.924,6.325,0,3.76L5.459,22.8l6.45-.011L21.51,0Z" transform="translate(-68.323 -56196.145)"></path>
                                <path id="Path_10660" data-name="Path 10660" d="M12.186,1.855A2.456,2.456,0,0,0,9.53,0H.078L0,.455C7.355,2.276,12.222,6.666,14.241,11.943Z" transform="translate(-74.377 -56196.359)"></path>
                                <path id="Path_10661" data-name="Path 10661" d="M12.355,4.77a11.054,11.054,0,0,1,4.563.874l.55.264.825-4.95A15.448,15.448,0,0,0,12.832,0C6.808,0,2.562,3.1,2.529,7.536c-.039,3.28,3.025,5.111,5.339,6.2,2.375,1.121,3.172,1.833,3.161,2.833C11.01,18.1,9.135,18.8,7.383,18.8a12.573,12.573,0,0,1-5.74-1.2l-.786-.365L0,22.355a18.955,18.955,0,0,0,6.792,1.217c6.408,0,10.572-3.061,10.616-7.8.027-2.595-1.6-4.575-5.122-6.2C10.154,8.508,8.849,7.8,8.862,6.734,8.862,5.785,9.969,4.77,12.355,4.77Z" transform="translate(-38.253 -56196.559)"></path>
                                <path id="Path_10662" data-name="Path 10662" d="M16.955,0h-4.71A3.025,3.025,0,0,0,9.052,1.9L0,22.824H6.4s1.044-2.814,1.281-3.43c.7,0,6.921.01,7.807.01.182.8.743,3.421.743,3.421h5.655ZM9.437,14.719c.5-1.311,2.429-6.382,2.429-6.382-.033.062.5-1.321.812-2.18l.411,1.969L14.5,14.719Z" transform="translate(-21.268 -56196.141)"></path>
                              </g>
                            </svg>
                          </label>
                          <input type="radio" id="payment-4"  name="payment-method" value="AMEX" class="input-hidden" autocomplete="off">
                          <label for="payment-4" class="payment-way">
                          <svg version="1.1" id="Layer_1" width="50"  xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 700 700" style="enable-background:new 0 0 700 700;" xml:space="preserve">
                        <style type="text/css">
                          .st0{fill:#FFFFFF;}
                          .st1{fill:#006FCF;}
                        </style>
                        <switch>
                          <g i:extraneous="self">
                            <path class="st1" d="M599,601v-79.2270508h-60.3209229l-31.0560913-34.3399658l-31.2129517,34.3399658H277.5270386V361.7269897
                              h-64.1910248l79.621994-180.1929932h76.7879639l27.4110718,61.7310181v-61.7310181h95.0489502l16.5030518,46.5180054
                              l16.6109619-46.5180054H599V101H99v500H599L599,601z M548.8400269,501.7349854H599l-66.3530273-70.3639832L599,361.8070068
                              h-49.3619995l-40.9769897,44.7779846l-40.5830078-44.7779846h-50.1719971l65.9650269,69.9639893l-65.9650269,69.9639893h48.776001
                              l41.1779785-45.1769409L548.8400269,501.7349854L548.8400269,501.7349854z M560.5750122,431.4299927L599,472.3089905v-81.4169922
                              L560.5750122,431.4299927L560.5750122,431.4299927z M336.947998,469.3519897v-21.789978h78.9570312v-31.5840454H336.947998
                              v-21.7869568h80.9550171v-32.3840027H298.7659912v139.9279785h119.1370239v-32.3829956H336.947998L336.947998,469.3519897z
                              M561.2180176,341.5010071H599V201.572998h-58.7709961l-31.3850098,87.1530151l-31.1829834-87.1530151h-59.7680054v139.928009
                              h37.7789917V243.552002l35.9829712,97.9490051h33.5809937l35.9820557-98.151001V341.5010071L561.2180176,341.5010071z
                              M374.9150391,341.5010071h42.9779663l-61.7650146-139.928009h-49.1759644l-61.7710114,139.928009h41.9790192
                              l11.5959473-27.9850159h64.3650513L374.9150391,341.5010071L374.9150391,341.5010071z M349.9299927,282.131012h-37.9829712
                              l18.9920044-45.7760315L349.9299927,282.131012L349.9299927,282.131012z"></path>
                          </g>
                        </switch>
                        </svg>                         
                        </label>
                    <input type="radio" id="payment-5"  name="payment-method" value="WALLET" class="input-hidden" autocomplete="off">
                          <label for="payment-5" class="payment-way flex-column">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                              <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"></path>
                            </svg>
                            <span class="d-block">المحفظة </span>
                          </label>
                        </div>
                      </div>
                    </div>

<div class="payment_panel">

              <form action="<?=base_url("restore_payment_success")?>" class="paymentWidgets" data-brands="MADA"></form>
                     <?php if(ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } ?></script>
</div>


       


                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="card mb-4">
                    <div class="card-body p-4">
                      <div class="">
                        <h5 class="title mb-4"><b> <?= getSystemString('financial_details_for_domain_renewal') ?></b></h5>
                      </div>
                      <div class="details-table">
                        <table class="table table-responsive table-course">
                          <tbody>

                          <tr>
                            <td class="border-top-0" scope="row"><?= getSystemString('domain_duration') ?></td>
                            <td class="border-top-0 text-right"><?= $period.' '.getSystemString('years') ?></td>
                          </tr>

                            <tr>
                            <td class="border-top-0" scope="row"><?= getSystemString('domain_price') ?></td>
                            <td class="border-top-0 text-right"><?= $renew_price.' '.getSystemString(480) ?></td>
                            </tr>
                            <tr>
                              <td scope="row"><?= getSystemString('VAT TAX')?> (<?= $vat ?>٪)</td>
                              <td class="text-right"><?= $total_vat.' '.getSystemString(480) ?></td>
                            </tr>
                            <tr>
                              <th scope="row"><?= getSystemString(357) ?></th>
                              <th class="text-right"><?= $total_price.' '.getSystemString(480)  ?></th>
                            </tr>
                          </tbody>

                        </table>
                      </div>
                    </div>
                  </div>
                    <span style="color:#b6bbc5"><?= getSystemString('vat').' '.getSystemString('vat_num') ?></span>
                           
                </div>
                          
              </div>


                        </div>
                    </div>
                </div>
            </div>


        </div><!-- /.container -->
    </div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->
 <?=   $this->load->view('site/includes/support', $website_config); ?>

    <?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script type="text/javascript">

    $(document).ready(function (){
      $(".select2").select2({ });
});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }

  $(function()
  {

           $('input:radio[name="payment-method"]').change(function(e) {
          e.preventDefault();

             $('.payment_panel').empty();  

        var data = {
            cart_type: $(this).val(),
            domain_id:'<?= encryptIt($domain->Domain_ID) ?>',
            token:'<?= $token ?>',
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
        };


                     $.ajax({
                            url: "<?php echo base_url('payment_methods_restore');?>",
                            type: "POST",
                            data: data,
                            dataType : 'html',
                             async:false,
                            error:function(request,response)
                            {
                                console.log(request);
                            },
                                   success: function(result)
                            {

                             result = JSON.parse(result);


                        if(result.status === true){
                             $('.payment_panel').html(result.hayperPay_panel);
                          }else{
                               $('.msg').css('display','block');

                          }

                            }
                          });

                  });

            });


</script>
