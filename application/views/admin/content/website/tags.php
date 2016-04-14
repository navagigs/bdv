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
<section class="content-header">
<h1>Tags<small></small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Tags</li>
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
    <div class="bttns_add">
    	<ul>
			<li><a class="addbttn last" href="<?php echo site_url();?>website/tags/tambah">Tambah Tags</a></li>
		</ul>
    </div>
    <div class="bttns_clear">
    	<ul>
			<li><a class="clrttn last" href="<?php echo site_url();?>website/tags">Bersihkan Pencarian</a></li>
		</ul>
    </div>
    </div>
	<form action="" method="post" id="table">
	<table class="example1">
    <tr>
    	<td height="25"><span class="judul_cari">Cari Tags Berdasarkan : </span><?php array_pilihan('cari', $berdasarkan, $cari);?> &nbsp; <input type="text" name="q" class="text" size="40" value="<?php echo $q;?>"/><input type="submit" name="kirim" class="seach" value=""/></td>
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
    <tbody>
    <?php 
	$i	= $page+1;
	$like_tag[$cari] = $q;
	if ($jml_data > 0){
	foreach ($this->ADM->grid_all_tags('*', 'tag_judul', 'ASC', $batas, $page, '', $like_tag) as $row){
	?>
    <!--
    <tr>
    	<td align="center"><?php echo $i;?></td><td><?php echo $row->tag_judul;?></td><td align="center"><a href="<?php echo site_url();?>website/tags_detail/<?php echo $row->tag_id;?>" rel="detail" class="view" title="Detail <?php echo $row->tag_judul;?>"></a><a href="<?php echo site_url();?>website/tags/edit/<?php echo $row->tag_id;?>" class="edit" title="edit"></a><a href="<?php echo site_url();?>website/tags/hapus/<?php echo $row->tag_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus tags `<?php echo $row->tag_judul;?>`.');"></a></td>
	</tr>
    -->
    <tr>
    	<td align="center"><?php echo $i;?></td>
        <td><?php echo $row->tag_judul;?></td>
        <td align="center"><a href="<?php echo site_url();?>website/tags_detail/<?php echo $row->tag_id;?>" rel="detail" class="view" title="Detail <?php echo $row->tag_judul;?>"></a>   
            <a href="<?php echo site_url();?>website/tags/edit/<?php echo $row->tag_id;?>" class="edit" title="edit"></a>
            <a href="<?php echo site_url();?>website/tags/hapus/<?php echo $row->tag_id;?>" class="delete" title="Hapus" onclick="return confirm('Apakah anda yakin? \nAkan menghapus tags `<?php echo $row->tag_judul;?>`.');"></a></td>
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
    	<th colspan="3" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/tags/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>
<?php } elseif ($action == 'tambah') { ?>
<section class="content-header">
<h1>Tambah<small>Tags</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/tags">Tags</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/tags/tambah" method="post" onSubmit="return validate()">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
  <tr>
    <td width="130"><label for="tag_judul">Nama Tags<span class="required">*</span></label></td>
    <td><input name="tag_judul" type="text" id="tag_judul" class="form-control input-sm" value="<?php echo $tag_judul;?>" size="30" maxlength="30"/></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/tags'"/></div>
</form>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
<?php } elseif ($action == 'edit') { ?><section class="content-header">
<h1>Edit<small>Tags</small></h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="<?php echo base_url();?>website/tags">Tags</a></li>
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
<form id="formMenu" action="<?php echo site_url();?>website/tags/edit/<?php echo $tag_id;?>" method="post" onSubmit="return validate()">
<input type="hidden" name="tag_id" value="<?php echo $tag_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
  <tr>
    <td width="130"><label for="tag_judul">Nama Tags<span class="required">*</span></label></td>
    <td><input name="tag_judul" type="text" id="tag_judul" class="table table-bordered table-hover" value="<?php echo $tag_judul;?>" size="30" maxlength="30"/></td>
  </tr>  
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-primary" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>website/tags'"/></div>
</form>
</div>
</div>
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="formCon" style="margin-top:30px;width:85%;">
<h2><span>Detail.</span> Tags</h2>
<div class="formConInner">
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
  <tr class="awal">
    <td><strong>ID Tag</strong></td>
    <td>: <strong><?php echo $tag->tag_id;?></strong></td>
  </tr>
  <tr>
    <td width="110">Nama Tag</td>
    <td>: <?php echo $tag->tag_judul;?></td>
  </tr>  
</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
<?php } ?>