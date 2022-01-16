<?PHP
	$this->load->view('site/includes/email/header');
	
	$__lang_h = $this->session->userdata($this->site_session->__lang_h());
	$subcategory = 'SubCategory_'.$__lang_h;
?>

<table width="100%" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td style="width:100%;margin:0;padding:0;background-color:#f2f4f6" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                
                <tbody><tr>
                    <td style="padding:25px 0;text-align:center">
                            <span style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;font-weight:bold;color:#2f3133;text-decoration:none">
							<?=getSystemString(348)?> <h3 style="color:#3498db">#<?=$order_id?></h3>
                            </span>
                    </td>
                </tr>

                
                <tr>
                    <td style="width:100%;margin:0;padding:0;border-top:1px solid #edeff2;border-bottom:1px solid #edeff2;background-color:#fff" width="100%">
                        <table style="width:auto;min-width:800px;margin:0 auto;padding:0" align="center" width="800" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;padding:35px">
	                                
	                                <table style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;margin:30px 0" width="100%" cellpadding="0" cellspacing="0">
			                            <tbody>
											<tr>
												<th style="padding-bottom: 20px"><?=getSystemString(14)?> </th>
												<th style="padding-bottom: 20px"><?=getSystemString(366)?></th>
												<th style="padding-bottom: 20px"><?=getSystemString(464)?></th>
												<th style="padding-bottom: 20px"><?=getSystemString(327)?> </th>
												<th style="padding-bottom: 20px"><?=getSystemString(343)?> </th>
											</tr>
											
											<?PHP
												$i=1;
												$j=0;
												foreach($this->cart->contents() as $item):
													$options = $item['options'];
											?>
												<tr>
													<td style="text-align:center;padding-bottom:20px">
														<img src="<?=base_url($GLOBALS['img_product_dir'].$options['img'])?>"/>
													</td>
													<td style="text-align:center;padding-bottom:20px">
														<?=$item['name']?>
													</td>
													<td style="text-align:center;padding-bottom:20px">
														<?=$item['qty']?>
													</td>
													<td style="text-align:center;padding-bottom:20px">
														<?=$this->cart->format_number($item['price'])?>
													</td>
													<td style="text-align:center;padding-bottom:20px">
														<?=$this->cart->format_number($item['subtotal'])?>
													</td>
												</tr>
											<?PHP
												$i++;
												$j++;
												endforeach;
											?>
											
											<tr>
												<td colspan="4" style="text-align: left !important; padding-left:20px !important; padding-top: 20px !important;">
						                        	<table style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;padding:0px 30px" width="100%" cellpadding="0" cellspacing="0">
														<tr>
															<td style="text-align:right;">
																<?=getSystemString(574)?>
															</td>
															<td style="text-align:right;">  = </td>
															<td style="text-align:right;width: 130px">
																<h4>
																	<?=$this->cart->format_number($this->cart->total())?>
																</h4>
															</td>
														</tr>

														<tr>
															<td style="text-align:right;">
																<?=getSystemString(574)?>
															</td>
															<td style="text-align:right;">  = </td>
															<td style="text-align:right;width: 130px">
																<h4>
																	<?=$this->cart->format_number($this->cart->total())?>
																</h4>
															</td>
														</tr>
													</table>
												</td>
											</tr>
			                            </tbody>
			                        </table>

                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>

            </tbody></table>
        </td>
    </tr>
</tbody></table>

<?PHP
	$this->load->view('site/includes/email/footer');
?>