<?php if ($action == 'view' || empty($action)){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/js/popup/jquery.fancybox-1.3.4.css" media="screen" />
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
<!-- ADMINISTRATOR-->
<?php if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('admin_level') == '1') { ?>
<section class="content-header">
<h1>Kategori<small>Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Kategori Berita</li>
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
        	<li><a class="addbttn last" href="<?php echo site_url(); ?>website/kategori/tambah/">Tambah Kategori</a></li>
        </ul>
    </div>
    <div class="bttns_clear">
    	<ul>
        	<li><a class="clrttn last"  href="<?php echo site_url(); ?>website/kategori">Bersihkan Pencarian</a></li>
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
            <th>JUDUL</th>
            <th width="100"></th>
        </tr>
       </thead>
       </tbody>
        <?php
		$i = $page+1;
		$where_kategori['admin_nama'] = $admin->admin_nama;
		$like_kategori[$cari] = $q;
		if ($jml_data > 0) {
			foreach($this->ADM->grid_all_kategori('', 'kategori_judul', 'DESC', $batas, $page , '', $like_kategori) as $row) {
		?>
        <tr>
        	<td align="center"><?php echo $i;?></td>
            <td><?php echo $row->kategori_judul;?></td>
            <td align="center">
            	<a href="<?php echo site_url();?>website/kategori_detail/<?php echo $row->kategori_id;?>" rel="detail" class="view" title="Detail <?php echo $row->kategori_judul; ?>"></a>
                <a href="<?php echo site_url();?>website/kategori/edit/<?php echo $row->kategori_id; ?>" class="edit" title="Edit"></a>
                <a href="<?php echo site_url();?>website/kategori/hapus/<?php echo $row->kategori_id; ?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus `<?php echo $row->kategori_judul;?>`.');"></a>
           </td>
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
        	<th colspan="3"  align="left">TOTAL : <?php echo $jml_data; ?>
            <span id="pages"><?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'website/kategori/view', $id=""); }?></span>
            </th>
        </tr>
        </table>
    </table>
 </div>
  <!-- END ADMINISTRATOR-->
<?php } else { ?>
<section class="content-header">
<h1>Kategori<small>Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Kategori Berita</li>
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
        	<li><a class="addbttn last" href="<?php echo site_url(); ?>website/kategori/tambah/">Tambah Kategori</a></li>
        </ul>
    </div>
    <div class="bttns_clear">
    	<ul>
        	<li><a class="clrttn last"  href="<?php echo site_url(); ?>website/kategori">Bersihkan Pencarian</a></li>
        </ul>
  </div>
  </div> <form action="" method="post" id="table">
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
            <th>JUDUL</th>
            <th width="100"></th>
        </tr>
       </thead>
       </tbody>
        <?php
		$i = $page+1;
		$where_kategori['admin_nama'] = $admin->admin_nama;
		$like_kategori[$cari] = $q;
		if ($jml_data > 0) {
			foreach($this->ADM->grid_all_kategori('', 'kategori_id', 'DESC', $batas, $page , $where_kategori, $like_kategori) as $row) {
		?>
        <tr>
        	<td align="center"><?php echo $i;?></td>
            <td><?php echo $row->kategori_judul;?></td>
            <td align="center">
            	<a href="<?php echo site_url();?>website/kategori_detail/<?php echo $row->kategori_id;?>" rel="detail" class="view" title="Detail <?php echo $row->kategori_judul; ?>"></a>
                <a href="<?php echo site_url();?>website/kategori/edit/<?php echo $row->kategori_id; ?>" class="edit" title="Edit"></a>
                <a href="<?php echo site_url();?>website/kategori/hapus/<?php echo $row->kategori_id; ?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus `<?php echo $row->kategori_judul;?>`.');"></a>
           </td>
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
        	<th colspan="3" align="left">TOTAL : <?php echo $jml_data; ?>
            <span id="pages"><?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'website/kategori/view', $id=""); }?></span>
            </th>
        </tr>
        </table>
    </table>
 </div>
<?php } ?> 
 
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Kategori Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/kategori">Kategori Berita</a></li>
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
   			function validate() {
				<?php foreach ($validate as $key => $value) { ?>
				var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
				if(<?php echo $key;?>.length==0){
					alert('<?php echo $value;?> harus diisi!');
					document.getElementById('<?php echo $key;?>').focus();
					return false;
				}
				<?php } ?>
				return true;
			}
		</script>
    <form id="formMenu" action="<?php echo site_url();?>website/kategori/tambah" method="post" onSubmit="return validate()">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
    	<tr>
        	<td width="130"><label for="kategori_judul" >Nama Kategori <span class="required">*</span></label></td>
            <td><input type="text" name="kategori_judul" class="form-control input-sm"  id="kategori_judul" value="<?php echo $kategori_judul; ?>"/></td>
        </tr>
    </table>
    <div style="padding:20px 0 0 0px; text-align:center">
    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
    <input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>website/kategori'"/>
    </div>
  </form>
</div>
</div>


<?php } elseif ($action == 'edit') { ?> 
<section class="content-header">
<h1>Edit<small>Kategori Berita</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/kategori">Kategori Berita</a></li>
   <li class="active">Edit</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-body table-responsive"> 
	<div class="formConInner">   
  		<script language="javascript">
   			function validate() {
				<?php foreach ($validate as $key => $value) { ?>
				var <?php echo $key;?> = document.getElementById('<?php echo $key;?>').value;
				if(<?php echo $key;?>.length==0){
					alert('<?php echo $value;?> harus diisi!');
					document.getElementById('<?php echo $key;?>').focus();
					return false;
				}
				<?php } ?>
				return true;
			}
		</script>
    <form id="formMenu" action="<?php echo site_url();?>website/kategori/edit/<?php echo $kategori_id; ?>" method="post" onSubmit="return validate()">
    <input type="hidden" name="kategori_id" value="<?php echo $kategori_id;?>">
<table border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover"> 
    	<tr>
        	<td width="130"><label for="kategori_judul" >Nama Kategori <span class="required">*</span></label></td>
            <td><input type="text" name="kategori_judul" class="form-control input-sm" id="kategori_judul" value="<?php echo $kategori_judul; ?>" size="40" maxlength="40" /></td>
        </tr>
   	 </table>
    <div style="padding:20px 0 0 0px; text-align:center">
    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
    <input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>website/kategori'"/>
    </div>
  </form>
</div>
</div>
 

<?php } elseif ($action == 'detail') { ?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Kategori Berita</h2>
<div class="formConInner">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
    	<tr class="awal">
            <td><strong>Kode</strong></td>
            <td>: <strong><?php echo $kategori->kategori_id; ?></strong></td>
    	</tr>
    	<tr>
        	<td width="130">Nama Kategori</td>
            <td>:<strong><?php echo  $kategori->kategori_judul; ?></strong></td>
        </tr>
    	<tr class="awal">
        	<td width="130">Warna</td>
            <td>:<strong><?php echo $kategori->kategori_warna; ?></strong></td>
        </tr>
    </table>
 </div>
</div>
    

<?php } ?>
