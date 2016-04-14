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
<h1>Download<small>File</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Download File</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/download_file/tambah">Tambah Download File</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/download_file">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
	<form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="30" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
     <thead>
    <tr>
    	<th width="30">#</th>
        <th>JUDUL FILE</th>
        <th width="300">FILE</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_down[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_downloads('', 'download_waktu', 'DESC', $batas, $page, '', $like_down) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->download_judul;?></td>
        <td><?php echo $row->download_file;?></td>
        <td align="center"><a href="<?php echo site_url();?>website/download_file_detail/<?php echo $row->download_id;?>" rel="detail" class="view" title="Detail <?php echo $row->download_id;?>"></a><a href="<?php echo site_url();?>website/download_file/edit/<?php echo $row->download_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/download_file/hapus/<?php echo $row->download_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus download_file `<?php echo $row->download_judul;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/download_file/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>
</div>
</section>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Download File</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/download_file">Download File</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/download_file/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="download_judul" >Judul File <span class="required">*</span></label></td>
    <td><input name="download_judul" type="text" class="form-control input-sm" id="download_judul" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="download_deskripsi" >Deskripsi File <span class="required">*</span></label></td>
    <td><input name="download_deskripsi" type="text" class="form-control input-sm" id="download_deskripsi" value="" /></td>
  </tr>
  <tr>
    <td><label for="download_file">File <span class="required">*</span></label></td>
    <td><input type="file" name="download_file" class="form-control input-sm" id="download_file"   /><span class="ket">Max. data 4MB</span></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/download_file'"/></div>
</form>

</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Download File</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/download_file">Download File</a></li>
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
		if (($download_file != '') and ($key != 'download_file')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/download_file/edit/<?php echo $download_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="download_id" value="<?php echo $download_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="download_judul" >Judul File <span class="required">*</span></label></td>
    <td><input name="download_judul" type="text" id="download_judul" value="<?php echo $download_judul;?>" class="form-control input-sm" /></td>
  </tr>  
  <tr>
    <td width="130"><label for="download_deskripsi" >Deskripsi File <span class="required">*</span></label></td>
    <td><input name="download_deskripsi" type="text" id="download_deskripsi" value="<?php echo $download_deskripsi;?>" class="form-control input-sm" /></td>
  </tr>
  <?php if ($download_file){?>
  <tr>
    <td><label for="download_file" >File</label></td>
    <td><span style="font-size: 14px;"><?php echo $download_file; ?></span></td>
  </tr>
  <tr>
    <td><label for="download_file">Edit File</label></td>
    <td><input type="file" name="download_file" id="download_file"  /><span class="ket">Max. data 4MB</span> </td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="download_file" >File <span class="required">*</span></label></td>
    <td><input type="file" name="download_file" id="download_file"  /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/download_file'"/></div>
</form>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Download File</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $download->download_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Judul File</td>
    <td>: <?php echo $download->download_judul;?></td>
  </tr>
  <tr class="awal">
    <td width="110">Deskripsi File</td>
    <td>: <?php echo $download->download_deskripsi;?></td>
  </tr>
  <tr>
    <td>File</td>
    <td>: <?php echo $download->download_file;?></td>
  </tr>
</table>
</div>
</div>
<?php } ?>