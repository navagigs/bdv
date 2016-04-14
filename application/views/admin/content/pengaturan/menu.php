<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 350,
				'autoScale'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'none',
				'overlayShow'		: false,
				'type'				: 'iframe'
			});
	});
</script>
<section class="content-header">
<h1>Daftar<small>Menu</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Daftar Menu</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>pengaturan/menu/tambah">Tambah Menu</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>pengaturan/menu">Bersihkan Pencarian</a></li>
		</ul>
    </div>
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Menu Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="200">NAMA MENU</th>
        <th>URL</th>
        <th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$where_menu['menu_status']	= 'A';
	$like_menu[$cari]			= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_menu('', 'menu_level', 'ASC', $batas, $page, $where_menu, $like_menu) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td><td><?php echo $row->menu_nama;?></td><td><?php echo site_url().$row->menu_url;?></td><td align="center"><a href="<?php echo site_url();?>pengaturan/menu_detail/<?php echo $row->menu_kode;?>" rel="detail" class="view" title="Detail <?php echo $row->menu_nama;?>"></a><a href="<?php echo site_url();?>pengaturan/menu/edit/<?php echo $row->menu_kode;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>pengaturan/menu/hapus/<?php echo $row->menu_kode;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus menu `<?php echo $row->menu_nama;?>`.');"></a></td>
	</tr>
    <?php 
	$i++; 
	} 
	} else { 
	?>
    <tr>
    	<td colspan="9">Belum ada data!.</td>
	</tr>
    <?php } ?>
    <tr>
    	<th colspan="9" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'pengaturan/menu/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Menu</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>pengaturan/menu">Daftar Menu</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>pengaturan/menu/tambah" method="post" onSubmit="return validate()">
