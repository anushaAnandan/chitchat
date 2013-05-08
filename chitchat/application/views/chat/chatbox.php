<html>
<head>
<title>Chat</title>
<?php echo smiley_js(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Chat with <?php echo $chatwith;?></p>
<div style="margin:0 auto;padding-bottom:25px;background:green;width:504px;border:1px solid #ACD8F0; ">
	<div id="menu" style="padding:12.5px 25px 12.5px 25px;">
		<p class="welcome">Welcome, <b><?php $username; ?></b></p>
		<p class="logout"><a id="exit" href="chatcontroller/logout">Exit Chat</a></p>
		<div style="clear:both"></div>
	</div>	
	<div id="chatbox" style="text-align:left;margin:0 auto;margin-bottom:25px;padding:10px;background:#fff;height:270px;width:430px;border:1px solid #ACD8F0;overflow:auto;">
	<?php
	echo $string;
	?></div>
	
	<!--<form name="message" action="">-->
	<?php echo form_open('chatcontroller/fileupdate') ?>
		<input name="usermsg" type="text" id="usermsg" size="63" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
</div>

<!--<script type="text/javascript" src="<?php echo base_url();?>chat/refresh.js" ></script>-->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user submits the form
	$(document.forms[0]).submit(function(e){	
		e.preventDefault();
		var clientmsg = $("#usermsg").val();
		$.post("fileupdate", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	var filename='../../chatlogs/'+'<?php echo $filename; ?>';
	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		$.ajax({
			url: filename,
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
	setInterval (loadLog, 2500);	//Reload file every 2.5 seconds
	
});
</script>

</body>
</html>
