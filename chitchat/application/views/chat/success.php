<html>
<head>
<title>Logged in</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Welcome,<?php echo $username; ?></p><a href="chatcontroller/logout" onClick="chatcontroller/logout">Logout</a>
<div align="center" style="color:white;margin:25 auto;padding-bottom:20px;background:green;width:200px;border:1px solid #ACD8F0">
	<?php echo form_open('chatcontroller/beginchat') ?>
	<h2 style="color:red">Contact List</h2>
	<?php foreach ($contacts as $item):?>
	<br><input name="chat" type="submit" value="<?php echo $item['username']; ?>">
	<?php endforeach;?>
</form>
</div>
</body>
</html>
