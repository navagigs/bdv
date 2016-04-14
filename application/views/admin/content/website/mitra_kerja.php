<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 270,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe'
			});
	});
</script>
<section class="content-header">
<h1>Mitra<small>Kerja</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Mitra Kerja</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/mitra_kerja/tambah">Tambah Mitra Kerja</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/mitra_kerja">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
	</div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="50%">URL</th>
        <th>GAMBAR</th>
        <th>TGL. POSTING</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_down[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_mitra_kerja('', 'mitra_id', 'DESC', $batas, $page, '', $like_down) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->mitra_link;?></td>
        <td><img src="<?php echo base_url()."assets/images/mitra_kerja/kecil_".$row->mitra_gambar;?>" width="100" height="50" /></td>
        <td><?php echo dateIndo($row->mitra_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/mitra_kerja_detail/<?php echo $row->mitra_id;?>" rel="detail" class="view" title="Detail <?php echo $row->mitra_id;?>"></a><a href="<?php echo site_url();?>website/mitra_kerja/edit/<?php echo $row->mitra_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/mitra_kerja/hapus/<?php echo $row->mitra_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus Mitra Kerja `<?php echo $row->mitra_link;?>`.');"></a></td>
	</tr>
    <?php 
	$i++; 
	} 
	} else { 
	?>
    <tr>
    	<td colspan="5">Belum ada data!.</td>
	</tr>
    <?php } ?>
    <tr>
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/mitra_gambar/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Mitra Kerja</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/mitra_kerja">Mitra Kerja</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/mitra_kerja/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="mitra_link" >Link <span class="required">*</span></label></td>
    <td><input name="mitra_link" type="text" class="form-control input-sm" id="mitra_link" value="" size="80" maxlength="100"/></td>
  </tr>
  <tr>
    <td><label for="mitra_gambar">Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="mitra_gambar" id="mitra_gambar"  /></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/mitra_kerja'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Mitra Kerja</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/mitra_kerja">Mitra Kerja</a></li>
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
		if (($mitra_gambar != '') and ($key != 'mitra_gambar')) {
	?>\
	var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
	if (<?php echo $key;?>.length==0){
		alert ('<?php echo $value;?> harus diisi!');
		document.getElementById('<?php echo $key;?>').focus();
		return false;
	}
	<?php } } ?>
	return true;
}
</script>
<form id="formMenu" action="<?php echo site_url();?>website/mitra_kerja/edit/<?php echo $mitra_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="mitra_id" value="<?php echo $mitra_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="mitra_link" >Link <span class="required">*</span></label></td>
    <td><input name="mitra_link" type="text"  class="form-control input-sm"  id="mitra_link" value="<?php echo $mitra_link;?>" size="80" maxlength="100"/></td>
  </tr>  
  <?php if ($mitra_gambar){?>
  <tr>
    <td><label for="mitra_gambar">Edit Gambar</label></td>
    <td><input type="file" name="mitra_gambar" id="mitra_gambar"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/mitra_kerja/kecil_".$mitra_gambar;?>" width="100"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="mitra_gambar" >Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="mitra_gambar" id="mitra_gambar"  /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/mitra_kerja'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Mitra Kerja</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $mitra_kerja->mitra_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Link</td>
    <td>: <?php echo $mitra_kerja->mitra_link;?></td>
  </tr>
  <tr class="awal">
    <td>Gambar</td>
    <td>: <img src="<?php echo base_url()."assets/images/mitra_kerja/kecil_".$mitra_kerja->mitra_gambar;?>" width="100" ></td>
  </tr>
</table>
</div>
</div>
<?php } ?>