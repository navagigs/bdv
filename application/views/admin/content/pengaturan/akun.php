<h1>Informasi Daftar Pengguna</h1><div class="clear"></div>
<div class="formCon" style="margin-top:30px;">
<h2><span>Edit.</span> Pengguna</h2>
<div class="formConInner">
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
<form id="formMenu" action="<?php echo site_url();?>pengaturan/pengguna/edit" method="post" onSubmit="return validate()">
<input type="hidden" name="admin_user" value="<?php echo $admin_user;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><label for="admin_user" class="required">Pengguna <span class="required">*</span></label></td>
    <td><input name="admin_user" type="text" id="admin_user" value="<?php echo $admin_user; ?>" readonly="readonly" size="30" maxlength="25"/></td>
  </tr>
  <tr>
    <td width="130"><label for="admin_pass" class="required">Ganti Kata Kunci <span class="required">*</span></label></td>
    <td><input name="admin_pass" type="password" id="admin_pass" value="" size="30" maxlength="50"/></td>
  </tr>
  <!-- 
  <tr>
    <td width="130"><label for="admin_pass_ulang" class="required">Ulangi Kata Kunci <span class="required">*</span></label></td>
    <td><input name="admin_pass_ulang" type="password" id="admin_pass_ulang" value="" size="30" maxlength="50"/></td>
  </tr>
  -->	
  <tr>
    <td width="130"><label for="admin_nama" class="required">Nama Lengkap <span class="required">*</span></label></td>
    <td><input name="admin_nama" type="text" id="admin_nama" value="<?php echo $admin_nama; ?>" size="30" maxlength="30"/></td>
  </tr>
  <tr>
    <td width="130"><label for="admin_alamat" class="required">Alamat <span class="required">*</span></label></td>
    <td><input name="admin_alamat" type="text" id="admin_alamat" value="<?php echo $admin_alamat; ?>" size="50" maxlength="255"/></td>
  </tr>
  <tr>
    <td width="130"><label for="admin_telepon" class="required">Telepon <span class="required">*</span></label></td>
    <td><input name="admin_telepon" type="text" id="admin_telepon" value="<?php echo $admin_telepon; ?>" size="15" maxlength="15"/></td>
  </tr>
  <tr>
    <td><label for="admin_level_kode" class="required">Kelompok <span class="required">*</span></label></td>
    <td><?php $this->ADM->combo_box("SELECT * FROM admin_level WHERE admin_level_status='A'", 'admin_level_kode', 'admin_level_kode', 'admin_level_nama', $admin_level_kode, 'submit();');?></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="formbut" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="formbut" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/pengguna'"/></div>
</form>
</div>
</div>