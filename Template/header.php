		
	<header>
		<div class="header" id="header">
			<nav class="navbar navbar-expand-lg navbar-light bg-custom">
	  			<a class="navbar-brand" href="index.php">
	  			</a>
	  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    			<span class="navbar-toggler-icon"></span>
	  			</button>

	  			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav ml-auto">
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" <?php if($_SESSION['page']=='Index') echo " href='#Home' id='home-btn'"; else echo "href='index.php'";?> >home</a>
				      	</li>
				    <?php if ($_SESSION['page']==='Index') { ?> 	
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" <?php if($_SESSION['page']=='Index') echo " href='#About' id='about-btn'"; else echo "href='index.php'";?> >about</a>
				      	</li>
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" <?php if($_SESSION['page']=='Index') echo " href='#Products' id='products-btn'"; else echo "href='index.php'";?> >products</a>
				      	</li>
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" <?php if($_SESSION['page']=='Index') echo " href='#Portofolio' id='portofolio-btn'"; else echo "href='index.php'";?> >portofolio</a>
				      	</li>
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" <?php if($_SESSION['page']=='Index') echo " href='#Contacts' id='contacts-btn'"; else echo "href='index.php'";?> >contacts</a>
				      	</li>
				    
				    <?php }?>
				    <?php if($user->Logging()){ ?>
				    <?php
				    	$show   =$transaction->get_badges_user(Session::get('id_user'));
    					$rows   =mysqli_num_rows($show);
    				?>
				      	<li class="nav-item mr-3 dropdown">
			        		<a class="nav-link" href="#" id="dropdown-profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;"> <?php echo Session::get('user_name'); ?>
			        			<?php if($rows>0){ ?>
			        				<i class="fa fa-bell" style="color: rgb(220, 7, 53);"></i>
			        			<?php } ?>
			        			<!--<img src="<?php //if(file_exists(Session::get('user_image'))) echo Session::get('user_image'); else echo "Assets/img/user.png"; ?>" width="30" height="30" style="border-radius: 100%;">-->
			        		</a>
			        		<div class="dropdown-menu" aria-labelledby="#dropdown-sports">
			        			<a class="dropdown-item" href="profil.php">Profile</a>
			        			<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modallogout">Logout</a>
			        		</div>
			      		</li>
			      	<?php }else{ ?>
				      	<li class="nav-item mr-3">
				        	<a class="nav-link" href="login.php">login</a>
				      	</li>
					<?php } ?>
				    </ul>
	  			</div>
			</nav>
		</div>
	</header>