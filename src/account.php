<?php

namespace Netgsm\Account;



class account
{   
   
    
    public function kredisorgu():array
    {
        $xmlData='<?xml version="1.0"?>
        <mainbody>
            <header>		
                <usercode>'.env("NETGSM_USERCODE").'</usercode>
                <password>'.env("NETGSM_PASSWORD").'</password>
                <stip>2</stip>      
                </header>		
        </mainbody>';
         $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'https://api.netgsm.com.tr/balance/list/xml');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
		$result = curl_exec($ch);
        
        $dizi=explode(" ",$result);
        $sonuc=[];
       
        if($dizi[0]=="00"){
            $sonuc["durum"]="Başarılı sorgulama";
            $sonuc["cüzdan"]=$dizi[1];
            $sonuc["code"]=$dizi[0];

        }
        else if($dizi[0]==30){
            $sonuc["durum"]="Geçersiz kullanıcı adı , şifre veya kullanıcınızın API erişim izninin olmadığını gösterir.Ayrıca eğer API erişiminizde IP sınırlaması yaptıysanız ve sınırladığınız ip dışında gönderim sağlıyorsanız 30 hata kodunu alırsınız. API erişim izninizi veya IP sınırlamanızı , web arayüzümüzden; sağ üst köşede bulunan ayarlar> API işlemleri menüsunden kontrol edebilirsiniz.";
            $sonuc["code"]=$dizi[0];
        }
        else if($dizi[0]==70){
            $sonuc['durum']="Hatalı sorgulama. Gönderdiğiniz parametrelerden birisi hatalı veya zorunlu alanlardan birinin eksik olduğunu ifade eder.";
            $sonuc["code"]=$dizi[0];
        }
        return $sonuc;

    }
    public function paketsorgu():array
    {
        
        $xmlData='<?xml version="1.0"?>
        <mainbody>
            <header>		
                <usercode>'.env("NETGSM_USERCODE").'</usercode>
                <password>'.env("NETGSM_PASSWORD").'</password>
                <stip>1</stip>      
                </header>		
        </mainbody>';
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://api.netgsm.com.tr/balance/list/xml");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        
		$result = curl_exec($ch);
        $result=explode("<BR>",$result);
        $res=array();
		foreach($result as $r=>$v)
        {
          $res[$r]=$v;
          
        }
        return array_filter($res);
    }
}