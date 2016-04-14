<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>LOGIN | <?php echo strtoupper($web->identitas_website);?></title>
        <meta name="description" content="<?php echo $web->identitas_deskripsi;?>" />
        <meta name="keywords" content="<?php echo $web->identitas_keyword;?>" />
        <meta name="author" content="<?php echo $web->identitas_author;?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>" sizes="16x16" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>templates/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>templates/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>templates/admin/css/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body onLoad="document.getElementById('user').focus()" class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><img src="<?php echo base_url();?>templates/admin/img/logo_bdv.png"></div>
<form action="<?php echo site_url();?>wp_login/ceklogin" method="post" name="formLogin" id="form" onSubmit="return validate()">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" id="user" class="form-control"onblur="clearText(this)" onfocus="clearText(this)" placeholder="Username"autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="pass" class="form-control" onblur="clearText(this)" onfocus="clearText(this)" placeholder="Password" autocomplete="off"/>
                    </div>          
                    <div class="form-group">
                    <p align="right">
<?php echo $captcahImage; ?>
<input type="text" name="captcha" id="captcha" class="form-captcha" size="23" onblur="clearText(this)" placeholder="Captcha" onfocus="clearText(this)"  autocomplete="off"/></p>
 </div>
                </div>
                <div class="footer">                                                           
			<input type="submit" class="btn btn-primary btn-block" name="masuk" value="Login"/>
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>templates/admin/js/bootstrap.min.js" type="text/javascript"></script>        
		<script language="javascript">
        function validate(){
            var username = document.getElementById('user').value;
            var password = document.getElementById('pass').value;
            var captcha = document.getElementById('captcha').value;
            if (username.length==0){
                alert ('Username harap diisi!');
                document.getElementById('user').focus();
                return false;
            }
            if (password.length==0){
                alert ('Password harap diisi!');
                document.getElementById('pass').focus();
                return false;
            }
            if (captcha.length==0){
                alert ('Captcha harap diisi!');
                document.getElementById('captcha').focus();
                return false;
            }
            return true;
        }
        function clearText(field)
        {
            if (field.defaultValue == field.value) field.value = '';
            else if (field.value == '') field.value = field.defaultValue;
         }
         
        </script>
    </body>
</html>
