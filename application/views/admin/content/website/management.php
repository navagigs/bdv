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
<h1>Management<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Management</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/management/tambah">Tambah Management</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/management">Bersihkan Pencarian</a></li>
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
        <th width="30%">NAMA</th>
        <th>TEAM</th>
        <th>FOTO</th>
        <th>TGL.POSTING</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_down[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_management('', 'management_id', 'DESC', $batas, $page, '', $like_down) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->management_nama;?></td>
        <td><?php echo $row->management_team;?></td>
        <td><img src="<?php echo base_url()."assets/images/management/kecil_".$row->management_foto;?>" width="100" height="110" /></td>
        <td><?php echo dateIndo($row->management_post);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/management_detail/<?php echo $row->management_id;?>" rel="detail" class="view" title="Detail <?php echo $row->management_nama;?>"></a>
        <a href="<?php echo site_url();?>website/management/edit/<?php echo $row->management_id;?>" class="edit" title="Edit"></a><a href="<?php echo site_url();?>website/management/hapus/<?php echo $row->management_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus Management `<?php echo $row->management_nama;?>`.');"></a></td>
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
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/management/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Management</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/management">Management</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/management/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
  <tr>
    <td width="130"><label for="management_nama" >Nama <span class="required">*</span></label></td>
    <td><input name="management_nama" type="text" class="form-control input-sm" id="management_nama" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_jabatan" >Jabatan <span class="required">*</span></label></td>
    <td><input name="management_jabatan" type="text" class="form-control input-sm" id="management_jabatan" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_team" >Team <span class="required">*</span></label></td>
    <td><select name="management_team" id="management_team" class="form-control input-sm">
    	<option value=""></option>
    	<option value="OUR MANAGAMENT TEAM">OUR MANAGAMENT TEAM</option>
    	<option value="FIND MENTORS">FIND MENTORS</option>
        </select>
    </td>
  </tr>
  <tr>
    <td colspan="4"><textarea rows="20" cols="20" id="management_deskripsi"class="form-control input-sm" name="management_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
    </td>
  </tr>
  <tr>
    <td width="130"><label for="management_fb" >Facebook </label></td>
    <td><input name="management_fb" type="text" class="form-control input-sm" id="management_fb" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_twitter" >Twitter</label></td>
    <td><input name="management_twitter" type="text" class="form-control input-sm" id="management_twitter" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_gp" >Google Plus </label></td>
    <td><input name="management_gp" type="text" class="form-control input-sm" id="management_gp" value="" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_email" >Email </label></td>
    <td><input name="management_email" type="text" class="form-control input-sm" id="management_email" value="" /></td>
  </tr>
  <tr>
    <td><label for="management_foto">Foto <span class="required">*</span></label></td>
    <td><input type="file" name="management_foto" id="management_foto"  /></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/management'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Management</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/management">Management</a></li>
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
		if (($management_foto != '') and ($key != 'management_foto')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/management/edit/<?php echo $management_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="management_id" value="<?php echo $management_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
 <tr>
    <td width="130"><label for="management_nama" >Nama <span class="required">*</span></label></td>
    <td><input name="management_nama" type="text" class="form-control input-sm" id="management_nama" value="<?php echo $management_nama;?>" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_jabatan" >Jabatan <span class="required">*</span></label></td>
    <td><input name="management_jabatan" type="text" class="form-control input-sm" id="management_jabatan" value="<?php echo $management_jabatan;?>" /></td>
  </tr>
  <?php if ($management_team){?>  
  <tr>
    <td width="130"><label for="management_team" >Team <span class="required">*</span></label></td>
    <td><select name="management_team" id="management_team" class="form-control input-sm">
    	<option value="<?php echo $management_team;?>"><?php echo $management_team;?></option>
    	<option value="OUR MANAGAMENT TEAM">OUR MANAGAMENT TEAM</option>
    	<option value="FIND MENTORS">FIND MENTORS</option>
        </select>
    </td>
  </tr>
  <?php } else {?>
  <tr>
    <td width="130"><label for="management_team" >Team <span class="required">*</span></label></td>
    <td><select name="management_team" id="management_team" class="form-control input-sm">
    	<option value=""></option>
    	<option value="OUR MANAGAMENT TEAM">OUR MANAGAMENT TEAM</option>
    	<option value="FIND MENTORS">FIND MENTORS</option>
        </select>
    </td>
  <?php } ?>
  <tr>
    <td colspan="4"><textarea rows="20" cols="20" id="management_deskripsi"class="form-control input-sm" name="management_deskripsi" ><?php echo $management_deskripsi;?></textarea><?php echo $ckeditor;?></td>
    </td>
  </tr>
  <tr>
    <td width="130"><label for="management_fb" >Facebook </label></td>
    <td><input name="management_fb" type="text" class="form-control input-sm" id="management_fb" value="<?php echo $management_fb;?>" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_twitter" >Twitter</label></td>
    <td><input name="management_twitter" type="text" class="form-control input-sm" id="management_twitter" value="<?php echo $management_twitter;?>" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_gp" >Google Plus </label></td>
    <td><input name="management_gp" type="text" class="form-control input-sm" id="management_gp" value="<?php echo $management_gp;?>" /></td>
  </tr>
  <tr>
    <td width="130"><label for="management_email" >Email </label></td>
    <td><input name="management_email" type="text" class="form-control input-sm" id="management_email" value="<?php echo $management_email;?>" /></td>
  </tr>
  <?php if ($management_foto){?>
  <tr>
    <td><label for="management_foto">Edit Foto</label></td>
    <td><input type="file" name="management_foto" id="management_foto"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/management/kecil_".$management_foto;?>" width="100"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="management_foto" >Foto <span class="required">*</span></label></td>
    <td><input type="file" name="management_foto" id="management_foto"  /></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/management'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span>Management</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $management->management_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Nama</td>
    <td>: <?php echo $management->management_nama;?></td>
  </tr>
  <tr class="awal">
    <td width="110">Jabatan</td>
    <td>: <?php echo $management->management_jabatan;?></td>
  </tr>
  <tr>
    <td width="110">Team</td>
    <td>: <?php echo $management->management_team;?></td>
  </tr>
   <tr class="awal">
    <td>Deskripsi</td>
    <td>:</td>
  </tr>
  <tr>
    <td colspan="2" ><textarea rows="20" cols="60" id="management_deskripsi" name="management_deskripsi" ><?php echo $management->management_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr class="awal">
    <td width="110">Email</td>
    <td>: <?php echo $management->management_email;?></td>
  </tr>
  <tr>
    <td width="110">Facebook</td>
    <td>: <?php echo $management->management_fb;?></td>
  </tr>
  <tr class="awal">
    <td width="110">Twitter</td>
    <td>: <?php echo $management->management_twitter;?></td>
  </tr>
  <tr>
    <td width="110">Google Plus</td>
    <td>: <?php echo $management->management_gp;?></td>
  </tr>
  
  <tr class="awal">
    <td>Foto</td>
    <td>: <img src="<?php echo base_url()."assets/images/management/kecil_".$management->management_foto;?>" width="100" ></td>
  </tr>
</table>
</div>
</div>
<?php } ?>