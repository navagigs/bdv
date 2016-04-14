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
<h1>Halaman<small>statis</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Halaman Statis</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/halaman_statis/tambah">Tambah Halaman Statis</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/halaman_statis">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
	<form action="" method="post" id="table" >
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Halaman Statis Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp;  <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
     <thead>
    <tr>
    	<th width="30">#</th>
        <th width="40%">JUDUL</th>
        <th width="20%">LINK</th>
        <th>TANGGAL</th>
        <th width="100"></th>
	</tr>
     </thead>
    <tbody>
    <?php 	
	$i	= $page+1;
	$like_statis[$cari] = $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_statis('*', 'statis_waktu', 'DESC', $batas, $page, '', $like_statis) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->statis_judul;?></td>
        <td>pages/detail/<?php echo dateIndo6($row->statis_waktu)."/".$row->statis_id; ?></td>
        <td><?php echo dateIndo($row->statis_waktu);?></td>
        <td align="center"><?php /*?><a href="<?php echo site_url();?>website/statis_detail/<?php echo $row->statis_id;?>" rel="detail" class="view" title="Detail <?php echo $row->statis_judul;?>"></a>  <?php */?>  
            <a href="<?php echo site_url();?>website/halaman_statis/edit/<?php echo $row->statis_id;?>" class="edit" title="Edit"></a>
            <a href="<?php echo site_url();?>website/halaman_statis/hapus/<?php echo $row->statis_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus statis `<?php echo $row->statis_judul;?>`.');"></a></td>
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
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/halaman_statis/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
    
</div>

<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Halaman Statis</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/halaman_statis">Halaman Statis</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/halaman_statis/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="statis_judul" >Judul Statis <span class="required">*</span></label></td>
    <td><input name="statis_judul" type="text" id="statis_judul"  class="form-control input-sm" value="<?php echo $statis_judul;?>" size="80"/></td>
  </tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="20" id="statis_deskripsi" name="statis_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td><label for="statis_gambar">Gambar</label></td>
    <td><input type="file" name="statis_gambar" id="statis_gambar"  /></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/halaman_statis'"/></div>
</form>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
<?php } elseif ($action == 'edit') { ?>

<section class="content-header">
<h1>Edit<small>Halaman Statis</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/halaman_statis">Halaman Statis</a></li>
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
		if (($statis_gambar != '') and ($key != 'statis_gambar')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/halaman_statis/edit/<?php echo $statis_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="statis_id" value="<?php echo $statis_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="statis_judul" >Judul Statis <span class="required">*</span></label></td>
    <td><input name="statis_judul" type="text" id="statis_judul" class="form-control input-sm"  value="<?php echo $statis_judul;?>" size="80"/></td>
  </tr>  
  <tr>
    <td colspan="2"><textarea rows="20" cols="20" id="statis_deskripsi" name="statis_deskripsi" ><?php echo $statis_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <?php if ($statis_gambar){?>
  <tr>
    <td><label for="statis_gambar">Edit Gambar</label></td>
    <td><input type="file" name="statis_gambar"  id="statis_gambar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/statis/kecil_".$statis_gambar;?>" width="220"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="statis_gambar" >Gambar</label></td>
    <td><input type="file" name="statis_gambar" id="statis_gambar"  /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/halaman_statis'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:90%;">
<h2><span>Detail.</span> Halaman Statis</h2>
<div class="formConInner">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>ID statis</strong></td>
    <td>: <strong><?php echo $statis->statis_id;?></strong></td>
  </tr>
  <tr>
    <td width="90">Judul Statis</td>
    <td>: <?php echo $statis->statis_judul;?></td>
  </tr>
  <tr class="awal">
    <td>Deskripsi</td>
    <td>:</td>
  </tr>
  <tr>
    <td colspan="2" ><textarea rows="20" cols="60" id="statis_deskripsi" name="statis_deskripsi" ><?php echo $statis->statis_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <?php if ($statis->statis_gambar){?>
  <tr class="awal">
    <td>Gambar</td>
    <td>: <img src="<?php echo base_url()."assets/images/statis/kecil_".$statis->statis_gambar;?>" width="200"/></td>
  </tr>  
  <?php } else { ?>
  <tr class="awal">
    <td>Gambar</td>
    <td>: Tidak Ada Gambar</td>
  </tr>  
  <?php } ?>
</table>
</div>
</div>
<?php } ?>