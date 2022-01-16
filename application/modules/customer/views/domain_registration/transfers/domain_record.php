

            <div class="row align-items-end mb-2">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="" class="text-bold"> <?= getSystemString('domain') ?> </label>


                        <input placeholder="example.sa" required class="form-control domain_name" type="text" id="domain_name" name="domain_name[]" data-parsley-pattern="(([a-zA-Zء-ي0-9\-\.])+)" onkeyup="return forceLower(this);" data-parsley-required-message="<?=getSystemString('required')?>" data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500">


                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="" class="text-bold"><?= getSystemString('auth_code') ?> </label>


                       <input required  class="form-control auth_code" name="auth_code[]" type="text" id="auth_code" placeholder="lkd!s@saSJK43434"  data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500" >

                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group"> 
                    <a href="#!" class="text-muted btn-light btn-trash mr-3" data-toggle="tooltip" title="حذف النطاق" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></a>

                    <label class="text-danger" style="display:none;" data-toggle="tooltip" title=" بيانات غير صحيحة"> 
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg> 
                    </label>
                    
                    <label class="text-success" style="display:none;" data-toggle="tooltip" title=" بيانات صحيحة"> 
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                      </svg>
                    </label>
                   <label class=" transfer_inside_msg"></label>                                      
                  </div>
                </div>
              </div>

