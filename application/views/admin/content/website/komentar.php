<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=detail]").fancybox({
				'height'			: 400,				
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
<h1>Komentar<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Komentar</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
	<div class="box-body table-responsive">  
    <?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) {?>
    <div id="massage">
    	<?php if ($this->session->flashdata('success')) { ?>
        <div class="success"><span><?php echo $this->session->flashdata('success');?></span></div>
    	<?php } else { ?>
        <div class="error"><span><?php echo $this->session->flashdata('error');?></span></div>
        <?php } ?>
    </div>
    <?php } ?>
    <div id="opration">            
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/komentar">Bersihkan Pencarian</a></li>
		</ul>
    </div>
    </div>
	<form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Komentar Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
    </tr>
    </table>
    </form>
    </div>
	<div class="box-body table-responsive">  
	<table class="table table-bordered table-striped" id="example1" >
    <thead>
    <tr>
    	<th width="30">#</th>
        <th width="150">NAMA PENGIRIM</th>
        <th>KOMENTAR</th>
        <th width="150">TANGGAL</th><th width="100"></th>
	</tr>
    </thead>
    <tbody>
    <?php 
	$i	= $page+1;
	$like_komentar[$cari]			= $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_komentar('*', 'komentar_waktu', 'DESC', $batas, $page, '', $like_komentar) as $row){
		//$status = ($row->komentar_status == 'Y')?'enable':'disable'; ?>
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->komentar_nama;?></td>
        <td><?php echo $row->komentar_deskripsi;?></td>        
        <td><?php echo dateIndo($row->komentar_waktu);?></td>
        <td align="center"><a href="<?php echo site_url();?>website/komentar_detail/<?php echo $row->komentar_id;?>" rel="detail" class="view" title="Detail <?php echo $row->komentar_nama;?>"></a><a href="<?php echo site_url();?>website/komentar/hapus/<?php echo $row->komentar_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus komentar `<?php echo $row->komentar_nama;?>`.');"></a></td>
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
    	<th colspan="6" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/komentar/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> komentar</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td width="110"><strong>Judul Berita</strong></td>
    <td>: <strong><?php echo $komentar->berita_judul;?></strong></td>
  </tr>
  <tr>
    <td>Nama Pengirim</td>
    <td>: <?php echo $komentar->komentar_nama;?></td>
  </tr>
  <tr  class="awal">
    <td>Deskripsi</td>
    <td>: <?php echo $komentar->komentar_deskripsi;?></td>
  </tr>
  <tr>
    <td>Waktu</td>
    <td>: <?php echo dateIndo($komentar->komentar_waktu).' WIB';?></td>
  </tr>  
</table>
</div>
</div>
<?php } ?>