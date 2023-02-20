
# Laravel ve Symfony Netgsm Account Entegrasyonu

Netgsm kredi ve paket sorgulama için kulanılan composer paketidir.

## İçindekiler
- [İletişim & Destek](#i̇letişim--destek)
- [Supported](#Supported-Laravel-Versions)
- [Kurulum](#kurulum)
- [Kredi Sorgulama](#kredi-sorgulama)
- [Paket Sorgulama](#paket-sorgulama)
# İletişim & Destek

 Netgsm API Servisi ile alakalı tüm sorularınızı ve önerilerinizi teknikdestek@netgsm.com.tr adresine iletebilirsiniz.


# Doküman 
https://www.netgsm.com.tr/dokuman/
 API Servisi için hazırlanmış kapsamlı dokümana ve farklı yazılım dillerinde örnek amaçlı hazırlanmış örnek kodlamalara 
 [https://www.netgsm.com.tr/dokuman](https://www.netgsm.com.tr/dokuman) adresinden ulaşabilirsiniz.


### Supported Laravel Versions

Laravel 6.x, Laravel 7.x, Laravel 8.x, Laravel 9.x, 

### Supported Lumen Versions

Lumen 6.x, Lumen 7.x, Lumen 8.x, Lumen 9.x, 

### Supported Symfony Versions

Symfony 4.x, Symfony 5.x, Symfony 6.x

### Supported Php Versions

PHP 7.2.5 ve üzeri

### Kurulum

<b>composer require netgsm/account</b>

.env  dosyası içerisinde NETGSM ABONELİK bilgileriniz tanımlanması zorunludur.  

<b>NETGSM_USERCODE=""</b>  
<b>NETGSM_PASSWORD=""</b>  
<b>NETGSM_HEADER=""</b>  

### KREDİ SORGULAMA

Aboneliğinizde bulunan Kredi bilgilerine bu servisten ulaşabilirsiniz.  

```php
        use Netgsm\Account\account;
	$kredi=new account;
       	$sonuc=$kredi->kredisorgu();
      	dd($sonuc);
        die;
``` 
#### Başarılı Sorgulama

```php
Array
(
    [durum] => Başarılı sorgulama
    [cüzdan] => 34,020
    [code] => 00
)

```
#### Başarısız Sorgulama

```php
Array
(
   [durum] => Geçersiz kullanıcı adı , şifre veya kullanıcınızın API erişim izninin olmadığını gösterir.  
   Ayrıca eğer API erişiminizde IP sınırlaması yaptıysanız ve sınırladığınız ip dışında gönderim sağlıyorsanız 30 hata kodunu  
   alırsınız.API erişim izninizi veya IP sınırlamanızı , web arayüzümüzden;  sağ üst köşede bulunan ayarlar> API işlemleri   
   menüsunden kontrol edebilirsiniz.
   [code] => 30
)

```

### PAKET SORGULAMA

Aboneliğinizde bulunan Paket - Kampanya bilgilerine bu servisten ulaşabilirsiniz.  

```phpphp
        use Netgsm\Account\account;
	$kredi=new account;
     	$sonuc=$kredi->paketsorgu();
       	dd($sonuc);
        die;
``` 

#### Başarılı Sorgulama

```php
Array
(
    [0] => 215 | Adet | Sms Hizmeti - Giden
)

```

#### Başarısız Sorgulama

```php
Array
(
   [durum] => Geçersiz kullanıcı adı , şifre veya kullanıcınızın API erişim izninin olmadığını gösterir.  
   Ayrıca eğer API erişiminizde IP sınırlaması yaptıysanız ve sınırladığınız ip dışında gönderim sağlıyorsanız 30 hata kodunu  
   alırsınız.API erişim izninizi veya IP sınırlamanızı , web arayüzümüzden;  sağ üst köşede bulunan ayarlar> API işlemleri   
   menüsunden kontrol edebilirsiniz.
   [code] => 30
)

```

