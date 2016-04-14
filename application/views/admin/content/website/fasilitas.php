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
<h1>Fasilitas<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Fasilitas</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/fasilitas/tambah">Tambah Fasilitas</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/fasilitas">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari fasilitas Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="423">NAMA</th>
        <th width="225">FOTO</th>
        <th width="269">TANGGAL</th>
        <th width="120"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_fasilitas[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_fasilitas('*', 'fasilitas_nama', 'ASC', $batas, $page, '', $like_fasilitas) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td class="capitalize"><?php echo $row->fasilitas_nama;?></td>
        <td class="capitalize"><img src="<?php echo base_url()."assets/images/fasilitas/kecil_".$row->fasilitas_gambar;?>" width="100" height="50" /></td>
        <td class="capitalize"><?php echo dateIndo($row->fasilitas_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/fasilitas_detail/<?php echo $row->fasilitas_id;?>" rel="detail" class="view" title="Detail <?php echo $row->fasilitas_nama;?>"></a>
        
        <a href="<?php echo site_url();?>website/fasilitas/edit/<?php echo $row->fasilitas_id;?>" class="edit" title="Edit"></a><a href="<?php echo site_url();?>website/fasilitas/hapus/<?php echo $row->fasilitas_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus fasilitas `<?php echo $row->fasilitas_nama;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/fasilitas/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Fasilitas</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/fasilitas">Fasilitas</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/fasilitas/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="fasilitas_nama" >Nama Fasilitas <span class="required">*</span></label></td>
    <td><input name="fasilitas_nama" type="text" id="fasilitas_nama" value="" class="form-control input-sm" size="80" maxlength="255"/></td>
  </tr>
  <tr>
    <td colspan="4"><textarea rows="20" cols="20" id="fasilitas_deskripsi"class="form-control input-sm" name="fasilitas_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
    </td>
  </tr>
  <tr>
    <td><label for="fasilitas_gambar">Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="fasilitas_gambar" id="fasilitas_gambar"  /></td>
  </tr>
  
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/fasilitas'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Fasilitas</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/fasilitas">Fasilitas</a></li>
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
		if (($fasilitas_gambar != '') and ($key != 'fasilitas_gambar')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/fasilitas/edit/<?php echo $fasilitas_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="fasilitas_id" value="<?php echo $fasilitas_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="fasilitas_nama">Nama Fasilitas <span class="required">*</span></label></td>
    <td colspan="3" ><input name="fasilitas_nama" type="text" class="form-control input-sm"  id="fasilitas_nama" value="<?php echo $fasilitas_nama;?>" /></td>
  </tr>
  <tr>
    <td colspan="4"><textarea rows="20" cols="60" id="fasilitas_deskripsi" name="fasilitas_deskripsi" ><?php echo $fasilitas_deskripsi;?></textarea>
    <?php echo $ckeditor;?>
    </td>
  </tr>
  <?php if ($fasilitas_gambar){?>
  <tr>
    <td><label for="fasilitas_gambar">Edit Gambar</label></td>
    <td><input type="file" name="fasilitas_gambar" id="fasilitas_gambar"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/fasilitas/kecil_".$fasilitas_gambar;?>"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="fasilitas_gambar">Gambar</label></td>
    <td><input type="file" name="fasilitas_gambar" id="fasilitas_gambar"  /></td>
  </tr>
  <?php } ?>
  
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/fasilitas'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> fasilitas</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $fasilitas->fasilitas_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Nama Fasilitas</td>
    <td>: <?php echo $fasilitas->fasilitas_nama;?></td>
  </tr>
  <tr class="awal">
    <td>Deskipsi</td>
    <td><span style="display: inline-block; float:left; margin-right: 4px;">:</span><p style="margin: 0px; padding: 0px; display: inline-block; float:left;"><?php echo $fasilitas->fasilitas_deskripsi;?></p></td>
  </tr>
  <tr>
    <td>Gambar</td>
    <td> <img src="<?php echo site_url();?>assets/images/fasilitas/<?php echo $fasilitas->fasilitas_gambar;?>" style="height: 200px" /></td>
  </tr>
</table>
</div>
</div>
<?php } ?>

