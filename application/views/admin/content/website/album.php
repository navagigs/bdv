<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 500,				
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe',
				'prevEffect'        : 'none',
				'nextEffect'        : 'none',
				'showNavArrows'	    : false
			});
	});
</script>
<section class="content-header">
<h1>Albums<small>Foto</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Albums Foto</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/album/tambah">Tambah Album</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/album">Bersihkan Pencarian</a></li>
		</ul>
    </div>
    </div>
	<form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Album Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
     </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th>JUDUL</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_album[$cari] = $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_album('*', 'album_judul', 'ASC', $batas, $page, '', $like_album) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td><td><?php echo $row->album_judul;?></td><td align="center"><a href="<?php echo site_url();?>website/album_detail/<?php echo $row->album_id;?>" rel="detail" class="view" title="Detail <?php echo $row->album_judul;?>"></a><a href="<?php echo site_url();?>website/album/edit/<?php echo $row->album_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/album/hapus/<?php echo $row->album_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus album `<?php echo $row->album_judul;?>`.');"></a></td>
	</tr>
    <?php 
	$i++; 
	} 
	} else { 
	?>
    <tr>
    	<td colspan="3">Belum ada data!.</td>
	</tr>
    <?php } ?>
    <tr>
    	<th colspan="3" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/album/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Albums</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/album">Albums Foto</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/album/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="album_judul">Nama Album <span class="required">*</span></label></td>
    <td><input name="album_judul" type="text" class="form-control input-sm" id="album_judul" value="<?php echo $album_judul;?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="60" id="album_deskripsi" name="album_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td><label for="album_gambar" >Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="album_gambar" id="album_gambar" /></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/album'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Albums</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/album">Albums Foto</a></li>
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
		if (($album_gambar != '') and ($key != 'album_gambar')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/album/edit/<?php echo $album_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="album_id" value="<?php echo $album_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="album_judul" >Nama Album <span class="required">*</span></label></td>
    <td><input name="album_judul" type="text" class="form-control input-sm" id="album_judul" value="<?php echo $album_judul;?>" /></td>
  </tr> 
    <tr>
    <td colspan="2"><textarea rows="20" cols="60" id="album_deskripsi" name="album_deskripsi" ><?php echo $album_deskripsi; ?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <?php if ($album_gambar){?>
  <tr>
    <td><label for="album_gambar" >Edit Gambar</label></td>
    <td><input type="file" name="album_gambar" id="album_gambar"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/album/kecil_".$album_gambar;?>"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="album_gambar" >Gambar</label></td>
    <td><input type="file" name="album_gambar" id="album_gambar" /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/album'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Album</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td width="110"><strong>ID album</strong></td>
    <td>: <strong><?php echo $album->album_id;?></strong></td>
  </tr>
  <tr>
    <td>Nama album</td>
    <td>: <?php echo $album->album_judul;?></td>
  </tr>  
  <tr class="awal">
    <td>Deskripsi</td>
    <td><span style="display: inline-block; float:left; margin-right: 4px;">:</span><p style="margin: 0px; padding: 0px; display: inline-block; float:left;"><?php echo $album->album_deskripsi;?></p></strong></td>
  </tr>
  <tr>
    <td>Gambar</td>
    <td> <img src="<?php echo site_url();?>assets/images/album/<?php echo $album->album_gambar;?>" style="height: 200px" /></td>
  </tr>  
</table>
</div>
</div>
<?php } ?>