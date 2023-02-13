<?php

namespace Netgsm\Account;



class account
{   
   
    private $username;
    private $password;
    public function __construct()
    {
        if(isset($_ENV['NETGSM_USERCODE']))
        {
            $this->username=$_ENV['NETGSM_USERCODE'];
        }
        else{
            $this->username=null;
        }
        if(isset($_ENV['NETGSM_PASSWORD']))
        {
            $this->password=$_ENV['NETGSM_PASSWORD'];
        }
        else{
            $this->password=null;
        }
        
    }
    public function kredisorgu():array
    {

        
        $xmlData='<?xml version="1.0"?>
        <mainbody>
            <header>		
                <usercode>'.$this->username.'</usercode>
                <password>'.$this->password.'</password>
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
            <usercode>'.$this->username.'</usercode>
            <password>'.$this->password.'</password>
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
        
         $res=array_filter($res);

         if($res[0]==30)
         {
            $response['message']="Geçersiz kullanıcı adı , şifre veya kullanıcınızın API erişim izninin olmadığını gösterir.Ayrıca eğer API erişiminizde IP sınırlaması yaptıysanız ve sınırladığınız ip dışında gönderim sağlıyorsanız 30 hata kodunu alırsınız. API erişim izninizi veya IP sınırlamanızı , web arayüzümüzden; sağ üst köşede bulunan ayarlar> API işlemleri menüsunden kontrol edebilirsiniz.";
            $response['code']=$res[0];
         }
         else if($res[0]==40)
         {
            $response['message']="Arama kriterlerinize göre listelenecek kayıt olmadığını ifade eder.";
            $response['code']=$res[0];
         }
         else if($res[0]==70)
         {
            $response['message']="Hatalı sorgulama. Gönderdiğiniz parametrelerden birisi hatalı veya zorunlu alanlardan birinin eksik olduğunu ifade eder.";
            $response['code']=$res[0];
         }
         else{
            $response=$res;
         }
         return $response;
    }
}