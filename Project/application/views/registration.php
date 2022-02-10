<style type="text/css">
    .long-shadow {
    text-transform: uppercase;
    font-family : unset;
    font-weight: 500;
    background: linear-gradient(90deg, rgba(255,255,255,1) 50%, rgba(255,63,63,1) 51%, rgba(109,214,239,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 23px;
}
</style>
<div class="logo">

    <a href="index.html">
         <h1 class="long-shadow">CONGREGATION AHAVAS DOVID</h1>

   <!--  <img src="<?= base_url()?>/assets/pages/img/logo-big.png" alt="" /> --> </a>

</div>

<!-- END LOG-->

<?php if($this->session->flashdata('message')){ ?>

<div id="result" class="alert alert-info" style="display: none;"></div>

<?php } else if($this->session->flashdata('error')){ ?>

<div id="result_error" class="alert alert-danger" style="display: none;"></div>

<?php } else{} ?>



<div id="result_message" style="display: none;"></div>

        <div id="result_error_message" style="display: none;"></div>

        <?php if ($this->session->flashdata('message')) {?>

        <div id="result" style="display: none;"></div>

        <?php } else if ($this->session->flashdata('error')) {?>

        <div id="result_error" style="display: none;"></div>

        <?php } else {}?>



<!-- BEGIN REGISTRATION FORM --> <div class="content">

<form class="login-form" id="registrationform" action="<?= base_url('register/user') ?>" method="post">

    <h3 class="font-green">Sign Up</h3>

    <p class="hint"> Enter your personal details below: </p>

    <div class="form-group">

        <label class="control-label visible-ie8 visible-ie9">Full Name</label>

        <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" id="name" name="name" />

         <?php if(isset($errors['name'])): ?>

            <label class="text-danger"><?=$errors['name']; ?></label>

        <?php endif; ?> </div>

        <div class="form-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Email</label>

            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" id="email" name="email" /> 

             <?php if(isset($errors['email'])): ?>

                <label class="text-danger"><?=$errors['email']; ?></label>

            <?php endif; ?>

            <span class="error"></span>

        </div>



            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9">Phonenumber</label>

                <input class="form-control placeholder-no-fix" type="text" placeholder="Phone" id="phone" name="phone" /> 

                 <?php if(isset($errors['phone'])): ?>

                    <label class="text-danger"><?=$errors['phone']; ?></label>

                <?php endif; ?>

            </div>

                

                <p class="hint"> Enter your account details below: </p>

                <div class="form-group">

                    <label class="control-label visible-ie8 visible-ie9">Password</label>

                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" name="password" />

                     <?php if(isset($errors['password'])): ?>

                        <label class="text-danger"><?=$errors['password']; ?></label>

                    <?php endif; ?>

         </div>

                    <div class="form-group">

                        <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>

                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="confirm_password" placeholder="Re-type Your Password" name="confirm_password" />
                          <?php if(isset($errors['confirm_password'])): ?>
                            <label class="text-danger"><?=$errors['confirm_password']; ?></label>
                        <?php endif; ?>
                         </div>

                        

                        <!-- <div id="imgdiv" style="display: flex;"><div id="captchaimage"><?php echo $captchaimage ?></div>



                        <img id="reload" src="reload.png" style="float: right; margin-left: 10px; margin-bottom: 5px; cursor: pointer;" /></div>

                        <input type="text" name="captcha"  id ="captcha" placeholder="Enter Captcha code *" class="form-control custom-contact-input">

                         <?php if(isset($errors['captcha'])): ?>

                            <label class="text-danger"><?=$errors['captcha']; ?></label>

                        <?php endif; ?>

                        <input type="hidden" name="captcha_word" id="captcha_word" value="<?php echo @$_SESSION['captcha_word']; ?>"> -->



                 <!--    <div class="form-group" style="margin-top: 25px;">

                        <input type="hidden" name="otp_word" id="otp_word">

                        <input type="text" placeholder="Enter Otp" name="otp" class="form-control"  id="order_otp"><br>

                        <button type="button" class="btn btn-success" style="float: right; margin-bottom: 3px;"  id="send_otp">Get Otp</button>

                    </div>

     -->

                        <div class="form-actions">

                             <button type="button"  id="register-back-btn" class="btn green btn-outline">Back</button>

                            <input  type="submit" value="submit" name="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">

                            </div>



                    </form>

                    <!-- END REGISTRATION FORM -->

                </div>