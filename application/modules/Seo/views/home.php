<!DOCTYPE html>
<html>
<head>
	<title>
		<?=$title?>
	</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- css -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>https://fonts.googleapis.com/css?family=Pacifico&effect=3d-float">

    <style>
    	form {
    		width:500px;
   			margin:50px auto;
			}
		.search {
    		padding:6px 34px;
    		border:2px solid #black;
    		}
    	.button {
   			position:relative;
    		padding:6px 15px;
    		left: 4px;
    		border:2px solid #black;
    		background-color:#53bd84;
    		color:#fafafa;
			}
    </style>
</head>
<body>
	<div class="container">
		<div id="gambar">
			<center>
				<img src="<?=base_url()?>/assets/img/nah.png" sizes="240px">
			</center>
			</div>
		    <div id="cari">
			<center>
				<?=form_open('seo/result', array('method'=>'get'))?>
					<input class="search" type="text" name="q" required>	
  					<input class="button" type="submit" name="search" value="Search">					
				<?=form_close()?>
			</center>	
		</div>
	</div>
</body>
</html>