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
    	<th width="30">#</th>
        <th width="150">NAMA</th>
        <th width="423">TEMA</th>
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
    	<td align="center"><?php echo $i;?></td>
        <td class="capitalize"><?php echo $row->join_id;?></td>
        <td class="capitalize"><?php echo $row->admin_nama;?></td>
        <td class="capitalize"><?php echo $row->agenda_tema;?></td>
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
    	<th colspan="5" align="left">TOTAL : <?php echo $jml_data;?><span id="pages"><?php if ($jml_halaman > 1){ echo pages($halaman, $jml_halaman, 'website/agenda/view', $id=""); }?></span></th>
	</tr>
    </tbody>
	</table>
    </div>
</div>