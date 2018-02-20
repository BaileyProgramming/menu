<?php
$filename = "menu.json";
//if(isset($_REQUEST['submit'])){
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$data = array($_REQUEST['date'],$_REQUEST['item'],$_REQUEST['price']);		
	if (is_numeric($_REQUEST['objindex'])){
		exec('curl -d {"{Update:[' . $data .  ', index:' . $_REQUEST['objindex'] . '}" -H "Content-Type: application/json" -X POST api.class.baileyprogramming.com/menu');
		update_json($data, $_REQUEST['objindex']);
	}else{
		//exec('curl -d {"{' . $data .  ', ' . $_REQUEST['objindex'] . '}" -H "Content-Type: application/json" -X POST api.class.baileyprogramming.com/menu');
		echo "{'" . $data .  "', '" . $_REQUEST['objindex'] . "'}";
		append_json($data);
	}
	
	//header( 'Location:edit.php' ) ;
}else{
?>
<!doctype html>
<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--<link href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css">
<script type="text/javascript" src="bootstrap-4.0.0-alpha.6-dist/js/jquery-3.0.0.slim.min.js"></script>
<script type="text/javascript" src="bootstrap-4.0.0-alpha.6-dist/js/bootstrap.min.js"></script>-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script>
function fillform(key,itemdate,itemtxt,itemprice){
	document.getElementById('objindex').value = key;
	document.getElementById('date').value = itemdate;
	document.getElementById('item').value = itemtxt;
	document.getElementById('price').value = itemprice;
}	
</script>

<title>Edit Menu</title>
</head>

<body>
<form id="form1" name="form1" method="post">
<div class="container">
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<!-- Brand -->
<a class="navbar-brand" href="#">Menu</a>

<!-- Links -->
<div class="collapse navbar-collapse" id="nav-content">   
<!--<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a class="nav-link" href="#">Link 1</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Link 2</a>
</li>
</ul>-->


<!-- Search -->
<!--<form class="form-inline" role="search">
<input type="text" class="form-control">
<button type="submit" class="btn btn-secondary">Search</button>
</form>-->
</div>
</nav>
</div> <!-- /. End of nav container div -->
<div class="row">
 <div class="col-4 col-sm-4">
  <!-- Content here -->
  <div class="card bg-faded">
 	<div class="list-group">
  		<?php
		readmenu();
		printmenu(); 
		?>
	</div>
 </div> <!-- end of card div -->
  </div>
  <div class="col-8 col-sm-8">
  <input type="hidden" name="objindex" id="objindex" />
  <label for="date">Date:</label>
  <input type="date" name="date" id="date">
  <label for="item">Item:</label>
  <input type="text" name="item" id="item">
  <label for="price">Price:</label><input type="text" name="price" id="price" />
  <!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success" onClick="submit()">Update</button>
 <!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning" onClick="reset()">Clear</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger" onClick="location.href='edit.php'">Delete</button>
  </div>
 
  </div>
</form>
</body>
</html>
<?php
	}

function readmenu(){
	$str = file_get_contents($GLOBALS['filename']) or die("Unable to open file!");
	$GLOBALS['json'] = json_decode($str, true);
}//----------End of readmenu()
function printmenu(){
	//echo date("Y-m-d") . " <br />";
	 foreach($GLOBALS['json'] as $key => $item){
			?>
			<a onclick="fillform('<? echo $key; ?>','<? echo $item[0]; ?>','<? echo $item[1]; ?>','<? echo $item[2]; ?>')" class="list-group-item list-group-item-action flex-column align-items-start">
			<div class="d-flex w-100 justify-content-between">
			  <h5 class="mb-1" id="date<? echo $key; ?>"><? echo $item[0]; ?></h5>
			  <!--<small><? //echo $item[1]; ?></small>-->
			</div>
			<p class="mb-1" id="item<? echo $key; ?>"><? echo $item[1]; ?></p>
			<small><? echo $item[2]; ?></small>
		  	</a>
		  <?
	  }
}//---------End of printmenu()

function append_json($data){
	readmenu();
	//print_r($GLOBALS['data']);
	//echo("<br />");
	//print_r($GLOBALS['json']);
	$jdata= $GLOBALS['json'];
	$thedate = $GLOBALS['data'][0];
	//echo("<br />");
	//echo ($thedate);
	//print_r($jdata);
//	echo("<br />");
//	echo("<br />");
	$object_array = array();
	foreach($jdata as $key => $item){		
		if ($item[0] === $thedate){
			echo("<a href='edit.php'>That date already has an entry.</a>");
			exit();
		}else{
			array_push($object_array, $item);
		}
		//array_push($object_array, $item[0]);
//      if (($item[0] === $thedate[0]) || ($key == $objindex)){
//		  //print_r($data);
//		  $jdata[$key] = $data;
	  }
	array_push($object_array, $GLOBALS['data']);
	//
	$temp_array = array();
	foreach($object_array as $key => $item){
		$temp_array[$key] = $item[0][0];
	}
	array_multisort($temp_array, SORT_DESC, $object_array);
	//print_r(json_encode($GLOBALS['json']));      
   
	//print_r($object_array);
//	
//	
//	
	// open the file if present
	$handle = @fopen($GLOBALS['filename'], 'w+');
	// create the file if needed
	if ($handle == null)
	{
		$handle = fopen($GLOBALS['filename'], 'w+');
	}

	if ($handle)
	{
		fwrite($handle, json_encode($object_array));
			// close the handle on the file
			fclose($handle);
	}
	
}//---------End of append_json()

function append_json2($data){
	// read the file if present
	$handle = @fopen($GLOBALS['filename'], 'r+');

	// create the file if needed
	if ($handle == null)
	{
		$handle = fopen($GLOBALS['filename'], 'w+');
	}

	if ($handle)
	{
		// seek to the end
		fseek($handle, 0, SEEK_END);

		// are we at the end of is the file empty
		if (ftell($handle) > 0)
		{
			// move back a byte
			fseek($handle, -1, SEEK_END);

			// add the trailing comma
			fwrite($handle, ',', 1);

			// add the new json string
			fwrite($handle, json_encode($data) . ']');
		}
		else
		{
			// write the first event inside an array
			fwrite($handle, json_encode(array($data)));
		}

			// close the handle on the file
			fclose($handle);
	}
}//---------End of append_json2()

function update_json($data, $objindex){
	readmenu();
	//print_r($GLOBALS['data']);
	$jdata= $GLOBALS['json'];
	$thedate = $GLOBALS['data'];
	foreach($jdata as $key => $item){
      if (($item[0] === $thedate[0]) || ($key == $objindex)){
		  //print_r($data);
		  $jdata[$key] = $data;
	  }
	//print_r(json_encode($GLOBALS['json']));      
   	}
	//print_r($jdata);
	
	
	
	// open the file if present
	$handle = @fopen($GLOBALS['filename'], 'w+');

	// create the file if needed
	if ($handle == null)
	{
		$handle = fopen($GLOBALS['filename'], 'w+');
	}

	if ($handle)
	{
		/* // seek to the end
		fseek($handle, 0, SEEK_END);
		// are we at the end of is the file empty
		if (ftell($handle) > 0)
		{
			// move back a byte
			fseek($handle, -1, SEEK_END);

			// add the trailing comma
			fwrite($handle, ',', 1);

			// add the new json string
			fwrite($handle, json_encode($data) . ']');
		}
		else
		{ */
			// write the first event inside an array
			fwrite($handle, json_encode($jdata));
		//}

			// close the handle on the file
			fclose($handle);
	}
	
	
	
	
}//---------End of update_json()
?>