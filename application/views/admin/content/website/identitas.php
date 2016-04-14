<section class="content-header">
<h1>Identitas<small>website</small>  </h1>
<ol class="breadcrumb">
   <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Identitas website</li>
</ol>
</section>
<?php if ($action == 'view' || empty($action)){ ?>
<?php } elseif ($action == 'edit') { ?>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
<div class="box-body table-responsive">
<?php if ($this->session->flashdata('success') || $this->session->flashdata('error')) { ?>
<div id="massage" >
	<?php if ($this->session->flashdata('success')) { ?>
    <div class="success"><span><?php echo $this->session->flashdata('success'); ?></span></div>
    <?php } else { ?>
    <div class="error"><span><?php echo $this->session->flashdata('error'); ?></span></div>
    <?php } ?>
</div>    
<?php } ?>
<form  role="form" id="formMenu" action="<?php echo site_url();?>website/identitas/edit/<?php echo $identitas_id;?>" method="post" onSubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="identitas_id" value="<?php echo $identitas_id;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered table-hover">
	<tr>
    	<td><label for="identitas_website">Nama Website <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_website" class="form-control input-sm" id="identitas_website" value="<?php echo $identitas_website; ?>" /></td>
    </tr>	
	<tr>
    	<td><label for="identitas_deskripsi" >Meta Deskripsi <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_deskripsi" class="form-control input-sm" id="identitas_deskripsi" value="<?php echo $identitas_deskripsi; ?>" size="100"  /></td>
    </tr>
	<tr>
    	<td><label for="identitas_keyword">Meta Keyword <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_keyword" class="form-control input-sm" id="identitas_keyword" value="<?php echo $identitas_keyword; ?>" size="100" /></td>
    </tr>
	<tr>
    	<td><label for="identitas_alamat">Alamat <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_alamat" class="form-control input-sm" id="identitas_alamat" value="<?php echo $identitas_alamat; ?>" size="50" /></td>
    </tr>
	<tr>
    	<td><label for="identitas_notelp">No.Telepon <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_notelp"  class="form-control input-sm" id="identitas_notelp" value="<?php echo $identitas_notelp; ?>" size="20" maxlength="15" /></td>
    </tr>
	<tr>
    	<td><label for="identitas_email">Email <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_email" class="form-control input-sm" id="identitas_email" value="<?php echo $identitas_email; ?>" size="50" /></td>
    </tr>	
	<tr>
    	<td><label for="identitas_fb">Facebook <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_fb" class="form-control input-sm" id="identitas_fb" value="<?php echo $identitas_fb; ?>" size="50"  /></td>
    </tr>
	<tr>
    	<td><label for="identitas_tw">Twitter <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_tw" class="form-control input-sm" id="identitas_tw" value="<?php echo $identitas_tw; ?>" size="50"  /></td>
    </tr>	
	<tr>
    	<td><label for="identitas_gp">Google Plus <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_gp" class="form-control input-sm" id="identitas_gp" value="<?php echo $identitas_gp; ?>" size="50" /></td>
    </tr>
	<tr>
    	<td><label for="identitas_yb" >Youtube <span class="required">*</span></label></td>
        <td><input type="text" name="identitas_yb" class="form-control input-sm" id="identitas_yb" value="<?php echo $identitas_yb; ?>" size="50" /></td>
    </tr>
  <?php if ($identitas_favicon){?>
	<tr>
    	<td><label for="identitas_favicon">Favicon </label></td>
        <td><img src="<?php echo base_url(); ?>assets/<?php echo $identitas_favicon; ?>" width="50" /></td>
    </tr>
	<tr>
    	<td><label for="identitas_favicon">Ganti Favicon <span class="required">*</span></label></td>
        <td><input type="file" name="identitas_favicon" class="form-control input-sm" id="identitas_favicon" size="30" maxlength="100" /></td>
    </tr>
  <?php } else {?>
	<tr>
    	<td><label for="identitas_favicon">Favicon <span class="required">*</span></label></td>
        <td><input type="file" name="identitas_favicon" class="form-control input-sm" id="identitas_favicon" size="30" maxlength="100" /></td>
    </tr> 
  
  <?php }?>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" /></div>
</form>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
</section><!-- /.content -->
 <?php } ?>