

<?php 
$__lang = $this->session->userdata($this->site_session->__lang_h());
    $item_name = 'Title_'.$__lang;
 ?>




 <?php foreach ($items as $item) { ?>
            <tr>
                    <td>
                      <div class="product-pic">
                        <img style="width: 80px; height: 80px;" src="<?= $item->Thumbnail; ?>" alt="user">
                      </div>
                    </td>
                    <td>
                      <h6><?= $item->$item_name; ?></h6>
                    </td>
                    <td>
                      <h6>‏&nbsp;&nbsp;</h6>
                    </td> 
                    <td>
                      <p>&nbsp;&nbsp;</p>
                    </td>
                    <td>

                      <a data-dcip='<?= $dcip ?>' data-old-item="<?= $item_id ?>" data-item='<?= $item->Item_ID ?>' data-diet='<?= $diet_id ?>' data-weeks="<?= $week_id ?>"  data-days="<?= $day_id ?>" data-periods="<?= $period_id ?>" data-types="<?= $type_id ?>" data-keto-week="<?= $keto_week ?>"  class="btn btn-primary add-product" ><i class="fas fa-exchange-alt"></i></a> 
                    </td>
                  </tr> 

      <?php } ?>