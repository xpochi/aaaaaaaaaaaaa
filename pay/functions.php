
<?php

function info($card){
    $rcard = false;
    $bankn = '';
    
    $pan = substr($card,0,6);
    $bank = bank_information($pan);
    if(bankCardCheck($card)){
        $rcard = true;
        $bankn = $bank[1];
        $bankinf = $bank[0];
        return array($rcard,$bankn,$bankinf);
    }else{
        return array(false,'#FAKE','#FAKE','#FAKE');
    }
}
function bankCardCheck($card='', $irCard=true) {
  $card = (string) preg_replace('/\D/','',$card);
  $strlen = strlen($card);
  if($irCard==true and $strlen!=16)
      return false;
  if($irCard!=true and ($strlen<13 or $strlen>19))
      return false;
  if(!in_array($card[0],[2,4,5,6,9]))
      return false;

  for($i=0; $i<$strlen; $i++)
  {
      $res[$i] = $card[$i];
      if(($strlen%2)==($i%2))
      {
          $res[$i] *= 2;
          if($res[$i]>9)
              $res[$i] -= 9;
      }
  }
  return array_sum($res)%10==0?true:false;
}

function bank_information($cardn){
  $cardn = (integer)$cardn;
  if ($cardn == 603799 || $cardn == 170019 || $cardn == 589905) {
      $bankname = "#meli";
      $bankinfo = "بانک ملی
⁉️Site: bale.apk
⁉️USSD: *717#  
⁉️TBank: 09622
";
  }elseif ($cardn == 589210) {
      $bankname = "#sepah";
      $bankinfo = "بانک سپه
⁉️Site: https://ib.ebanksepah.ir/desktop/sepahPages/shetabCard.sepah
⁉️USSD: #
⁉️TBank: 021 64058
";
  }elseif ($cardn == 627648 || $cardn == 207177) {
      $bankname = "#tosee_saderat";
      $bankinfo = "بانک توسعه صادرات
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 2722
";
  }elseif ($cardn == 627961) {
      $bankname = "#sanat_madan";
      $bankinfo = "بانک صنعت و معدن
⁉️Site: #
⁉️USSD: *719#
⁉️TBank: 021 75024
";
  }elseif ($cardn == 603770 || $cardn == 639217) {
      $bankname = "#keshavarzi";
      $bankinfo = "بانک کشاورزی
⁉️Site: https://ib.bki.ir/pid46.lmx
⁉️USSD: *730#
⁉️TBank: 09603
";
  }elseif ($cardn == 628023) {
      $bankname = "#maskan";
      $bankinfo = "بانک مسکن
⁉️Site: #
⁉️USSD: *714#, *737#
⁉️TBank: 021 64096
";
  }elseif ($cardn == 627760) {
      $bankname = "#post_bank_iran";
      $bankinfo = "پست بانک ایران
⁉️Site: #
⁉️USSD: *747#
⁉️TBank: 021 84284
";
  }elseif ($cardn == 502908) {
      $bankname = "#tosee_taavon";
      $bankinfo = "بانک توسعه تعاون
⁉️Site: https://epayment.ttbank.ir
⁉️USSD: #
⁉️TBank: #
";
  }elseif ($cardn == 627412) {
      $bankname = "#eghtsad_novin";
      $bankinfo = "بانک اقتصاد نوین
⁉️Site: https://modern.enbank.net/CustomerManager/viewLogin.html
⁉️USSD: #
⁉️TBank: 021 85292
";
  }elseif ($cardn == 622106 || $cardn == 639194 || $cardn == 627884) {
      $bankname = "#parsian";
      $bankinfo = "بانک پارسیان
⁉️Site: #
⁉️USSD: *708#
⁉️TBank: 021 89111
";
  }elseif ($cardn == 502229 || $cardn == 639347) {
      $bankname = "#pasargad";
      $bankinfo = "بانک پاسارگاد
⁉️Site: https://epay.bpi.ir/balanceinquiry.aspx
⁉️USSD: *720#
⁉️TBank: 021 828991111
";
  }elseif ($cardn == 627488 || $cardn == 502910) {
      $bankname = "#kar_afarin";
      $bankinfo = "بانک کار افرین
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 23640
";
  }elseif ($cardn == 621986) {
      $bankname = "#saman";
      $bankinfo = "بانک سامان
⁉️Site: #
⁉️USSD: *724#
⁉️TBank: 021 6422
";
  }elseif ($cardn == 639346) {
      $bankname = "#sina";
      $bankinfo = "بانک سینا
⁉️Site: https://sina24h.com/CustomerService2/viewLogin.html
⁉️USSD: *727#
⁉️TBank: 021 82487
";
  }elseif ($cardn == 639607) {
      $bankname = "#sarmaye";
      $bankinfo = "بانک سرمایه
⁉️Site: https://pg.sbank.ir/balanceRequest.do
⁉️USSD: #
⁉️TBank: 021 8254
";
  }elseif ($cardn == 636214) {
      $bankname = "#ayande";
      $bankinfo = "بانک آینده
⁉️Site: #
⁉️USSD: *745#
⁉️TBank: 021 2957
";
  }elseif ($cardn == 502806 || $cardn == 504706) {
      $bankname = "#shahr";
      $bankinfo = "بانک شهر
⁉️Site: https://ebank.city-bank.net/customermanager/viewLogin.html
⁉️USSD: *787#
⁉️TBank: 021 87611
";
  }elseif ($cardn == 502938) {
      $bankname = "#day";
      $bankinfo = "بانک دی
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 2726
";
  }elseif ($cardn == 603769) {
      $bankname = "#saderat";
      $bankinfo = "بانک صادرات
⁉️Site: #
⁉️USSD: *719#
⁉️TBank: 09602
";
  }elseif ($cardn == 610433 || $cardn == 991975) {
      $bankname = "#mellat";
      $bankinfo = "بانک ملت
⁉️Site: #
⁉️USSD: *720#
⁉️TBank: 021 8132
";
  }elseif ($cardn == 585983) {
      $bankname = "#tejarat";
      $bankinfo = "بانک تجارت
⁉️Site: https://pg.tejaratbank.ir/paymentGateway/getBalance
⁉️USSD: #
⁉️TBank: 021 81277
";
  }elseif ($cardn == 589463) {
      $bankname = "#refah";
      $bankinfo = "بانک رفاه
⁉️Site: #
⁉️USSD: *729#
⁉️TBank: 021 84043000
";
  }elseif ($cardn == 627381) {
      $bankname = "#ansar";
      $bankinfo = "بانک انصار
⁉️Site: https://ebank.ansarbank.com/customermanager/viewLogin.html
⁉️USSD: *763#
⁉️TBank: 021 48049
";
  }elseif ($cardn == 505785) {
      $bankname = "#iran_zamin";
      $bankinfo = "بانک ایران زمین
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 24760
";
  }elseif ($cardn == 636795) {
      $bankname = "#markazi";
      $bankinfo = "بانک مرکزی
⁉️Site: #
⁉️USSD: #
⁉️TBank: #
";
  }elseif ($cardn == 636949) {
      $bankname = "#hekmat";
      $bankinfo = "بانک حکمت
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 89555
";
  }elseif ($cardn == 505416) {
      $bankname = "#gardeshgary";
      $bankinfo = "بانک گردشگری
⁉️Site: https://epayment.tourism-bank.com/BalanceInquiry.aspx
⁉️USSD: *764#
⁉️TBank: 021 22630345
";
  }elseif ($cardn == 606373) {
      $bankname = "#qarzolhasane_iran";
      $bankinfo = "بانک قرض الحسنه ایران
⁉️Site: https://epayment.rqb.ir/BalanceInquiry.aspx
⁉️USSD: #
⁉️TBank: 021 8528
";
  }elseif ($cardn == 628157) {
      $bankname = "#moasse_etebari_tosee";
      $bankinfo = "موسسه اعتباری توسعه
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 81461
";
  }elseif ($cardn == 505801) {
      $bankname = "#kosar";
      $bankinfo = "بانک کوثر
⁉️Site: #
⁉️USSD: *744#
⁉️TBank: 021 86777
";
  }elseif ($cardn == 639370) {
      $bankname = "#moasse_mehr";
      $bankinfo = "موسسه مهر
⁉️Site: https://modern.qmbi24.com/customermngr/viewLogin.html
⁉️USSD: #
⁉️TBank: 021 8989
";
  }  elseif ($cardn == 504172) {
      $bankname = "#resalat";
      $bankinfo = "بانک قرض الحسنه رسالت
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 28390";

  }elseif ($cardn == 639599) {
      $bankname = "#qavamin";
      $bankinfo = "بانک قوامین
⁉️Site: #
⁉️USSD: #
⁉️TBank: 021 84270
";
  }else{
      $bankname = "#بانک_نامعلوم";
      $bankinfo = "کارت فیکه!";
  }
  return array($bankinfo,$bankname);
}

?>
