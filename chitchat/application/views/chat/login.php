<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Sign in</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<div align="center" style="margin:25 auto;padding-bottom:20px;background:green;width:200px;border:1px solid #ACD8F0">
<?php echo validation_errors(); ?>

<?php echo form_open('chatcontroller/formsubmit') ?>
  <div align="center" style="color:white"><p>Username: 
    <input type="text" name="username" >
  </p>
  <p>Password: 
    <input type="password" name="password">
  </p>
  <p>
    <input name="Input" type="submit" value="Log in" >
        <input type="submit" name="Input" value="Register" >
  </p>
  </div>
</form>
</div>
</body>
</html>
