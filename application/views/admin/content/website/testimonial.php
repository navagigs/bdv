<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 500,
				'width'				: 900,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe',
				'prevEffect'        : 'none',
        		'nextEffect'        : 'none',
				'showNavArrows'		: false
			});
	});
</script>
<section class="content-header">
<h1>Testimonial<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Testimonial</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
	<div class="box-body table-responsive">  
    <div id="opration">
    <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
    <div id="massage">
    	<?php if ($this->session->flashdata('success')) { ?>
        <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
    	<?php } else { ?>
        <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="bttns_add">
    	<ul>
			<li><a class="addbttn last" href="<?php echo site_url();?>website/Testimonial/tambah">Tambah Testimonial</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/testimonial">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="50" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
	</div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th>NAMA</th>
        <th width="200">TEMPAT KERJA</th>
        <th width="200">JABATAN</th>
        <th width="150">TANGGAL</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_testimonial[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_testimonial('', 'testimonial_waktu', 'DESC', $batas, $page, '', $like_testimonial) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->testimonial_nama;?></td>
        <td><?php echo $row->testimonial_kerja;?></td>
        <td><?php echo $row->testimonial_jabatan;?></td>
        <td><?php echo dateIndo($row->testimonial_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/testimonial_detail/<?php echo $row->testimonial_id;?>" rel="detail" class="view" title="Detail <?php echo $row->testimonial_id;?>"></a><a href="<?php echo site_url();?>website/testimonial/edit/<?php echo $row->testimonial_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/testimonial/hapus/<?php echo $row->testimonial_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus testimonial `<?php echo $row->testimonial_nama;?>`.');"></a></td>
	</tr>
    <?php 
	$i++; 
	} 
	} else { 
	?>
    <tr>
    	<td colspan="6">Belum ada data!.</td>
	</tr>
    <?php } ?>
    <tr>
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/testimonial/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Testimonial</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/testimonial">Testimonial</a></li>
   <li class="active">Tambah</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-body table-responsive"> 
<script language="javascript">
function validate(){
	<?php foreach ($validate as $key => $value) { ?>
	var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
	if (<?php echo $key;?>.length==0){
		alert ('<?php echo $value;?> harus diisi!');
		document.getElementById('<?php echo $key;?>').focus();
		return false;
	}
	<?php } ?>
	return true;
}
</script>
<script type="text/javascript" src="<?php echo base_url();?>editor/ckeditor.js"></script>
<link href="<?php echo base_url();?>editor/content.css" rel="stylesheet" type="text/css"/>
<form id="formMenu" action="<?php echo site_url();?>website/testimonial/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="testimonial_nama">Nama <span class="required">*</span></label></td>
    <td><input name="testimonial_nama"  class="form-control input-sm" type="text" id="testimonial_nama" value="" size="50" maxlength="100"/></td>
  </tr>
  <tr>
    <td><label for="testimonial_sumber">Sumber <span class="required">*</span></label></td>
    <td><input type="radio" name="testimonial_sumber"  value="Masih Kuliah" checked="checked" /> <label for="testimonial_sumber" style="display:inline-block">Masih Kuliah</label> <input type="radio" name="testimonial_sumber" value="Lulusan"/> <label for="testimonial_sumber" style="display:inline-block">Lulusan</label></td>
  </tr>
  <tr>
    <td width="130"><label for="testimonial_kerja" >Tempat Kerja <span class="required">*</span></label></td>
    <td><input name="testimonial_kerja" type="text"  class="form-control input-sm" id="testimonial_kerja" value="" size="80" /></td>
  </tr>
  <tr>
    <td width="130"><label for="testimonial_jabatan" >Jabatan <span class="required">*</span></label></td>
    <td><input name="testimonial_jabatan" type="text"  class="form-control input-sm" id="testimonial_jabatan" value="" size="50" /></td>
  </tr>
  <tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="20" id="testimonial_deskripsi" name="testimonial_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td><label for="testimonial_gambar">Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="testimonial_gambar"  class="form-control input-sm" id="testimonial_gambar"  /></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/testimonial'"/></div>
</form>
</div>
</div>

<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Testimonial</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/testimonial">Testimonial</a></li>
   <li class="active">Edit</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-body table-responsive"> 
<script language="javascript">
function validate(){
	<?php foreach ($validate as $key => $value) { 
		if (($testimonial_gambar != '') and ($key != 'testimonial_gambar')) {
	?>
	var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
	if (<?php echo $key;?>.length==0){
		alert ('<?php echo $value;?> harus diisi!');
		document.getElementById('<?php echo $key;?>').focus();
		return false;
	}
	<?php }
	} ?>
	return true;
}
</script>
<form id="formMenu" action="<?php echo site_url();?>website/testimonial/edit/<?php echo $testimonial_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="testimonial_nama">Nama <span class="required">*</span></label></td>
    <td><input name="testimonial_nama" type="text"  class="form-control input-sm" id="testimonial_nama" value="<?php echo $testimonial_nama;?>" size="50" maxlength="100"/></td>
  </tr>
  <tr>
    <td><label for="testimonial_sumber" >Sumber <span class="required">*</span></label></td>
    <td><input type="radio" name="testimonial_sumber" value="Masih Kuliah" <?php echo $yes = ($testimonial_sumber =='Masih Kuliah')?'checked':'';?> /> <label for="testimonial_sumber" style="display:inline-block">Masih Kuliah</label> <input type="radio" name="testimonial_sumber" value="Lulusan" <?php echo $no = ($testimonial_sumber=='Lulusan')?'checked':'';?>/> <label for="testimonial_sumber" style="display:inline-block">Lulusan</label></td>
  </tr>
  <tr>
    <td width="130"><label for="testimonial_kerja">Tempat Kerja <span class="required">*</span></label></td>
    <td><input name="testimonial_kerja" type="text"  class="form-control input-sm" id="testimonial_kerja" value="<?php echo $testimonial_kerja;?>" size="80" /></td>
  </tr>
  <tr>
    <td width="130"><label for="testimonial_jabatan">Jabatan <span class="required">*</span></label></td>
    <td><input name="testimonial_jabatan" type="text"  class="form-control input-sm" id="testimonial_jabatan" value="<?php echo $testimonial_jabatan;?>" size="50" /></td>
  </tr>
  <tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="20" id="testimonial_deskripsi" name="testimonial_deskripsi" ><?php echo $testimonial_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <?php if ($testimonial_gambar){?>
  <tr>
    <td><label for="testimonial_gambar">Edit Gambar</label></td>
    <td><input type="file" name="testimonial_gambar" id="testimonial_gambar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/testimonial/kecil_".$testimonial_gambar;?>"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="testimonial_gambar">Gambar</label></td>
    <td><input type="file" name="testimonial_gambar" id="testimonial_gambar"  /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/testimonial'"/></div>
</form>
</div>
</div>

<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:90%;">
<h2><span>Detail.</span> Testimonial</h2>
<div class="formConInner">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $testimonial->testimonial_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Nama</td>
    <td>: <?php echo $testimonial->testimonial_nama;?></td>
  </tr>
  <tr class="awal">
    <td>Sumber</td>
    <td>: <?php echo ($testimonial->testimonial_sumber == 'Masih Kuliah')?'Masih Kuliah':'Lulus'; ?></td>
  </tr>
  <tr>
    <td>Tempat Kerja</td>
    <td>: <?php echo $testimonial->testimonial_kerja;?></td>
  </tr>
  <tr  class="awal">
    <td>Jabatan</td>
    <td>: <?php echo $testimonial->testimonial_jabatan;?></td>
  </tr>
  <tr>
    <td>Deskripsi</td>
    <td>:</td>
  </tr>
  <tr>
    <td colspan="2" ><textarea rows="20" cols="60" id="testimonial_deskripsi" name="testimonial_deskripsi" ><?php echo $testimonial->testimonial_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr class="awal">
    <td>Gambar</td>
    <td>: <img src="<?php echo base_url()."assets/images/testimonial/kecil_".$testimonial->testimonial_gambar;?>"/></td>
  </tr>
</table>
</div>
</div>
<?php } ?>