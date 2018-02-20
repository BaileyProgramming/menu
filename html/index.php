<!doctype html>
<?php
	$str = file_get_contents("menu.json") or die("Unable to open file!");
	$json = json_decode($str, true);
?>
<html>
<head>
<meta charset="utf-8">
<title>cafeteria menu</title>
<style type="text/css">
	body {
   /* background-image: url("Special.jpg");
    color: #000000; */
    font-size: 16px;
	}
	.header{
		height: 400px;
		margin-bottom: 20px;
	}
	.menu_item {
		margin-left: 600px;
		margin-bottom: 25px;
    	margin-top: 25px;
	}
	.single_item {
		/*margin-left: 600px;*/
		margin-bottom: 25px;
    	margin-top: 25px;
		padding: 30px;
		/*height: 650px;*/
		text-align: center;
	}
</style>
</head>
<body>
	<div id='header' class="header"></div>
	
		<?php
			//echo date("Y-m-d") . " <br />";
			 foreach($json as $item){
				 ?><div class="single_item"><?
				echo $item[1] . " " . $item[2];
				 ?></div><?
			}
		//print_r($json);
		?>
	
&nbsp;
</body>
</html>
