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
<h1>Agenda<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Agenda</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/agenda/tambah">Tambah Agenda</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/agenda">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Agenda Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="423">TEMA</th>
        <th width="225">TEMPAT</th>
        <th width="269">TANGGAL</th>
        <th width="120"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_agenda[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_agenda('*', 'agenda_tema', 'ASC', $batas, $page, '', $like_agenda) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td class="capitalize"><?php echo $row->agenda_tema;?></td>
        <td class="capitalize"><?php echo $row->agenda_tempat;?></td>
        <td><?php echo dateIndo($row->agenda_mulai).' s/d '.dateIndo($row->agenda_selesai);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/agenda/report_join/<?php echo $row->agenda_id;?>" class="user_ikut" title="Report data Joins"></a>
        <a href="<?php echo site_url();?>website/agenda_detail/<?php echo $row->agenda_id;?>" rel="detail" class="view" title="Detail <?php echo $row->agenda_id;?>"></a>
        
        <a href="<?php echo site_url();?>website/agenda/edit/<?php echo $row->agenda_id;?>" class="edit" title="Edit"></a><a href="<?php echo site_url();?>website/agenda/hapus/<?php echo $row->agenda_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus agenda `<?php echo $row->agenda_tema;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/agenda/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>
<!-- END ADMINISTRATOR-->
<?php } else { ?><section class="content-header">
<h1>Agenda<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Agenda</li>
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
			<li><a class="addbttn last" href="<?php echo site_url();?>website/agenda/tambah">Tambah Agenda</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/agenda">Bersihkan Pencarian</a></li>
		</ul>
    </div>    
    </div>
    <form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Agenda Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="30" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="423">TEMA</th>
        <th width="225">TEMPAT</th>
        <th width="269">TANGGAL</th>
        <th width="120"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$where_agenda['admin_nama'] = $admin->admin_nama;
	$like_agenda[$cari]	= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_agenda('*', 'agenda_tema', 'ASC', $batas, $page, $where_agenda, $like_agenda) as $row){
	?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td class="capitalize"><?php echo $row->agenda_tema;?></td>
        <td class="capitalize"><?php echo $row->agenda_tempat;?></td>
        <td><?php echo dateIndo($row->agenda_mulai).' s/d '.dateIndo($row->agenda_selesai);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/agenda_detail/<?php echo $row->agenda_id;?>" rel="detail" class="view" title="Detail <?php echo $row->agenda_id;?>"></a>
        
        <a href="<?php echo site_url();?>website/agenda/edit/<?php echo $row->agenda_id;?>" class="edit" title="Edit"></a><a href="<?php echo site_url();?>website/agenda/hapus/<?php echo $row->agenda_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus agenda `<?php echo $row->agenda_tema;?>`.');"></a></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/agenda/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>
<?php } ?>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Agenda</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/agenda">Agenda</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/agenda/tambah" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="agenda_tema" >Tema Agenda <span class="required">*</span></label></td>
    <td><input name="agenda_tema" type="text" id="agenda_tema" value="" class="form-control input-sm" size="80" maxlength="255"/></td>
  </tr>
  <tr>
    <td colspan="4"><textarea rows="20" cols="20" id="agenda_deskripsi"class="form-control input-sm" name="agenda_deskripsi" ><p>Deskripsi <span style="color:#ff0000;">*</span></p></textarea><?php echo $ckeditor;?></td>
    </td>
  </tr>
  <tr>
    <td><label for="agenda_gambar">Gambar <span class="required">*</span></label></td>
    <td><input type="file" name="agenda_gambar" id="agenda_gambar"  /></td>
  </tr>
  <tr>
    <td><label for="agenda_mulai" >Tanggal Mulai <span class="required">*</span></label></td>
    <td width="150"><input name="agenda_mulai" type="text" id="agenda_mulai" value="" size="15" maxlength="15" readonly="readonly"/><label for="agenda_selesai" >s/d</label><input name="agenda_selesai" type="text" id="agenda_selesai" value="" size="15" maxlength="15" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><label for="agenda_tempat" >Tempat <span class="required">*</span></label></td>
    <td colspan="3"><input name="agenda_tempat" class="form-control input-sm" type="text" id="agenda_tempat" value="" size="30" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="agenda_jam" >Pukul <span class="required">*</span></label></td>
    <td colspan="3"><input name="agenda_jam" class="form-control input-sm" type="text" id="agenda_jam" value="" size="30" maxlength="225"/></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/agenda'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'edit') { ?>
