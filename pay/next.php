<?php
include_once 'info.php';
header("refresh:6; url=$successfulResultUrl");

?>
<!DOCTYPE html>
<html lang="fa">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="پرداخت اینترنتی به پرداخت ملت" />
	<meta property="og:url" content="https://www.behpardakht.com/" />
	<meta property="og:image" content="https://" />
	<title>پرداخت اینترنتی به پرداخت ملت</title>
    <link href="img/ipg-favicon.ico" rel="shortcut icon">
    <link href="css/esprit_fa.min.css?v=11" rel="stylesheet">
    <script src="js/jquery.min.js?v=1"></script>
    <script src="msg/messages_fa.min.js?v=6"></script>
    <script src="js/payment.min.js?v=27"></script>
    <script>$( document ).ready(function() {waitAndSendSuccessResult(2);});</script>
</head>
<body id="body" class="up-scroll">
	<header id="header" >
		<div class="container">
			<div class="beh-card">
                <div class="row">
					<div class="col shaparaklogo align-self-start"><img src="img/shaparak_logo.svg" alt="shaparak"></div>
					<div class="col-6 header-center align-self-end">
						<span>پرداخت اینترنتی به پرداخت ملت</span><br>
						<a href="http://www.behpardakht.com">www.Behpardakht.com</a>
					</div>
					<div class="col behpardakhtlogo align-self-start"><img  src="img/behpardakht_logo.svg" alt="behpardakht"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="main-wrapper result">
		<section class="container">
			<div class="row">
				<div class="col-12">
					<div class="beh-card carddetail  sucsses-result">
						<span class="shape"></span>
						<div class="card-body">
							<div class="result-brif">
								<b>پرداخت موفق</b>
								<button id="return-button" class="btn btn-perches" onclick="sendSuccessResult()">تکمیل خرید</button><br>
								<span class="timer">تا انتقال به سایت پذیرنده “5</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="beh-card carddetail">
                        <div class="background-overflow">
                            <span class="shape"></span>
                        </div>
                        <div class="card-header">
							<h3>اطلاعات تراکنش</h3>
						</div>
						<div class="card-body">
							<dl class="trasaction-result row">
                                <dt class="col-sm-6">شماره ارجاع :</dt>
                                <dd class="col-sm-6">401157835599</dd>
                                <dt class="col-sm-6">نام پذیرنده:</dt>
                               <dd class="col-sm-6"><?php echo "$samane"; ?></dd>
                                <dt class="col-sm-6">شماره پذیرنده:</dt>
                                <dd class="col-sm-6">297473</dd>
                                <dt class="col-sm-6">شماره ترمینال:</dt>
                                <dd class="col-sm-6">696324</dd>
                                <dt class="col-sm-6">کد درگاه پرداخت:</dt>
                                <dd class="col-sm-6">219278179</dd>
                                <dt class="col-sm-6">آدرس وب سایت:</dt>
                                <dd class="col-sm-6">https://www.rasmio.com</dd>
                                <dt class="col-sm-6">مبلغ قابل پرداخت:</dt>
                                <dd class="col-sm-6"><?php echo number_format($Amount); ?></dd>
                                <dt class="col-sm-6">نوع تراکنش:</dt>
                                <dd class="col-sm-6">خرید</dd>
                                <dt class="col-sm-6">شماره پیگیری:</dt>
                                <dd class="col-sm-6">938599</dd>
							</dl>
						</div>
					</div>
				</div>
            </div>
		</section>
    </div>
	<footer class="footer">
		<div class="container">
			<div class="footerarc"></div>
			<div class="footerarc content">
				<span class="call">شماره تماس: 27312733-021</span><br>
				<span>شرکت به پرداخت ملت ارايه دهنده خدمات نوین پرداخت الکترونيک</span>
			</div>
			<div class="row justify-content-center">
				<div class="col-12">
				</div>
			</div>
		</div>
	</footer>
</body>
</html>