<?php
require_once 'Core/init.php';
 	$_SESSION['page']="Index";

	$error_nb='';
	$success_nb='';
if ($user->Logging()) {
	# code...
	if (Session::get('user_status')=='Admin') {
		Redirect::to('Dashboard');
	}else{
		if (Input::get('submit_neonbox')) {
			if (Token::check( Input::get('token_neonbox') )) {
				if ($transaction->insert(array(
					'id'				=>'',
					'user_code'			=>Session::get('id_user'),
					'category'			=>Input::get('order_type_neonbox'),
					'name'				=>Input::get('name_neonbox'),
					'title'				=>Input::get('title_neonbox'),
					'email'				=>Input::get('email_neonbox'),
					'phone'				=>Input::get('phone_neonbox'),
					'explaining_user'	=>Input::get('messages_neonbox'),
					'status'			=>'Negotiation',
					'price'				=>0,
					'price_deal'		=>0,
					'read_admin'		=>0,
					'read_user'			=>1,
					'date'				=>date('Y-m-d')
				))) {
					
					$success_nb='Your request will be process. We will send email or call you. Thank you!';
				}else{
					$error_nb='Sorry! something problem, please try again';
				}
			}
		}else{
			$error_nb='';
			$success_nb='';
		}


		if (Input::get('submit_billboard')) {
			if (Token::check2( Input::get('token_billboard') )) {
				if ($transaction->insert(array(
					'id'				=>'',
					'user_code'			=>Session::get('id_user'),
					'category'			=>Input::get('order_type_billboard'),
					'name'				=>Input::get('name_billboard'),
					'title'				=>Input::get('title_billboard'),
					'email'				=>Input::get('email_billboard'),
					'phone'				=>Input::get('phone_billboard'),
					'explaining_user'	=>Input::get('messages_billboard'),
					'status'			=>'Negotiation',
					'price'				=>0,
					'price_deal'		=>0,
					'read_admin'		=>1,
					'read_user'			=>0,
					'date'				=>date('Y-m-d')
				))) {
					
					$success_nb='Your request will be process. We will send email or call you. Thank you!';
				}else{
					$error_nb='Sorry! something problem, please try again';
				}
			}
		}else{
			$error_nb='';
			$success_nb='';
		}



		if (Input::get('submit_branding')) {
			if (Token::check3( Input::get('token_branding') )) {
				if ($transaction->insert(array(
					'id'				=>'',
					'user_code'			=>Session::get('id_user'),
					'category'			=>Input::get('order_type_branding'),
					'name'				=>Input::get('name_branding'),
					'title'				=>Input::get('title_branding'),
					'email'				=>Input::get('email_branding'),
					'phone'				=>Input::get('phone_branding'),
					'explaining_user'	=>Input::get('messages_branding'),
					'status'			=>'Negotiation',
					'price'				=>0,
					'price_deal'		=>0,
					'read_admin'		=>1,
					'read_user'			=>0,
					'date'				=>date('Y-m-d')
				))) {
					
					$success_nb='Your request will be process. We will send email or call you. Thank you!';
				}else{
					$error_nb='Sorry! something problem, please try again';
				}
			}
		}else{
			$error_nb='';
			$success_nb='';
		}

	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nine Production Official | Home</title>
	<link href="Assets/img/Logo.png" rel="shortcut icon">
	<link rel="stylesheet" type="text/css" href="Vendor/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Vendor/Font Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="Vendor/Font Awesome/css/themify-icons.css">
    <link rel="stylesheet" href="Vendor/Font Awesome/css/flag-icon.min.css">


    <link rel="stylesheet" href="Vendor/Bootstrap/css custom/index.css">
    <style type="text/css">
    	
    </style>
</head>
<body>
<div id="body">
    
    <?php require_once 'Template/header.php'; ?>

<section>
	<div id="section">
		<div class="container-fluids px-0 py-0 slide-shows">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="btn-started">
                <button class="btn btn-md btn-custom-1 rounded-pill" id="start-btn" style="width: 180px;">Get Started</button>
                </div>

    			<?php $slide=$landing->get_slide(); $slide2=$landing->get_slide(); ?>
                <ol class="carousel-indicators">
    				<?php $no=0; while($data_slide=mysqli_fetch_assoc($slide)){ ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?= $no++; ?>" <?php if($no==0) echo "class='active'"; else echo "";?> ></li>
					<?php } ?>
				</ol>
				<div class="carousel-inner">
				<?php $no2=0; while($image_slide=mysqli_fetch_assoc($slide2)){ ?>
					<div class="carousel-item <?php if($no2==0) echo "active"; else echo "";?>">
						<img class="d-block w-100 height-carousel" src="<?= $image_slide['path']; ?>" alt="Slide <?= $no2++; ?>">
					</div>
				<?php } ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<i class="ti-angle-left"></i>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<i class="ti-angle-right"></i>
				</a>
			</div>
		</div>

		<div class="container-fluids px-2 py-2 bg-welcome">
			<br>
			<br>
			<br>
			<div class="container text-center mt-3 mb-3 text-welcome">
				<h1><b>Welcome to Nine Production!</b></h1>
				<br>
				<p>We’re here to honor, support and serve people who create. People who aren’t afraid to embrace risk. People passionate enough to challenge the status quo and win. People who push us forward despite all odds.</p>
			</div>
			<br>
			<br>
			<br>
		</div>

		<div class="container-fluids px-2 py-2 bg-about">
			<br>
			<br>
			<br>
			<div class="container text-center mt-3 mb-3 text-about">
				<h1><b>About Us</b></h1>
				<br>
				<p>
					Nine Production is a company engaged in printing, brochures, labels, stickers, magazines, car branding, neonbox, digital print and other types of promotional media. We are supported by a professional and experienced workforce in their field ready to handle your promotional media needs.
				</p> 
				<p>
					Established since 2009 along with the stretching of the Indonesian economic climate at that time, so did we grow with clients in achieving mutual success.
				</p>
			</div>
			<br>
			<br>
			<br>
		</div>

		<div class="container-fluids px-2 py-2 bg-product">
			<br>
			<br>
			<br>
			<div class="container text-center mt-3 mb-3 text-product">
				<h1><b>Our Products</b></h1>
				<br>
				<p>
					We will help you from the design concept, determine the material to the manufacturing process. Nine production, always ready to help you to increase the selling power of your products with the advertising services offered by our company.
				</p>
				<br>
			</div>

			<div class="container">
		        <div class="row">
		          	<div class="col-lg-12">
		            	<ul class="timeline">
		              		<li>
				                <div class="timeline-image" style="z-index: 50; background-image: url('Assets/img/_1_.jpg'); background-size: cover; background-repeat: no-repeat;">
				                </div>
			                	<div class="timeline-panel">
				                  	<div class="timeline-heading">
				                    	<h1 style="color: rgb(0, 142, 238);">Neon Box</h1>
				                  	</div>
			                  		<div class="timeline-body">
			                    		<p style="color: white;">Neon boxes are often referred to as promotional media during the day and night. Usually there are various types of neon box making materials including outdoor vinnyl, backlit, acrylic, ultralon and colibrite. While the shape also varies according to the wishes of the customer.
										<a class="nav-link js-scroll-trigger" href="#neonbox" data-toggle="modal" data-target="#neonboxmodal" style="color:#7cc19d;"><h4><i class="fa fa-shopping-cart"></i> Order now</h4></a></p>
			                  		</div>
			                	</div>
		              		</li>
		              		<li class="timeline-inverted">
				                <div class="timeline-image" style="z-index: 50; background-image: url('Assets/img/bl.jpg'); background-size: cover; background-repeat: no-repeat;">
				                </div>
		                		<div class="timeline-panel">
			                  		<div class="timeline-heading">
			                    		<h1 class="subheading" style="color: rgb(0, 142, 238);">Billboard</h1>
			                  		</div>
			                  		<div class="timeline-body">
			                   			<p style="color: white;">Billboard is a form of outdoor advertising promotion and has a large enough size. In the sense that the actual billboard is a poster with a size that is quite large and placed high in a certain place that is crowded by people. Billboard is the most widely used outdoor media billboard model. Its development is quite rapid. Now in the era of this digital era, billboards also use new technology so that the term "digital billboard" appears. There is also a mobile billboard that is a billboard that goes to and fro because it is installed on vehicles that are especially cars (running ads). During its development Mobile billboards themselves now have a digital mobile billboard.
										<a class="nav-link js-scroll-trigger" href="#billboard" data-toggle="modal" data-target="#billboardmodal" style="color:#7cc19d;"><h4><i class="fa fa-shopping-cart"></i> Order now</h4></a></p>
			                  		</div>
		                		</div>
		              		</li>
		              		<li>
				                <div class="timeline-image" style="z-index: 50; background-image: url('Assets/img/letter sign.jpg'); background-size: cover; background-repeat: no-repeat;">
				                </div>
			                	<div class="timeline-panel">
				                  	<div class="timeline-heading">
				                    	<h1 style="color: rgb(0, 142, 238);">Letter Sign</h1>
				                  	</div>
			                  		<div class="timeline-body">
			                    		<p style="color: white;">Embossed letters are forms of billboards that have aesthetic value and can be used as one of the branding media for your company logo / brand / name so that it can easily remember company branding. There are several choices of materials that are in demand by consumers, namely, stainless steel, brass, galvanil and acrylic.
 										<a class="nav-link js-scroll-trigger" href="#letter_sign" data-toggle="modal" data-target="#lettermodal" style="color:#7cc19d;"><h4><i class="fa fa-shopping-cart"></i> Order now</h4></a></p>
			                  		</div>
			                	</div>
		              		</li>
		              		<li class="timeline-inverted">
				                <div class="timeline-image" style="z-index: 50; background-image: url('Assets/img/stiker.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
				                </div>
		                		<div class="timeline-panel">
			                  		<div class="timeline-heading">
			                    		<h1 class="subheading" style="color: rgb(0, 142, 238);">Sticker</h1>
			                  		</div>
			                  		<div class="timeline-body">
			                   			<p style="color: white;">Sticker is a medium of visual information in the form of small sheets of paper or plastic that are affixed, or other terms are etiquette. Etiquette is a piece of paper affixed to the packaging of goods (merchandise) which contains information (for example, name, nature, contents, origin) regarding the item.
 										<a class="nav-link js-scroll-trigger" href="#sticker" data-toggle="modal" data-target="#stickermodal" style="color:#7cc19d;"><h4><i class="fa fa-shopping-cart"></i> Order now</h4></a></p>
			                  		</div>
		                		</div>
		              		</li>
		            	</ul>
		          	</div>
		        </div>
      		</div>

      		<br>
			<br>
			<br>
			<br>
		</div>

		<div class="container-fluids px-2 py-2 bg-portofolio">
			<br>
			<br>
			<br>
			<div class="container text-center mt-3 mb-3 text-portofolio">
				<h1>Portofolio</h1>
				<div class="row">
			<?php $portofolio=$landing->get_porto();?>
				<?php $no_porto=1; while($data_porto=mysqli_fetch_assoc($portofolio)){ ?>
					<div class="portofolio-box">
						<img src="<?= $data_porto['path']; ?>">
						<div class="portofolio-info">
							<p><a href="#" data-toggle="modal" data-target="#portofoliomodal<?= $no_porto++; ?>"> <?= $data_porto['name']; ?><span> <?= $data_porto['company']; ?> </span> </a></p>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
			<br>
			<br>
			<br>
		</div>

		<div class="container-fluids px-2 py-2 bg-contact">
			<br>
			<br>
			<br>
			<div class="container text-center mt-3 mb-3 text-contact">
				<h1>Contact Us</h1>
				<br>
				<div class="row" style="margin-left: auto; margin-right: auto;">
			<?php $contact_us=$landing->get_company();?>
				<?php $no_contact=1; while($data_contact=mysqli_fetch_assoc($contact_us)){ ?>
					<div class="contact-box">
						<h1><i class="fa fa-home"></i></h1>
						<h5>Office</h5>
						<p>
							<?= $data_contact['address']; ?>, <?= $data_contact['zip_code']; ?>
							<br>
							Telp. <?= $data_contact['phone']; ?>
						</p>
					</div>
					<div class="contact-box">
						<iframe src="<?= $data_contact['gmaps_link']; ?>" frameborder="0" class="rounded-pill" ></iframe>
					</div>
				<?php } ?>
					<div class="contact-box">
						<h1><i class="fa fa-envelope"></i></h1>
						<h5>Need more info?</h5>
						<p>Need more info about Nine Production? just drop us an email</p>
						<a href="#" data-toggle="modal" data-target="#">send email</a>
					</div>
				</div>
			</div>
		</div>

		<center>
			<a href="#Home" class="center-scroll btn btn-md rounded-pill mb-5" id="backTop">back to top</a>
		</center>
	</div>
</section>

    <?php require_once 'Template/footer.php'; ?>
</div>
	<?php require_once 'Template/Modal/Modal Index.php';?>

	<script type="text/javascript" src="Vendor/Bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="Vendor/Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#body').fadeIn(2000);
		$(window).scroll(function() {
			var scroll 	= $(window).scrollTop();
			var width 	= $(window).width();
			
			if (scroll > 100) {
				$('.bg-custom').css({
					"backgroundColor": '#fff',
					'border-bottom':'1px solid rgb(159, 159, 159)',
					'transition':'all 0.6s ease'
				});
				$('.navbar-light .nav-item .nav-link').css({
					'color':'rgb(220, 7 ,53)',
					'transition':'all 0.6s ease'
				});
				$('.navbar-light .nav-item .nav-link').mouseover(function(){
					$(this).css({
						'color':'rgb(0, 142 ,238)',
						'transition':'all 0.6s ease'
					});
				});
				$('.navbar-light .nav-item .nav-link').mouseleave(function(){
					$(this).css({
						'color':'rgb(220, 7, 53)',
						'transition':'all 0.6s ease'
					});
				});
			}else{
				$('.bg-custom').css({
					"backgroundColor": 'transparent',
					'border-bottom':'1px solid transparent'
				});
				$('.navbar-light .nav-item .nav-link').css({
					'color':'rgb(255, 255, 255)'
				});
				$('.navbar-light .nav-item .nav-link').mouseover(function(){
					$(this).css({
						'color':'rgb(220, 7, 53)',
						'transition':'all 0.6s ease'
					});
				});
				$('.navbar-light .nav-item .nav-link').mouseleave(function(){
					$(this).css({
						'color':'rgb(255, 255, 255)',
						'transition':'all 0.6s ease'
					});
				});
			}
			return false;
		});

		$('#home-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('header').offset().top
	  		},1000);
	  	});
	  	$('#backTop').click(function(){
			$('html, body').animate({
	  			scrollTop: $('header').offset().top
	  		},1000);
	  	});
	  	$('#start-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('.bg-welcome').offset().top
	  		},1000);
	  	});
		$('#about-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('.bg-about').offset().top
	  		},1000);
	  	});
		$('#products-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('.bg-product').offset().top
	  		},1000);
	  	});
		$('#portofolio-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('.bg-portofolio').offset().top
	  		},1000);
	  	});
		$('#contacts-btn').click(function(){
			$('html, body').animate({
	  			scrollTop: $('.bg-contact').offset().top
	  		},1000);
	  	});
	  	$('#neonboxmodal').modal({backdrop: 'static', keyboard: false, show: false});
	  	$('#billboardmodal').modal({backdrop: 'static', keyboard: false, show: false});
	  	$('#carbrandingmodal').modal({backdrop: 'static', keyboard: false, show: false});
	  	<?php if (!empty($error_nb) || !empty($success_nb)) { ?>
	  		$('#sample2').modal({backdrop: 'static', keyboard: false, show: true});
	  	<?php } ?>  
	});
</script>