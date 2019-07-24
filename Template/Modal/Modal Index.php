<?php if (!empty($error_nb) || !empty($success_nb)) { ?>
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="sample2" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-xl">
            <div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($error_nb)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong><i class="ti-face-sad"></strong> <?= $error_nb; ?>.
                    </div>
                    <?php }elseif(!empty($success_nb)){ ?>
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong><i class="ti-face-smile"></i></strong> <?= $success_nb; ?>.
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php $portofolio_modal=$landing->get_porto();?>
    <?php $no_porto_modal=1; while($data_porto_modal=mysqli_fetch_assoc($portofolio_modal)){ ?>
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="portofoliomodal<?= $no_porto_modal++; ?>" style="background-color: rgba(255, 255, 255, 0.95);">
	  	<div class="modal-dialog modal-xl">
	    	<div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
	    		<div class="modal-header" style="border-bottom: 0px;">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true"><i class="ti-close"></i></span>
			        </button>
		      	</div>
			    <div class="modal-body">
	    			<h5>NINE PRODUCTION PORTOFOLIO</h5>
	    			<h1><?= $data_porto_modal['name']; ?></h1>
	    			<p><?= $data_porto_modal['company']; ?></p>
	    			<img src="<?= $data_porto_modal['path']; ?>" class="img-fluid mb-2">
			    </div>
	    	</div>
	  	</div>
	</div>
<?php } ?>


	<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="emailmodal" style="background-color: rgba(255, 255, 255, 0.95);">
	  	<div class="modal-dialog modal-md">
	    	<div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
	    		<div class="modal-header" style="border-bottom: 0px;">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true"><i class="ti-close"></i></span>
			        </button>
		      	</div>
			    <div class="modal-body">
	    			<h5>NINE PRODUCTION</h5>
	    			<h1>Send email for more info!</h1>
                <?php if($user->Logging()){ ?>
                    <form action="" method="post">
	    				<input type="email" name="email_message" placeholder="Your Email" class="form-control mb-2" value="<?= Session::get('user_email'); ?>" required>
	    				<textarea name="messages_text" placeholder="Your Message" class="form-control mb-2" rows="10" style="resize: none;" required></textarea>

	    				<input name="submit_email" type="submit" value="Submit" class="btn btn-md btn-block rounded-pill btn-danger">
	    			</form>
                <?php }else{ ?>
                    <h1>Sorry You must login first before send message</h1>
                <?php } ?>
			    </div>
	    	</div>
	  	</div>
	</div>

    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="neonboxmodal" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>NINE PRODUCTION</h5>
                    <h1>Neonbox Order</h1>
                <?php if($user->Logging()){ ?>
                    <form method="post">
                        <input type="hidden" name="name_neonbox" placeholder="Your Name/Your Company Name" class="form-control mb-4" value="<?php echo Session::get('user_name'); ?>" required>
                        <input type="text" name="title_neonbox" placeholder="Neon Box Title" class="form-control mb-4" required>
                        <input type="hidden" name="email_neonbox" placeholder="Your Email" class="form-control mb-4" value="<?php echo Session::get('user_email'); ?>" required>
                        <input type="hidden" name="phone_neonbox" placeholder="WhatsApp Number" class="form-control mb-4" value="<?php echo Session::get('user_phone'); ?>" required>
                        
                        <select name="type_neon" id="type_neon" class="form-control mb-4" required="">
                            <option value="">Neon box type</option>
                            <option value="Acrylic">Acrylic</option>
                            <option value="Vinyl/Flexi">Vinyl/Flexi</option>
                        </select>

                        <textarea name="messages_neonbox" placeholder="Explain your design" class="form-control mb-4" rows="8" required></textarea>
                        
                        <input name="submit_neonbox" value="Submit" type="submit" class="btn btn-md btn-success rounded-pill px-4">
                        <input name="cancel_neonbox" value="Cancel" type="reset" class="btn btn-md btn-danger rounded-pill px-4">
                    <?php if (!empty($error_nb)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong><i class="ti-face-sad"></strong> <?= $error_nb; ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php }elseif(!empty($success_nb)){ ?>
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong><i class="ti-face-smile"></i></strong> <?= $success_nb; ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } ?>    
                        <input type="hidden" name="order_type_neonbox" value="Neon Box">
                        <input type="hidden" name="token_neonbox" value="<?php echo Token::generate(); ?>">
                    </form>
                <?php }else{ ?>
                    <h1>Sorry You must login first before order</h1>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="billboardmodal" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>NINE PRODUCTION</h5>
                    <h1>Billboard Order</h1>
                <?php if($user->Logging()){ ?>
                    <form action="" method="post">
                        <input type="hidden" name="name_billboard" placeholder="Your Name/Your Company Name" class="form-control mb-4" value="<?php echo Session::get('user_name'); ?>" required>
                        <input type="text" name="title_billboard" placeholder="Billboard Title" class="form-control mb-4" required>
                        <input type="hidden" name="email_billboard" placeholder="Your Email" class="form-control mb-4" value="<?php echo Session::get('user_email'); ?>" required>
                        <input type="hidden" name="phone_billboard" placeholder="WhatsApp Number" class="form-control mb-4" value="<?php echo Session::get('user_phone'); ?>" required>

                        <select name="type_bill" id="type_bill" class="form-control mb-4" required="">
                            <option value="">Billboard type</option>
                            <option value="Basic Billboard">Basic Billboard</option>
                            <option value="Digital Billboard">Digital Billboard</option>
                            <option value="Mobile Billboard">Mobile Billboard</option>
                        </select>

                        <textarea name="messages_billboard" placeholder="Explain your design" class="form-control mb-4" rows="8" required></textarea>
                        
                        <input name="submit_billboard" value="Submit" type="submit" class="btn btn-md btn-success rounded-pill px-4">
                        <input name="cancel_billboard" value="Cancel" type="reset" class="btn btn-md btn-danger rounded-pill px-4">
                        
                        <input type="hidden" name="order_type_billboard" value="Billboard">
                        <input type="hidden" name="token_billboard" value="<?php echo Token::generate2(); ?>">
                    </form>
                <?php }else{ ?>
                    <h1>Sorry You must login first before order</h1>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="stickermodal" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>NINE PRODUCTION</h5>
                    <h1>Sticker Order</h1>
                <?php if($user->Logging()){ ?>
                    <form action="" method="post">
                        <input type="hidden" name="name_branding" placeholder="Your Name/Your Company Name" class="form-control mb-4" value="<?php echo Session::get('user_name'); ?>" required>
                        <input type="text" name="title_branding" placeholder="Sticker Title" class="form-control mb-4" required>
                        <input type="hidden" name="email_branding" placeholder="Your Email" class="form-control mb-4" value="<?php echo Session::get('user_email'); ?>" required>
                        <input type="hidden" name="phone_branding" placeholder="WhatsApp Number" class="form-control mb-4" value="<?php echo Session::get('user_phone'); ?>" required>

                        <select name="type_stick" id="type_stick" class="form-control mb-4" required="">
                            <option value="">Sticker type</option>
                            <option value="Vinyl Ritrama/Politape">Vinyl Ritrama/Politape Sticker</option>
                            <option value="One Way Vision">One Way Vision</option>
                            <option value="Oracal">Oracal Sticker</option>
                            <option value="Sandblast">Sandblast Sticker</option>
                            <option value="3M">3M Sticker</option>
                        </select>

                        <textarea name="messages_branding" placeholder="Explain your design" class="form-control mb-4" rows="8" required></textarea>
                        
                        <input name="submit_branding" value="Submit" type="submit" class="btn btn-md btn-success rounded-pill px-4">
                        <input name="cancel_branding" value="Cancel" type="reset" class="btn btn-md btn-danger rounded-pill px-4">
                        
                        <input type="hidden" name="order_type_branding" value="Sticker">
                        <input type="hidden" name="token_branding" value="<?php echo Token::generate3(); ?>">
                    </form>
                <?php }else{ ?>
                    <h1>Sorry You must login first before order</h1>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="lettermodal" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>NINE PRODUCTION</h5>
                    <h1>Letter Sign Order</h1>
                <?php if($user->Logging()){ ?>
                    <form action="" method="post">
                        <input type="hidden" name="name_branding" placeholder="Your Name/Your Company Name" class="form-control mb-4" value="<?php echo Session::get('user_name'); ?>" required>
                        <input type="text" name="title_branding" placeholder="Letter Sign Title" class="form-control mb-4" required>
                        <input type="hidden" name="email_branding" placeholder="Your Email" class="form-control mb-4" value="<?php echo Session::get('user_email'); ?>" required>
                        <input type="hidden" name="phone_branding" placeholder="WhatsApp Number" class="form-control mb-4" value="<?php echo Session::get('user_phone'); ?>" required>
                        
                        <select name="type_letter" id="type_letter" class="form-control mb-4" required="">
                            <option value="">Letter Sign type</option>
                            <option value="Stainless Steel">Stainless Steel</option>
                            <option value="Brass">Brass</option>
                            <option value="Galvanil">Galvanil</option>
                            <option value="Acrylic">Acrylic</option>
                        </select>

                        <textarea name="messages_branding" placeholder="Explain your design" class="form-control mb-4" rows="8" required></textarea>
                        
                        <input name="submit_letter" value="Submit" type="submit" class="btn btn-md btn-success rounded-pill px-4">
                        <input name="cancel_letter" value="Cancel" type="reset" class="btn btn-md btn-danger rounded-pill px-4">
                        
                        <input type="hidden" name="order_type_branding" value="Letter Sign">
                        <input type="hidden" name="token_letter" value="<?php echo Token::generate4(); ?>">
                    </form>
                <?php }else{ ?>
                    <h1>Sorry You must login first before order</h1>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php if($user->Logging()){ ?>
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modallogout" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Reminder logout!</h5>
                    <h1>Are you sure want to logout?</h1>
                    <a href="logout.php?submit_logout=yes" class="btn btn-md rounded-pill btn-danger">Yes</a>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="btn btn-md btn-primary rounded-pill">No</a>
                </div>
            </div>
        </div>
    </div>
 <?php } ?>