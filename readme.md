# PHP Türkçe Karakter Destekli String Fonksiyonları (toupper,tolower,ucfirst,ucwords,capitalizefirst) Kütüphanesi

## Yükleme
composer üzerinden:
```
composer require epigra/trstringhelper
````
demeniz yeterli olacaktır.

## Kullanım


```php
use Epigra\TRStringHelper;

$x = new TRStringHelper("dEneMe. çĞıŞöİÜ");
echo $x->toLower()->result(); // toUpper,ucFirst, ucWords, capitalizeFirst

// veya

$y = (new TRStringHelper())->withString("dEneMe. çĞıŞöİÜ")->toLower()->capitalizeFirst()->result();
echo $y;

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
