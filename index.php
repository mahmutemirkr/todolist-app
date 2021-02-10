<?php require_once('config.php'); ?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<title>TodoList App - MahmutEmirKr</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Mahmut Emir">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<style>
		body{
			background-color: lavender;
		}
	</style>

</head>
<body>

	<div class="mt-3 container">
		<h3 class="text-lg-center">Yapılacaklar Listesi</h3>
		<div class="mt-4 row justify-content-center">
			<div class="col-md-10">

				<?php if(isset($_REQUEST['key'])){ ?>

					<form action="config.php" method="POST">
						<input type="hidden" name="update" value="true" />
						<input type="hidden" name="key" value="<?php echo $_REQUEST['key']; ?>" />
						<input type="text" name="deger" class="form-control form-control-lg" required="Boş Geçme" placeholder="Yapılacakları Listele" value="<?php echo $_REQUEST['value']; ?>">
						<button type="submit" class="mt-3 btn btn-outline-success btn-lg btn-block" name="update" value="true">Güncelle</button>
					</form>

				<?php } else { ?>

					<form action="config.php" method="POST">
						<input type="text" name="deger" class="form-control form-control-lg" required="Boş Geçme" placeholder="Yapılacakları Listele">
						<button type="submit" class="mt-3 btn btn-outline-success btn-lg btn-block" name="add" value="true">Listeye Ekle</button>
					</form>

				<?php }; ?>

				<?php foreach($todolist->getlist() as $key => $value){ ?>

						
					<div class="card mt-3 mb-4">
						<div class="card-body">

							<form action="config.php" method="post">
								<input type="hidden" name="checket" value="true" />
								<input type="hidden" name="key" value="<?php echo $key; ?>" />
								<input type="checkbox" name="check<?php echo $key; ?>" <?php if($value['completed'] == true){ echo 'checked="checked"'; }; ?> >
								
								<?php
									if($value['completed'] == true){
										echo "<del>".$value['deger']."</del>";
									} else {
										echo $value['deger'];
									}
								?>
							</form>

							<form action="config.php" method="post" class="d-flex justify-content-end">
								<input type="hidden" name="key" value="<?php echo $key; ?>" />
								<button type="submit" class="tn btn-danger btn-sm mr-2" name="delete" value="true">Sil</button>
								<a href="?key=<?php echo $key; ?>&value=<?php echo $value['deger']; ?>" class="btn btn-warning btn-sm mr-2">Güncelle</a>
								<button type="submit" class="btn btn-secondary btn-sm mr-2" name="down" value="true">Aşağı</button>
								<button type="submit" class="btn btn-secondary btn-sm" name="up" value="true">Yukarı</button>
							</form>

						</div>
					</div>
						
				<?php } ?>

			</div>
		</div>

	</div>

	<script type="text/javascript">
		const checkboxes = document.querySelectorAll('input[type=checkbox]');
		checkboxes.forEach(kr => {
			kr.onclick = function (){
				this.parentNode.submit();
			};
		});
	</script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>

</body>
</html>
