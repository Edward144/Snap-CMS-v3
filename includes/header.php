<?php 
    require_once('includes/database.php');
    require_once('includes/functions.php'); 

	$companyDetails = companyDetails();
?>

<!DOCTYPE html>
<html class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="<?php echo baseDir(); ?>">
		
		<?php echo metaData($metaTitle, $metaDesc, $metaKeywords, $metaAuthor); ?>
        
        <link rel="stylesheet" href="css/style.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
		<link rel="stylesheet" href="js/lightbox/css/lightbox.min.css">
		
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/docRoot.min.js"></script>
		<script src="js/lightbox/js/lightbox.min.js"></script>
		
		<?php googleAnalytics(); ?>
    </head>

    <body>
        <div class="wrapper">
			<header id="header" class="container-fluid bg-primary">
				<div class="headerInner container-xl">
					<div class="row py-3">
						<div class="col-sm-4">
							<?php if(!empty($companyDetails['logo'])) : ?>
								<a href=""><img src="<?php echo $companyDetails['logo']; ?>" class="img-fluid siteLogo siteTitle" alt="<?php echo $companyDetails['name'] . ' logo';?>"></a>
							<?php elseif(!empty($companyDetails['name'])) : ?>
								<h2 class="siteLogo siteTitle"><a href=""><?php echo $companyDetails['name']; ?></a></h2>
							<?php endif; ?>
						</div>

						<div class="col">
							<?php if(!empty($companyDetails['phone']) || !empty($companyDetails['email'])) : ?>
								<div class="contact text-right">
									<?php 
										echo (!empty($companyDetails['phone']) ? '<span class="phone text-light"><span class="fa fa-phone mr-1"></span><a class="text-light" href="tel: ' . $companyDetails['phone'] . '">' . $companyDetails['phone'] . '</a></span>' : '');
										echo (!empty($companyDetails['email']) ? '<span class="email text-light"><span class="fa fa-envelope mr-1"></span><a class="text-light" href="mailto: ' . $companyDetails['email'] . '">' . $companyDetails['email'] . '</a></span>' : ''); 
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</header>
			
			<div class="container-fluid bg-dark">
				<div class="container-xl">
					<div class="row">
						<?php $navbar = new navbar(); $navbar->display(); ?>
					</div>
				</div>
			</div>
			
			<div class="main flex-grow-1 container-fluid">