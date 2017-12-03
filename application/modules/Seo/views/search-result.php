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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico&effect=3d-float">

    <style>
    	body {margin: 20px 0 30px 40px;}
    </style>
    <link href="<?=base_url()?>/assets/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="menu"><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
	</ul></div>

	<p><center>
	  <p class="menuhead"><br>
	  </p>
	  <br>
  	</center>
	</div>
	<div class="bimg">
		<a href="index.php"><img src="<?=base_url()?>/assets/img/aish.png" height="50px" width="100px"></a>
		<br>
	</div>
	<div class="container">
		<div class="form">
			<br>
    <?=form_open('seo/result', array('method'=>'get'))?>
		<input class="kata_kunci" type="text" name="q" placeholder="Masukkan kata kunci" value="<?=$this->input->get('q')?>" size="50" />
		<input class="submit" type="submit" name="search" value="Search" />
		<br>
    <?=form_close()?>
		<h5><b>HASIL PENCARIAN:</b></h5>
        <?php if(sizeof($result) == 0):?>
				<p>Pencarian dengan kata kunci <b><?=$this->input->get('q')?></b> tidak ada hasil.</p>
        <?php else: ?>
        <p>Pencarian dari kata kunci <b><?=$this->input->get('q')?></b> mendapatkan  <?=sizeof($result)?> hasil:</p>
                    <?php foreach($result as $row):?>
                    <?php 
                    $data = json_decode($row);
                    ?>
                    <p>
                    <a href="<?=$data->url?>"><b><?=$data->title?></b></a><br>
                        <?=substr($data->content,0,80)?>...<br>
						<a href="<?=$data->url?>"><?=$data->url?></a>
					</p>
                    <?php endforeach;?>
		</div>
        <?php endif;?>
	</div>
	<script type="text/javascript">
  	(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 	 })();
	</script>
	</center></p>
	<script type="text/javascript">
	var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"<?=base_url()?>/assets/SpryAssets/SpryMenuBarDownHover.gif", imgRight:"<?=base_url()?>/assets/SpryAssets/SpryMenuBarRightHover.gif"});
	</script>
</body>
</html>