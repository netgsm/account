
# Netgsm Account Laravel Paketi

Netgsm kredi ve paket sorgulama için kulanılan laravel paketidir.

### Supported Laravel Versions

Laravel 6.x, Laravel 7.x, Laravel 8.x, Laravel 9.x, 

### Supported Php Versions

PHP 7.2.5 ve üzeri

### Kurulum

composer require netgsm/account

.env  dosyası içerisinde NETGSM ABONELİK bilgileriniz tanımlanması zorunludur.  

<b>NETGSM_USERCODE=""</b>  
<b>NETGSM_PASSWORD=""</b>  
<b>NETGSM_HEADER=""</b>  

### KREDİ SORGULAMA

Aboneliğinizde bulunan Kredi bilgilerine bu servisten ulaşabilirsiniz.  

```
        use Netgsm\Account\account;
	$kredi=new account;
       	$sonuc=$kredi->kredisorgu();
      	echo '<pre>';
            print_r($sonuc);
        echo '<pre>';
``` 

### PAKET SORGULAMA

Aboneliğinizde bulunan Paket - Kampanya bilgilerine bu servisten ulaşabilirsiniz.  

```
        use Netgsm\Account\account;
	$kredi=new account;
     	$sonuc=$kredi->paketsorgu();
       	echo '<pre>';
            print_r($sonuc);
        echo '<pre>';
``` 

#### Başarılı Sorgulama

```
Array
(
    [durum] => Başarılı sorgulama
    [cüzdan] => 34,020
    [code] => 00
)

```