<section class="content-header">
<h1>Edit<small>Agenda</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/agenda">Agenda</a></li>
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
		if (($agenda_gambar != '') and ($key != 'agenda_gambar')) {
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
<form id="formMenu" action="<?php echo site_url();?>website/agenda/edit/<?php echo $agenda_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="agenda_id" value="<?php echo $agenda_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">  
  <tr>
    <td width="130"><label for="agenda_tema">Tema Agenda <span class="required">*</span></label></td>
    <td colspan="3" ><input name="agenda_tema" type="text" class="form-control input-sm"  id="agenda_tema" value="<?php echo $agenda_tema;?>" /></td>
  </tr>
  <tr>
    <td colspan="4"><textarea rows="20" cols="60" id="agenda_deskripsi" name="agenda_deskripsi" ><?php echo $agenda_deskripsi;?></textarea>
    <?php echo $ckeditor;?>
    </td>
  </tr>
  <?php if ($agenda_gambar){?>
  <tr>
    <td><label for="agenda_gambar">Edit Gambar</label></td>
    <td><input type="file" name="agenda_gambar" id="agenda_gambar"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php echo base_url()."assets/images/agenda/kecil_".$agenda_gambar;?>"/></td>
  </tr>
  <?php } else {?>
  <tr>
    <td><label for="agenda_gambar">Gambar</label></td>
    <td><input type="file" name="agenda_gambar" id="agenda_gambar"  /></td>
  </tr>
  <?php } ?>
  <tr>
    <td><label for="agenda_mulai">Tanggal Mulai <span class="required">*</span></label></td>
    <td width="150"><input name="agenda_mulai" type="text" id="agenda_mulai" value="<?php echo dateIndo4($agenda_mulai);?>" size="15" maxlength="15" readonly="readonly"/><label for="agenda_selesai">s/d</label>
    <input name="agenda_selesai" type="text" id="agenda_selesai" value="<?php echo dateIndo4($agenda_selesai);?>" size="15" maxlength="15" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><label for="agenda_tempat">Tempat <span class="required">*</span></label></td>
    <td colspan="3"><input name="agenda_tempat" type="text" id="agenda_tempat" value="<?php echo $agenda_tempat;?>" size="30" maxlength="255"/></td>
  </tr>
  <tr>
    <td><label for="agenda_jam">Pukul <span class="required">*</span></label></td>
    <td colspan="3"><input name="agenda_jam" type="text" id="agenda_jam" value="<?php echo $agenda_jam;?>" size="30" maxlength="255"/></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/agenda'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Agenda</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>Kode</strong></td>
    <td>: <strong><?php echo $agenda->agenda_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Tema Agenda</td>
    <td>: <?php echo $agenda->agenda_tema;?></td>
  </tr>
  
  <tr class="awal">
    <td>Deskripsi</td>
    <td>:</td>
  </tr>
  <tr>
    <td colspan="2" ><textarea rows="20" cols="60" id="berita_deskripsi" name="agenda_deskripsi" ><?php echo $agenda->agenda_deskripsi;?></textarea><?php echo $ckeditor;?></td>
  </tr>
  <tr>
    <td>Tanggal Mulai </td>
    <td>: <?php echo dateIndo($agenda->agenda_mulai). " s/d ".dateIndo($agenda->agenda_selesai);?></td>
  </tr>
  <tr class="awal">
    <td>Tempat</td>
    <td>: <?php echo $agenda->agenda_tempat;?></td>
  </tr>
  <tr>
    <td>Pukul</td>
    <td>: <?php echo $agenda->agenda_jam;?></td>
  </tr>
  <tr class="awal">
    <td>Gambar</td>
    <td> <img src="<?php echo site_url();?>assets/images/agenda/<?php echo $agenda->agenda_gambar;?>" style="height: 200px" /></td>
  </tr>
</table>
</div>
</div>
<?php } elseif ($action == 'report_join') { ?>
<section class="content-header">
<h1>Join Events<small><?php $agenda_tema; ?></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/agenda">Agenda</a></li>
   <li class="active">Join Events</li>
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
    
    </div>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30" >#</th>
        <th width="150">NAMA PENGIKUT EVENTS</th>
        <th width="423">TEMA EVENTS YANG DIIKUTI</th>
        <th width="150">TANGGAL MENGIKUTI</th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= 1;
    $where_join['j.agenda_id'] = $agenda_id;
    if ($jml_data > 0){
     foreach ($this->ADM->grid_all_join_event('*', 'join_id', 'DESC', 10, '', $where_join, '') as $row){
	?>
    <tr>
    	<td><?php echo $i;?></td>
        <td class="capitalize"><?php echo $row->join_nama;?></td>
        <td class="capitalize"><?php echo $row->agenda_tema;?></td>
        <td class="capitalize"><?php echo dateIndo($row->join_waktu);?></td>
	</tr>
    <?php 
	$i++; 
	} 
	} else { 
	?>
    <tr>
    	<td colspan="6">Belum ada yang mengikuti Events!.</td>
	</tr>
    <?php } ?>
    <tr>
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/agenda/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>

<?php } ?>

