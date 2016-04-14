<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 450,		
				'width'				: 600,		
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
<h1>Galeri<small>Video</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Galleri Video</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/galeri_video/tambah">Tambah Galeri Video</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/galeri_video">Bersihkan Pencarian</a></li>
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
        <th width="30%">JUDUL VIDEO</th>
        <th>LINK</th>
        <th width="150">WAKTU POSTING</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_video[$cari] = $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_galeri_video('*', 'video_waktu', 'DESC', $batas, $page, '', $like_video) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->video_judul;?></td>
    	<td><?php echo $row->video_link;?></td>
        <td><?php echo dateIndo($row->video_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/galeri_video_detail/<?php echo $row->video_id;?>" rel="detail" class="view" title="Detail <?php echo $row->video_judul;?>"></a><a href="<?php echo site_url();?>website/galeri_video/edit/<?php echo $row->video_id;?>" class="edit" title="Ubah"></a><a href="<?php echo site_url();?>website/galeri_video/hapus/<?php echo $row->video_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus video `<?php echo $row->video_judul;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/galeri_video/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Galeri Video</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/galeri_video">Galeri Video</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/galeri_video/tambah" method="post" onSubmit="return validate()">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="video_judul">Nama Video <span class="required">*</span></label></td>
    <td><input name="video_judul" type="text" class="form-control input-sm" id="video_judul" value="<?php echo $video_judul;?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="60" id="video_deskripsi" name="video_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td width="130"><label for="video_link" >Link Video <span class="required">*</span></label></td>
    <td><input name="video_link" type="text" class="form-control input-sm" id="video_link" value="<?php echo $video_link;?>" ></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/galeri_video'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Galeri Video</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/galeri_video">Galeri Video</a></li>
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
	var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
	if (<?php echo $key;?>.length==0){
		alert ('<?php echo $value;?> harus diisi!');
		document.getElementById('<?php echo $key;?>').focus();
		return false;
	}
	return true;
}
</script>
<form id="formMenu" action="<?php echo site_url();?>website/galeri_video/edit/<?php echo $video_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="video_id" value="<?php echo $video_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="video_judul">Nama Video <span class="required">*</span></label></td>
    <td><input name="video_judul" type="text" class="form-control input-sm" id="video_judul" value="<?php echo $video_judul;?>" size="80" maxlength="100"/></td>
  </tr> 
    <tr>
    <td colspan="2"><textarea rows="20" cols="60" id="video_deskripsi" name="video_deskripsi" ><?php echo $video_deskripsi; ?></textarea><?php echo $ckeditor;?></td>
  </tr>
   <tr>
    <td width="130"><label for="video_link"  >Link Video <span class="required">*</span></label></td>
    <td><input name="video_link" type="text" class="form-control input-sm" id="video_link" value="<?php echo $video_link;?>" size="80" maxlength="200"/></td>
  </tr> 
    <tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/galeri_video'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:90%;">
<h2><span>Detail.</span> Galeri Video</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td width="110"><strong>ID Galeri</strong></td>
    <td>: <strong><?php echo $video->video_id;?></strong></td>
  </tr>
  <tr>
    <td>Nama Video</td>
    <td>: <?php echo $video->video_judul;?></td>
  </tr>
  <tr class="awal">
    <td>Waktu Posting</td>
    <td>: <?php echo dateIndo($video->video_waktu);?></td>
  </tr>
  <tr>
    <td>Link Video</td>
    <td>: <?php echo $video->video_link;?></td>
  </tr>  
</table>
</div>
</div>
<?php } ?>