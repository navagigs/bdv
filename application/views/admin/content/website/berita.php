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
  <!-- ADMINISTRATOR-->
<?php if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '1') { ?>
<section class="content-header">
<h1>Berita<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Berita</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/berita/tambah">Tambah Berita</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/berita">Bersihkan Pencarian</a></li>
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
        <th>JUDUL</th>
        <th width="200">KATEGORI</th>
        <th width="200">PEMBUAT</th>
        <th width="150">TANGGAL</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$where_berita['admin_nama'] = $admin->admin_nama;
	$like_berita[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_berita('', 'berita_waktu', 'DESC', $batas, $page, '', $like_berita) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->berita_judul;?></td>
        <td><?php echo $row->kategori_judul;?></td>
        <td><?php echo $row->admin_nama;?></td>
        <td><?php echo dateIndo($row->berita_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/berita_detail/<?php echo $row->berita_id;?>" rel="detail" class="view" title="Detail <?php echo $row->berita_judul;?>"></a><a href="<?php echo site_url();?>website/berita/edit/<?php echo $row->berita_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/berita/hapus/<?php echo $row->berita_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus Berita `<?php echo $row->berita_judul;?>`.');"></a></td>
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
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/berita/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
  <!-- END ADMINISTRATOR-->
<?php }  else { ?>
<section class="content-header">
<h1>Berita<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Berita</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/berita/tambah">Tambah Berita</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/berita">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
	<form action="" method="post" id="table">
	<table class="example1">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" id="table">
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
        <th>JUDUL</th>
        <th width="150">TANGGAL</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$where_berita['admin_nama'] = $admin->admin_nama;
	$like_berita[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_berita2('', 'berita_waktu', 'DESC', $batas, $page, $where_berita, $like_berita) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->berita_judul;?></td>
        <td><?php echo dateIndo($row->berita_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/berita_detail/<?php echo $row->berita_id;?>" rel="detail" class="view" title="Detail <?php echo $row->berita_judul;?>"></a><a href="<?php echo site_url();?>website/berita/edit/<?php echo $row->berita_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/berita/hapus/<?php echo $row->berita_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus Berita `<?php echo $row->berita_judul;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/berita/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } ?> 

<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/berita">Berita</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/berita/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="berita_id" value="<?php echo $berita_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="berita_judul" >Judul <span class="required">*</span></label></td>
    <td><input name="berita_judul" type="text" id="berita_judul" class="form-control input-sm" value="" size="80" maxlength="100"/></td>
  </tr>
  <tr>
    <td><label for="kategori_id">Kategori <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM kategori", 'kategori_id', 'kategori_id', 'kategori_judul', $kategori_id);?></td>
  </tr>
  <tr>
    <td><label for="headline">Headline </label></td>
    <td><input type="radio" name="headline" value="Y" id="aktif"/> <label for="aktif" style="display:inline-block">Ya</label> <input type="radio" name="headline" value="N" id="tidak_aktif" checked="checked"/> <label for="tidak_aktif" style="display:inline-block">Tidak</label></td>
  </tr>
  <tr>
    <td colspan="2"><textarea rows="20" cols="20" id="berita_deskripsi" name="berita_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td><label for="berita_gambar" >Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="berita_gambar" id="berita_gambar"  /></td>
  </tr>
  <tr>
    <td valign="top"><label for="tag_id" >Tags</label></td>
    <td><?php $this->ADM->checkbox("SELECT * FROM tags ORDER BY tag_judul ASC", 'tag[]', 'tag_id', 'tag_judul', $tags);?></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/berita'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/berita">Berita</a></li>
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
		if (($berita_gambar != '') and ($key != 'berita_gambar')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/berita/edit/<?php echo $berita_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="berita_id" value="<?php echo $berita_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="berita_judul">Judul <span class="required">*</span></label></td>
    <td><input name="berita_judul" type="text" class="form-control input-sm" id="berita_judul" value="<?php echo $berita_judul;?>" size="80" maxlength="100"/></td>
  </tr>
  <tr>
    <td><label for="kategori_id">Kategori <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM kategori ORDER BY kategori_judul ASC", 'kategori_id', 'kategori_id', 'kategori_judul', $kategori_id);?></td>
  </tr>
  <tr>
    <td><label for="headline">Headline </label></td>
    <td><input type="radio" name="headline" value="Y" id="aktif" <?php echo $yes = ($headline=='Y')?'checked':'';?>/> <label for="aktif" style="display:inline-block">Ya</label> <input type="radio" name="headline" value="N" id="tidak_aktif" <?php echo $no = ($headline=='N')?'checked':'';?>/> <label for="tidak_aktif" style="display:inline-block">Tidak</label></td>
  </tr>
  <tr>
    <td colspan="2"><textarea rows="40" cols="60" id="berita_deskripsi" name="berita_deskripsi" ><?php echo $berita_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <?php if ($berita_gambar){?>
  <tr>
    <td><label for="berita_gambar">Edit Gambar</label></td>
    <td><input type="file" name="berita_gambar" id="berita_gambar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/berita/kecil_".$berita_gambar;?>"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="berita_gambar">Gambar</label></td>
    <td><input type="file" name="berita_gambar" id="berita_gambar"  /></td>
  </tr>
  <?php } ?>
  <tr>
    <td valign="top"><label for="tag">Tags</label></td>
    <td><?php $this->ADM->checkbox("SELECT * FROM tags ORDER BY tag_judul ASC", 'tag[]', 'tag_id', 'tag_judul', $tags);?></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/berita'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:90%;">
<h2><span>Detail.</span> Berita</h2>
<div class="formConInner">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $berita->berita_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Judul</td>
    <td>: <?php echo $berita->berita_judul;?></td>
  </tr>
  <tr class="awal">
    <td>Kategori</td>
    <td>: <?php echo $berita->kategori_judul;?></td>
  </tr>

  <tr>
    <td>Headline</td>
    <td>: <?php echo ($berita->headline == 'Y')?'Ya':'Tidak'; ?></td>
  </tr>
  <tr class="awal">
    <td>Deskripsi</td>
    <td>:</td>
  </tr>
  <tr>
    <td colspan="2" ><textarea rows="20" cols="60" id="berita_deskripsi" name="berita_deskripsi" ><?php echo $berita->berita_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr class="awal">
    <td>Gambar</td>
    <td>: <img src="<?php echo base_url()."assets/images/berita/kecil_".$berita->berita_gambar;?>"/></td>
  </tr>
  <tr>
  	<td>Tags</td>
    <td>: <div style="display: inline-block "><?php $this->ADM->listarray("SELECT * FROM tags ORDER BY tag_judul ASC", 'tag[]', 'tag_id', 'tag_judul', $berita->tags);?></div></td>
  </tr>
</table>
</div>
</div>
<?php } ?>