<input type="hidden" name="menu_kode" value="<?php echo $menu_kode;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td><label for="menu_level" >Level Menu <span class="required">*</span></label></td>
    <td><?php array_pilihan('menu_level', $level, $menu_level, 'submit();');?></td>
  </tr>
  <tr>
    <td width="130"><label for="menu_nama" >Nama Menu <span class="required">*</span></label></td>
    <td><input name="menu_nama" type="text" id="menu_nama" value="<?php echo $menu_nama;?>" size="30" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_deskripsi" c>Deskripsi <span class="required">*</span></label></td>
    <td><input name="menu_deskripsi" type="text" id="menu_deskripsi" value="<?php echo $menu_deskripsi;?>" size="50" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_url">URL <span class="required">*</span></label></td>
    <td><input name="menu_url" type="text" id="menu_url" value="<?php echo $menu_url;?>" size="50" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_site">Sertakan Site URL <span class="required">*</span></label></td>
    <td>
    	<input type="radio" name="menu_site" value="A" id="menu_site_a" /> <label style="display: inline-block" for="menu_site_a">Ya</label>
        <input type="radio" name="menu_site" value="H" id="menu_site_b" /> <label style="display: inline-block" for="menu_site_b">Tidak</label>
    </td>
  </tr>
  <tr>
    <td><label for="menu_urutan" >Urutan <span class="required">*</span></label></td>
    <td><input name="menu_urutan" type="text" id="menu_urutan" value="<?php echo $menu_urutan;?>" size="20" maxlength="25"/></td>
  </tr>
  <?php if ($menu_level == 2) {?>
  <tr>
    <td><label for="menu_subkode">SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='1'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
  <?php } else if ($menu_level == 3) {?>
  <tr>
    <td><label for="menu_subkode">SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='2'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
   <?php } else if ($menu_level == 4) {?>
  <tr>
    <td><label for="menu_subkode">SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='3'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/menu'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Menu</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>pengaturan/menu">Daftar Menu</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>pengaturan/menu/edit" method="post" onSubmit="return validate()">
<input type="hidden" name="menu_kode" value="<?php echo $menu_kode;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td><label for="menu_level">Level Menu <span class="required">*</span></label></td>
    <td><?php array_pilihan('menu_level', $level, $menu_level, 'submit();');?></td>
  </tr>
  <tr>
    <td width="130"><label for="menu_nama" >Nama Menu <span class="required">*</span></label></td>
    <td><input name="menu_nama" type="text" id="menu_nama" value="<?php echo $menu_nama;?>" size="30" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_deskripsi" >Deskripsi <span class="required">*</span></label></td>
    <td><input name="menu_deskripsi" type="text" id="menu_deskripsi" value="<?php echo $menu_deskripsi;?>" size="50" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_url" >URL <span class="required">*</span></label></td>
    <td><input name="menu_url" type="text" id="menu_url" value="<?php echo $menu_url;?>" size="50" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="menu_site" >Sertakan Site URL <span class="required">*</span></label></td>
    <td>
    	<input type="radio" name="menu_site" value="A" id="menu_site_a" <?php echo $checked = ($menu_site == 'A')?'checked':''; ?> /> <label style="display: inline-block" for="menu_site_a">Ya</label>
        <input type="radio" name="menu_site" value="H" id="menu_site_b" <?php echo $checked = ($menu_site == 'H')?'checked':''; ?> /> <label style="display: inline-block" for="menu_site_b">Tidak</label>
    </td>
  </tr>
  <tr>
    <td><label for="menu_urutan" >Urutan <span class="required">*</span></label></td>
    <td><input name="menu_urutan" type="text" id="menu_urutan" value="<?php echo $menu_urutan;?>" size="20" maxlength="25"/></td>
  </tr>
  <?php if ($menu_level == 2) {?>
  <tr>
    <td><label for="menu_subkode" >SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='1'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
  <?php } else if ($menu_level == 3) {?>
  <tr>
    <td><label for="menu_subkode" >SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='2'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
  <?php } else if ($menu_level == 4) {?>
  <tr>
    <td><label for="menu_subkode">SubMenu dari <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='3'", 'menu_subkode', 'menu_kode', 'menu_nama', $menu_subkode);?></td>
  </tr>
  <?php } ?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/menu'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Menu</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Level Menu</strong></td>
    <td>: <?php echo $menu->menu_level;?></td>
  </tr>
  <tr>
    <td width="110">Nama Menu</td>
    <td>: <?php echo $menu->menu_nama;?></td>
  </tr>
  <tr class="awal">
    <td>Deskripsi</td>
    <td>: <?php echo $menu->menu_deskripsi;?></td>
  </tr>
  <tr>
    <td>URL</td>
    <td>: <?php echo site_url().$menu->menu_url;?></td>
  </tr>
  <tr class="awal">
    <td>Urutan</td>
    <td>: <?php echo $menu->menu_urutan;?></td>
  </tr>
</table>
</div>
</div>
<?php } elseif ($action == 'hak_akses'){ ?>
<section class="content-header">
<h1>Hak Akses<small>Kelompok</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Hak Akses Kelompok</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-body table-responsive"> 
<div id="box_center">
    <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
    <div id="massage">
    	<?php if ($this->session->flashdata('success')) { ?>
        <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
    	<?php } else { ?>
        <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="clear"></div>
<form action="" method="post" name="formHakAkses">	
	<table cellpadding="0" cellspacing="0" border="0" width="100%" id="table">
    <tr>
    	<td height="25"><span class="judul_cari">Pilih Kelompok Pengguna : </span><?php $this->ADM->combo_box("SELECT * FROM admin_level WHERE admin_level_status='A'", 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', $admin_level_kode, 'submit();');?> &nbsp; <span class="judul_cari">Pilih Menu Utama : </span><?php $this->ADM->combo_box("SELECT * FROM menu WHERE menu_status='A' AND menu_level='1' ORDER BY menu_urutan ASC", 'menu_kode', 'menu_kode', 'menu_nama', $menu_kode, 'submit();');?></td>
    </tr>
    </table>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" id="table">
     <?php
		$i = 0;
		if ($menu_kode){
			$where_pengguna['menu_kode']	= $menu_kode;
			$where_pengguna['admin_level_kode']	= $admin_level_kode;
			$lisquery = $this->db->query("SELECT * FROM menu WHERE menu_level='2' AND menu_status='A' AND menu_subkode='".$menu_kode."' ORDER BY menu_urutan ASC");
			foreach ($lisquery->result() as $list){
				$i++;	
				$where_pengguna2['menu_kode']	= $list->menu_kode;
				$where_pengguna2['admin_level_kode']	= $admin_level_kode;
				$ceklist = ($this->ADM->count_all_menu_admin($where_pengguna2) < 1) ? '' : 'checked';
				echo "<tr>";
				echo "<td class='first' style='padding-left:35px;'><input type='checkbox' id='cb".$i."' name='menu[]' value='".$list->menu_kode."' ".$ceklist.">&nbsp;<label for='cb".$i."'><span class='nm'>".$list->menu_nama."</span></label></td>";
				echo "</tr>";
				$lisquery2 = $this->db->query("SELECT * FROM menu WHERE menu_level='3' AND menu_status='A' AND menu_subkode='".$list->menu_kode."' ORDER BY menu_urutan ASC");
				foreach ($lisquery2->result() as $list2){
					$i++;	
					$where_pengguna3['menu_kode']	= $list2->menu_kode;
					$where_pengguna3['admin_level_kode']	= $admin_level_kode;
					$ceklist = ($this->ADM->count_all_menu_admin($where_pengguna3) < 1) ? '' : 'checked';
					echo "<tr>";
					echo "<td class='first' style='padding-left:60px;'><input type='checkbox' id='cb".$i."' name='menu[]' value='".$list2->menu_kode."' ".$ceklist.">&nbsp;<label for='cb".$i."'><span class='nm'>".$list2->menu_nama."</span></label></td>";
					echo "</tr>";
				}
			$i++;
			}
		} elseif ($admin_level_kode) {
			$lisquery = $this->db->query("SELECT * FROM menu WHERE menu_level='1' AND menu_status='A' ORDER BY menu_urutan ASC");
			foreach ($lisquery->result() as $list){	
				$where_pengguna2['menu_kode'] = $list->menu_kode;
				$where_pengguna2['admin_level_kode'] = $admin_level_kode;
				$ceklist = ($this->ADM->count_all_menu_admin($where_pengguna2) < 1) ? '' : 'checked';
				echo "<tr>";
				echo "<td class='first' style='padding-left:35px;'><input type='checkbox' id='cb".$i."' name='menu[]' value='".$list->menu_kode."' ".$ceklist.">&nbsp;<label for='cb".$i."'><span class='nm'>".$list->menu_nama."</span></label></td>";
				echo "</tr>";
			$i++;
			}
		}
	?>
	</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Perubahan" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/hak_akses'"/></div>
</form>
</div>
<?php } ?>