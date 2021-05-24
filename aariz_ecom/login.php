<!--head -->
<?php require('header.php');

if(isset($_SESSION['USER_LOGIN']))
{
    ?>
    <script>
        window.location.href='index.php';
    </script>
    <?php
}

?>
<!-- head -->


<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(assets/images/bg/banner_bg.png) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Login/Register</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="contact-form-wrap mt--60">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="login" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="email" name="login_email" id="login_email" placeholder="Your Email">
                                </div>
                                <span class="validation" id="login_email-error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="password" name="login_password" id="login_password" placeholder="Your Password*">
                                </div>
                                <span class="validation" id="login_password-error"></span>
                            </div>
                            <div class="contact-btn">
                                <button type="button" onclick="user_login()" class="fv-btn">Login</button>
                            </div>
                        </form>
                        <div class="form-output login_msg">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Register</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="register"  method="post">
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="text" id="name" name="name" placeholder="Your Name*">
                                </div>
                                <span class="validation " id="name-error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="email" id="email" name="email" placeholder="Your Email*">
                                </div>
                                <span class="validation " id="email-error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="number" id="mobile" name="mobile" placeholder="Your Mobile*" style="width: 100%;">
                                </div>
                                <span class="validation" id="mobile-error"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box subject">
                                    <input type="password" id="password" name="password" placeholder="Your Password*">
                                </div>
                                <span class="validation" id="password-error"></span>
                            </div>
                            <div class="contact-btn">
                                <button type="button" onclick="user_register()" class="fv-btn">Register</button>
                            </div>
                        </form>
                        <div class="form-output register-msg">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
<!-- End Contact Area -->


<!-- footer -->
<?php require('footer.php') ?>
<!-- footer -->
