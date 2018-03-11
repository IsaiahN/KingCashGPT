<?
session_start();
include "header.php";
?>

	<div id="left">
		<?php include("includes/left.php");?>		
	</div>
	<div id="middle">
		<div class="midtop">
			<div class="slider-wrapper theme-orman">
				<div class="ribbon"></div>
				<div id="slider" class="nivoSlider">
			                <img src="images/welcome9.png" alt="image" />
			                <img src="slider/images/welcome3.png" alt="image" />
			                <img src="images/welcome6.png"  alt="image" />
			                <img src="slider/images/welcome3.png" alt="image" />
		                </div>
	            	</div>
		</div>
		<a href="banners.php"><img class="refbanner"  alt="kingcashgpt banners" src="images/banner3.jpg"/></a>
		<div class="midbottom">
			<h1>Earning Money</h1>
			<?php include("includes/steps.php");?>
		</div>
	</div>
	<div id="right">
		<?php include("includes/right.php");?>
	</div>

<?
include "footer.php";
?>