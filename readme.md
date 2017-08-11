# PHP Türkçe Karakter Destekli String Fonksiyonları (toupper,tolower,ucfirst,ucwords) Kütüphanesi

## Yükleme
Composer ile yükleyebilirsiniz:
```
composer require epigra/trstringhelper
````

## Kullanım


```php
use Epigra\TRStringHelper;

$w = new TRStringHelper("dEneMe. çĞıŞöİÜ");
echo $w->toLower()->result(); // deneme. çğışöiü

$x = (new TRStringHelper())->withString("dEneMe. çĞıŞöİÜ")->toUpper()->result();
echo $x; // DENEME. ÇĞIŞÖİÜ

$y = (new TRStringHelper("dEneMe. çĞıŞöİÜ"))->ucFirst()->result();
echo $y; // Deneme. çğışöiü

$z = (new TRStringHelper())->withString("dEneMe. çĞıŞöİÜ")->ucWords()->result(); 
echo $z; // Deneme. Çğışöiü
```

## With Pangram (*)

```php
$p = (new TRStringHelper())->withPangram()->toUpper()->result();
echo $p;
```

## Random Pangram (*)
```php
$rp = TRStringHelper::pangram();
echo $rp;
```

https://tr.wikipedia.org/wiki/Pangram
http://www.afilifilintalar.com/pangramlar
