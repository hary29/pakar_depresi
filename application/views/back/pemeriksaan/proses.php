
<!-- Page wrapper  -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>asset/back/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
$(document).on('click', '#tess',function(e){
		alert();
});
</script>
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 col-8 align-self-center">
				<h3 class="text-themecolor">Proses Perhitungan</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Detail Proses</a></li>
					<!-- <li class="breadcrumb-item active">Semua Data Pemeriksaan</li> -->
				</ol>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
			<!-- column -->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-block">
						<head>
							<style type='text/css'>
								* {font-family:verdana,arial,sans-serif;font-size:10pt;}
								h1{font-size:18pt;}
								h2{font-size:14pt;line-height:16pt;}
								fieldset{margin:5px;padding:5px;background-color:#eee;}
								legend {font-weight:bold;padding:5px;background-color:#ee9;}
								.inptxt{text-align:right;}
							</style>
						</head>
							<body>
								<div id='container'>
									<h1>Metode Tsukamoto</h1>
									<fieldset style='display:none'>
									<legend>Kasus</legend>
										<!-- reserved //-->
									</fieldset>
									<form method='post'>
									<fieldset>
									  <legend>Batasan</legend>
									  <table>
										<tr><th>Variabel</th><th>Minimum</th><th>Ringan</th><th>Sedang</th><th>Maximal</th></tr>
										<?php 
										$i = 0;
										$depmin = 0;
										$depmax = 0;
										$char = 'a';
										foreach ($batas as $key => $value) { 
											$mn[$char] = $value['bts_ats'];
											$rin[$char] = $value['bts_ats']/3;
											$sed[$char] = $value['bts_ats']/2;
										?>
										<tr>
										  	<td><?php echo $value['faktor'] ?></td>
										  	<td><input type='text' class='inptxt' name="min<?php echo $i; ?>" value='<?php echo $value['bts_bwh']; ?>' disabled="disabled"/></td>
										  	<td><input type='text' class='inptxt' name="rin<?php echo $i; ?>" value='<?php echo $rin[$char]; ?>' disabled="disabled"/></td>
										  	<td><input type='text' class='inptxt' name="rin<?php echo $i; ?>" value='<?php echo $sed[$char]; ?>' disabled="disabled"/></td>
										  	<td><input type='text' class='inptxt' name="max<?php echo $i; ?>" value='<?php echo $value['bts_ats']; ?>' disabled="disabled"/></td>
										</tr>
										<?php
										$depmin = $depmin+$value['bts_bwh'];
										$depmax = $depmax+$value['bts_ats'];
										
										$char++;
										$i++;
										// print_r($mn);
										// print_r($rin);
										// print_r($sed);
										 } //print_r($rin);?>

										<!-- <tr>
										  	<td>Depresi</td>
										  	<td><input type='text' class='inptxt' name='dep_min' value='<?php echo $depmin; ?>' disabled="disabled"/></td>
										  	<td><input type='text' class='inptxt' name='dep_max' value='<?php echo $depmax; ?>' disabled="disabled"/></td>
										</tr> -->
									  </table>
									</fieldset>
									<fieldset>
										<legend>Klasifikasi Depresi</legend>
										<table>
										<tr><th>nama</th><th>Batas bawah</th><th>Batas atas</th></tr>
										<?php foreach ($classdep as $key => $value) { ?>
										<tr>
										  	<td><?php echo $value['nama'] ?></td>
										  	<td><input type='text' class='inptxt' name="min<?php echo $i; ?>" value='<?php echo $value['nilai_klasifikasi_bawah']; ?>' disabled="disabled"/></td>
										  	<td><input type='text' class='inptxt' name="max<?php echo $i; ?>" value='<?php echo $value['nilai_klasifikasi_atas']; ?>' disabled="disabled"/></td>
										</tr>
										<?php } ?>
										</table>
									</fieldset>
									<fieldset>
									  <legend>Inputan</legend>
									  <table>
									  	<?php foreach ($input as $key => $value) { ?>
									  	<tr>
										  <td><?php echo $value['faktor']; ?></td>
										  <td><input type='text' class='inptxt' name='x' value='<?php echo $value['total'];?>' disabled="disabled" /></td>
										</tr>
										<?php
									  	} ?>
										
										<!-- <tr>
										  <td>kelistrikan (y)</td>
										  <td><input type='text' class='inptxt' name='y' value='<?=$y?>' /></td>
										</tr> -->
									  </table>
									</fieldset>
									<!-- <input type='submit' name='proses' value='proses' /> -->
									</form>
									<?php
									//if(isset($_POST['proses'])){
									?>        
									<fieldset>
									<legend>[1] Pembentukan Himpunan Fuzzy (Fuzzyfication)</legend>
									<table border='1'>
										<?php 
										$i=1;
										$char ='a';
										foreach ($batas as $key => $value) { ?>
										<?php
											$bts_ats = $value['bts_ats'];
											$bts_bwh = $value['bts_bwh'];
											$kr = $bts_ats - $bts_bwh;
											$rin = number_format($value['bts_ats']/3, 2);
											$sed = number_format($value['bts_ats']/2, 2); ?>
										  <tr>
											<th colspan='8'><?php echo $value['faktor']; ?></th>
										  </tr>
										  <tr>
											<td rowspan='3'>&micro;<sub><?php echo $value['faktor']; ?> minimal</sub>(<?php echo $char; ?>)</td>
											<td></td>
											<td rowspan='3'>&micro;<sub><?php echo $value['faktor']; ?> ringan</sub>(<?php echo $char; ?>)</td>
											<td>0 , <?php echo $char; ?> < <?php echo $value['bts_bwh'];?> atau <?php echo $char; ?>><?php echo $sed;?></td>
											<td rowspan='3'>&micro;<sub><?php echo $value['faktor']; ?> sedang</sub>(<?php echo $char; ?>)</td>
											<td>0 , <?php echo $char; ?> < <?php echo $value['bts_bwh'];?> atau <?php echo $char; ?>><?php echo $sed;?></td>
											<td rowspan='3'>&micro;<sub><?php echo $value['faktor']; ?> berat</sub>(<?php echo $char; ?>)</td>
											<td>0 , <?php echo $char; ?><<?php echo $sed;?></td>
										  </tr>
										  <tr>
											<td>(<?php echo $rin;?>-<?php echo $char; ?>)/<?php echo $rin;?> , <?php echo $value['bts_bwh'];?> &le; <?php echo $char; ?> &le;<?php echo $rin;?></td>
											<td>(<?php echo $char;?>-<?php echo $value['bts_bwh'];?>)/<?php echo $rin;?> , <?php echo $value['bts_bwh'];?> &le; <?php echo $char;?> &le;<?php echo $rin;?></td>
											<td>(<?php echo $char;?>-<?php echo $rin; ?>)/<?php echo $rin;?> , <?php echo $rin;?> &le; <?php echo $char; ?> &le;<?php echo $value['bts_ats'];?></td>
											<td>(<?php echo $char;?>-<?php echo $sed;?>)/<?php echo $rin;?> , <?php echo $sed;?> &le; <?php echo $char;?> &le;<?php echo $value['bts_ats'];?></td>
										  </tr>
										  <tr>
											<td>0 , <?php echo $char;?>><?php echo $rin;?></td>
											<td>(<?php echo $rin;?>-<?php echo $char;?>)/<?php echo $rin;?> , <?php echo $rin;?> &le; <?php echo $char;?> &le;<?php echo $sed;?></td>
											<td>(<?php echo $value['bts_ats'];?>-<?php echo $char;?>)/<?php echo $rin;?> , <?php echo $sed;?> &le; <?php echo $char;?> &le;<?php echo $value['bts_ats'];?></td>
											<td>1 , <?php echo $char;?>><?php echo $value['bts_ats'];?></td>
										  </tr>
										<!--   <tr>
											<th colspan='4'>kelistrikan</th>
										  </tr>
										  <tr>
											<td rowspan='3'>&micro;<sub>kelistrikan besar</sub>(y)</td>
											<td>1 , y<<?=$y_min?></td>
											<td rowspan='3'>&micro;<sub>kelistrikan kecil</sub>(y)</td>
											<td>0 , y<<?=$y_min?></td>
										  </tr>
										  <tr>
											<td>(<?=$y_max?>-y)/<?=($y_max-$y_min)?> , <?=$y_min?> &le; y &le;<?=$y_max?></td><td>(y-<?=$y_min?>)/<?=($y_max-$y_min)?> , <?=$y_min?> &le; y &le;<?=$y_max?></td>
										  </tr>
										  <tr>
											<td>0 , y><?=$y_max?></td><td>1 , y><?=$y_max?></td>
										  </tr>
										  <tr>
											<th colspan='4'>kerusakan</th>
										  </tr>
										  <tr>
											<td rowspan='3'>&micro;<sub>kerusakan besar</sub>(z)</td>
											<td>1 , z<<?=$z_min?></td>
											<td rowspan='3'>&micro;<sub>kerusakan kecil</sub>(z)</td>
											<td>0 , z<<?=$z_min?></td>
										  </tr>
										  <tr>
											<td>(<?=$z_max?>-z)/<?=($z_max-$z_min)?> , <?=$z_min?> &le; z &le;<?=$z_max?></td><td>(z-<?=$z_min?>)/<?=($z_max-$z_min)?> , <?=$z_min?> &le; z &le;<?=$z_max?></td>
										  </tr>
										  <tr>
											<td>0 , z><?=$z_max?></td><td>1 , z><?=$z_max?></td>
										  </tr> -->
										  <tr>
										  	<?php foreach ($input as $key => $values) { 
										  		if( $values['id_faktor'] == $value['id_faktor']){
										  		?>
											<td colspan='10'>
											  <?php echo $value['faktor'];?> : <?php echo $char;?>=<?php echo $values['total']?>;<br />
											  <?php 

											  if(($values['total'] <= $value['bts_bwh']) || ($values['total'] <= $rin)){
											  	 $ux_minimal[$char] =($rin-$values['total'])/$rin;?>
											  	  &micro;<sub>  <?php echo $value['faktor'];?> minimal</sub>(<?php echo $values['total']; ?>)=(<?php echo $rin;?>-<?php echo $values['total']; ?>)/<?php echo $rin;?>=<?=$ux_minimal[$char]?>;<br />
											  <?php }
											  if($values['total'] > $rin)
											  {
											  	$ux_minimal[$char] = null;?>
											  	 &micro;<sub>  <?php echo $value['faktor'];?> minimal</sub>(<?php echo $values['total']; ?>)=<?=$ux_sedikit[$char]?>;<br />
											  <?php } 
											  // ==============================================================
											  if(($values['total'] < $value['bts_bwh']) && ($values['total'] < $sed)){
											  	$ux_ringan[$char] = null;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> ringan</sub>(<?php echo $values['total']; ?>)=<?=$ux_ringan[$char]?>;<br />
											  <?php }
											  if(($value['bts_bwh'] <= $values['total'] ) && ($values['total'] <= $sed))
											  {
											  	$ux_ringan[$char] = ($values['total']-$value['bts_bwh'])/$rin;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> ringan</sub>(<?php echo $values['total']; ?>)=(<?php echo $values['total'];?>-<?php echo $value['bts_bwh']; ?>)/<?php echo $rin;?>=<?=$ux_ringan[$char]?>;<br />
											  <?php }
											  if(($values['total']>= $rin) && ($values['total'] <= $sed)){
											  	$ux_ringan[$char] = ($rin-$values['total'])/$rin;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> ringan</sub>(<?php echo $values['total']; ?>)=(<?php echo $rin;?>-<?php echo $values['total']; ?>)/<?php echo $rin;?>=<?=$ux_ringan[$char]?>;<br />

											  <?php }
											  // ==============================================================
											  if(($values['total'] >= $value['bts_bwh']) or ($values['total'] > $value['bts_bwh']) or ($values['total'] > $sed)){
											  	$ux_sedang[$char] = null;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> sedang</sub>(<?php echo $values['total']; ?>)=<?='NULL'?>;<br />
											  <?php }
											  if(($rin <= $values['total'] ) && ($values['total'] <= $value['bts_ats']))
											  {
											  	$ux_sedang[$char] = ($values['total']-$rin)/$rin;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> sedang</sub>(<?php echo $values['total']; ?>)=(<?php echo $values['total'];?>-<?php echo $rin; ?>)/<?php echo $rin;?>=<?=$ux_sedang[$char]?>;<br />
											  <?php }
											  if(($sed <= $values['total']) && ($values['total'] <= $value['bts_ats'])){
											  	$ux_sedang[$char] = ($value['bts_ats']-$values['total'])/$rin;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> sedang</sub>(<?php echo $values['total']; ?>)=(<?php echo $value['bts_ats'];?>-<?php echo $value['total']; ?>)/<?php echo $rin;?>=<?=$ux_sedang[$char]?>;<br />
											  <?php}
											  // ======================================================================
											  
											  if(( $values['total'] >= $sed ) || ($values['total'] <= $value['bts_ats']))
											  {

											  	$ux_berat[$char] = ($values['total']-$sed)/$rin;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> berat</sub>(<?php echo $values['total']; ?>)=(<?php echo $values['total'];?>-<?php echo $sed; ?>)/<?php echo $rin;?>=<?=$ux_berat[$char]?>;<br />
											  <?php }
											  if($values['total'] < $sed){
											  	$ux_berat[$char] = null;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> berat</sub>(<?php echo $values['total']; ?>)=<?='NULL'?>;<br />
											  <?php }
											  if($values['total'] > $value['bts_ats']){
											  	$ux_berat[$char] = 1;?>
											  	&micro;<sub>  <?php echo $value['faktor'];?> berat</sub>(<?php echo $values['total']; ?>)=<?=$ux_berat[$char]?>;<br />
											  <?php }

											  // ======================================================================

											  // $ux_sedikit[$char]=($value['bts_ats']-$values['total'])/($value['bts_ats']-$value['bts_bwh']);
											  // //print_r($ux_sedikit);exit;
											  // $ux_besar[$char]=($values['total']-$value['bts_bwh'])/($value['bts_ats']-$value['bts_bwh']);
											  ?>
											  
											  
												
											  <!-- &micro;<sub>  <?php echo $value['faktor'];?> sedikit</sub>(<?php echo $values['total']; ?>)=(<?php echo $value['bts_ats'];?>-<?php echo $values['total']; ?>)/<?php echo $kr;?>=<?=$ux_sedikit[$char]?>;<br />
											  &micro;<sub>  <?php echo $value['faktor'];?> besar</sub>(<?php echo $values['total']; ?>)=(<?php echo $values['total']; ?>-<?php echo $value['bts_bwh']; ?>)/<?php echo $kr;?>=<?=$ux_besar[$char]?>;<br /> -->
											</td>
											<?php }} ?>
										  </tr>
										  <?php 
										  $char++;
										} ?>
									</table>
								  </fieldset>
								  <fieldset>
									<legend>[2] Penerapan Fungsi Implikasi</legend>
									<p>Nilai &alpha;-predikat dan Z dari setiap aturan</p>
									<p><strong>Rule 1 :</strong><em>        IF unit sedikit and kelistrikan besar THEN kerusakan barang sedikit</em><br />
									<?php
									$a_pred1=min($ux_sedikit,$uy_besar);
									$z1=$z_max-$a_pred1*($z_max-$z_min);
									?>
									&alpha;-predikat<sub>1</sub>=&micro;<sub>unit sedikit</sub> <big>&cap;</big> &micro;<sub>kelistrikan besar</sub><br />
									  =min(&micro;<sub>unit sedikit</sub>(<?=$x?>) <big>&cap;</big> &micro;<sub>kelistrikan besar</sub>(<?=$y?>))<br />
									  =min(<?=$ux_sedikit?>,<?=$uy_besar?>)<br />
									  =<?=$a_pred1?><br />
									Dari himpunan kerusakan barang sedikit: (<?=$z_max?>-z<sub>1</sub>)/<?=($z_max-$z_min)?>=<?=$a_pred1?><br/>
									diperoleh <strong>z<sub>1</sub></strong>=<?=$z1?>
									</p>
									<p><strong>Rule 2 :</strong><em>IF unit sedikit and kelistrikan sedikit THEN kerusakan barang sedikit</em><br />
									<?php
									$a_pred2=min($ux_sedikit,$uy_sedikit);
									$z2=$z_max-$a_pred2*($z_max-$z_min);
									?>
									&alpha;-predikat<sub>2</sub>=&micro;<sub>unit sedikit</sub> <big>&cap;</big> &micro;<sub>kelistrikan sedikit</sub><br />
									  =min(&micro;<sub>unit sedikit</sub>(<?=$x?>) <big>&cap;</big> &micro;<sub>kelistrikan sedikit</sub>(<?=$y?>))<br />
									  =min(<?=$ux_sedikit?>,<?=$uy_sedikit?>)<br />
									  =<?=$a_pred2?><br />
									Dari himpunan kerusakan barang sedikit: (<?=$z_max?>-z<sub>2</sub>)/<?=($z_max-$z_min)?>=<?=$a_pred2?><br/>
									diperoleh <strong>z<sub>2</sub></strong>=<?=$z2?>
									</p>
									<p><strong>Rule 3 :</strong><em>IF unit besar and kelistrikan besar THEN kerusakan barang besar</em><br />
									<?php
									$a_pred3=min($ux_besar,$uy_besar);
									$z3=$a_pred3*($z_max-$z_min)-$z_min;
									?>
									&alpha;-predikat<sub>2</sub>=&micro;<sub>unit besar</sub> <big>&cap;</big> &micro;<sub>kelistrikan besar</sub><br />
									  =min(&micro;<sub>unit besar</sub>(<?=$x?>) <big>&cap;</big> &micro;<sub>kelistrikan besar</sub>(<?=$y?>))<br />
									  =min(<?=$ux_besar?>,<?=$uy_besar?>)<br />
									  =<?=$a_pred3?><br />
									Dari himpunan kerusakan barang besar: (z<sub>3</sub>-<?=$z_min?>)/<?=($z_max-$z_min)?>=<?=$a_pred3?><br/>
									diperoleh <strong>z<sub>3</sub></strong>=<?=$z3?>
									</p>
									<p><strong>Rule 4 :</strong><em>IF unit besar and kelistrikan sedikit THEN kerusakan barang besar</em><br />
									<?php
									$a_pred4=min($ux_besar,$uy_sedikit);
									$z4=$a_pred4*($z_max-$z_min)-$z_min;
									?>
									&alpha;-predikat<sub>2</sub>=&micro;<sub>unit besar</sub> <big>&cap;</big> &micro;<sub>kelistrikan sedikit</sub><br />
									  =min(&micro;<sub>unit besar</sub>(<?=$x?>) <big>&cap;</big> &micro;<sub>kelistrikan sedikit</sub>(<?=$y?>))<br />
									  =min(<?=$ux_besar?>,<?=$uy_sedikit?>)<br />
									  =<?=$a_pred4?><br />
									Dari himpunan kerusakan barang besar: (z<sub>4</sub>-<?=$z_min?>)/<?=($z_max-$z_min)?>=<?=$a_pred4?><br/>
									diperoleh <strong>z<sub>4</sub></strong>=<?=$z4?>
									</p>
								  </fieldset>
								  <fieldset>
									<legend>Defuzzyfication</legend>
									<?php
									$n=$a_pred1*$z1+$a_pred2*$z2+$a_pred3*$z3+$a_pred4*$z4;
									$d=$a_pred1+$a_pred2+$a_pred3+$a_pred4;
									$z=$n/$d;
									?>
									<p>Menghitung z akhir dengan merata-rata semua z berbobot</p>
								  <p>z=(&alpha;-predikat<sub>1</sub>*z<sub>1</sub>+&alpha;-predikat<sub>2</sub>*z<sub>2</sub>+&alpha;-predikat<sub>3</sub>*z<sub>3</sub>+&alpha;-predikat<sub>4</sub>*z<sub>4</sub>)/(&alpha;-predikat<sub>1</sub>+&alpha;-predikat<sub>2</sub>+&alpha;-predikat<sub>3</sub>+&alpha;-predikat<sub>4</sub>)<br/>
									=(<?=$a_pred1?>*<?=$z1?>+<?=$a_pred2?>*<?=$z2?>+<?=$a_pred3?>*<?=$z3?>+<?=$a_pred4?>*<?=$z4?>)/(<?=$a_pred1?>+<?=$a_pred2?>+<?=$a_pred3?>+<?=$a_pred4?>)<br/>
									=<?=$n?>/<?=$d?><br/>
									=<?=$z?></p>
									<p>Jadi jumlah yang harus dikerusakan (<strong>z</strong>) =<strong><?=$z?></strong></p>
								  </fieldset>
							<?php
							//}
							?>      
							</div>
						</body>
					</div>
				</div>
			</div>
		</div>
		
		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ==============================================================