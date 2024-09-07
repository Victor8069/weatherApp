<?php  if(!isset($_SESSION['SCty'])){ ?>
    <script src="../../assets/js/script.location.js"></script>
<?php }; ?>


<div class="container">
	<div id="main">
            <h4 id="city">
					<?php  echo $_SESSION['SCty']; ?>
            </h4>
			<div id="forms">
					<?php  include('weather.insert.php'); ?>
			</div>	
			<div id="tview">
					<?php  include('weather.select.php'); ?>
			</div>
	</div>
</div>
