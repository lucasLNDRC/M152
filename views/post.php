<?php
/*****************************************************
 *Titre  : Création d'une page facebook
 *Auteur : LANDRECY LUCAS
 *Date   : 27 Janvier 2020 - Version 1.0
 *Desc.  : Apprendre à manipuler les médias dans une BDD
 *******************************************************/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
    <meta charset="utf-8">
    <title>Facebook Theme Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/facebook.css" rel="stylesheet">
  </head>    
  <body>       
    <div class="wrapper">
		<div class="box cover-container">
			<div class="row row-offcanvas row-offcanvas-left">
				<div class="column col-sm-10 col-xs-11" id="main"><!-- main-->
					<?php require_once "views/nav.php";?>					
					<div class="padding">
						<div class="full col-sm-9"><!-- content -->                      
							<div class="row">
								<form action="?action=post" method="POST" enctype="multipart/form-data">
								<div class="modal-footer">
									<div>
										<label for="fileToUpload" class="Mylabel"><h4>Upload picture:</h4></label>
										<?= (isset($erreur["size"]) ? $erreur["size"] : "") ?>
										<h4><input type="file" name="fileToUpload[]" accept="image/jpeg,image/png,image/gif" multiple id="fileToUpload"></h4>
									</div>
									<div>
										<label for="commentaire" class="Mylabel"><h4>Commentaire</h4></label>
										<textarea name="commentaire" id="commentaire" class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
									</div>
									<div>
									<button class="btn btn-primary btn-sm" id="post" name="post" value="post"><h4>Post</h4></button>
									<ul class="pull-left list-inline">
									<li></li>
									<li></li>
									<li></li>
									</ul>
									</div>	
								</div>
								</form>
							</div><!--/row--> 
						</div><!-- /col-9 -->
					</div><!-- /padding -->
				</div><!-- /main -->
				
			</div>
		</div>
	</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
			$('[data-toggle=offcanvas]').click(function() {
				$(this).toggleClass('visible-xs text-center');
				$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
				$('.row-offcanvas').toggleClass('active');
				$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
				$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
				$('#btnShow').toggle();
			});
        });
        </script>
	</body>
</html>