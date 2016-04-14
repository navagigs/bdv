<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/default/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/default/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/default/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 250,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe'
			});
	});
</script>
<section class="content-header">
<h1>Daftar<small>Kelompok Pengguna</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Kelompok Pengguna</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>pengaturan/kelompok_pengguna/tambah">Tambah Kelompok</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>pengaturan/kelompok_pengguna">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <div class="clear"></div>
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
        <th width="590">NAMA KELOMPOK</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$where_admin_level['admin_level_status']	= 'A';
	$like_admin_level[$cari]			= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_admin_level('', 'admin_level_nama', 'ASC', $batas, $page, $where_admin_level, $like_admin_level) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td><td><?php echo $row->admin_level_nama;?></td>
												<td align="center"><a href="<?php echo site_url();?>pengaturan/kelompok_pengguna_detail/<?php echo $row->admin_level_kode;?>" rel="detail" class="view" title="Detail <?php echo $row->admin_level_kode;?>"></a><a href="<?php echo site_url();?>pengaturan/kelompok_pengguna/edit/<?php echo $row->admin_level_kode;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>pengaturan/kelompok_pengguna/hapus/<?php echo $row->admin_level_kode;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus kelompok pengguna `<?php echo $row->admin_level_nama;?>`.');"></a></td>
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
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'pengaturan/kelompok_pengguna/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Kelompok Pengguna</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>pengaturan/kelompok_pengguna">Kelompok Pengguna</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>pengaturan/kelompok_pengguna/tambah" method="post" onSubmit="return validate()">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td><label for="admin_level_nama">Kelompok <span class="required">*</span></label></td>
    <td><input name="admin_level_nama" type="text" class="form-control input-sm" id="admin_level_nama" value="" size="30" maxlength="30"/></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/kelompok_pengguna'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Kelompok Pengguna</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>pengaturan/kelompok_pengguna">Kelompok Pengguna</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>pengaturan/kelompok_pengguna/edit" method="post" onSubmit="return validate()">
<input type="hidden" name="admin_level_kode" value="<?php echo $admin_level_kode;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td><label for="admin_level_nama" >Kelompok <span class="required">*</span></label></td>
    <td><input name="admin_level_nama" type="text" class="form-control input-sm" id="admin_level_nama" value="<?php echo $admin_level_nama; ?>" size="30" maxlength="30"/></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/kelompok_pengguna'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/default/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Kelompok Pengguna</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $admin_level->admin_level_kode;?></strong></td>
  </tr>
  <tr>
    <td width="110">Kelompok</td>
    <td>: <?php echo $admin_level->admin_level_nama;?></td>
  </tr>
</table>
</div>
</div>
<?php } ?>