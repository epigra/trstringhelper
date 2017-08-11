<?php

namespace Epigra;

class TRStringHelper
{
    /**
     * @var string
     */
    private $string;

    /**
     * @var array
     */
    private $alphabet = [
        'B'  => ['I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'],
        'k'  => ['ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'],
        'Bi' => [' I', ' ı', ' İ', ' i'],
        'ki' => [' I', ' I', ' İ', ' İ']
    ];

    /**
     * @var array
     */
    public static $pangrams = [
        'Cümleten şef garsonun verdiği hafif jöle kıvamında poğaçaya bakıyoruz.', // (32)
        'Jöle kıvamında beyaz şarap satan iflah olmaz çocuğu gördüm.', // (21)
        'Görevdeyken, fahişeye çubuk sürtüp ajite olmayacağız.', // (17)
        'Ve japon fahişe çocuklarımızın üstüne böyle geğirdi.', // (16)
        'Fütursuz hacı kaçtığına göre japon şemsiyeleri bedava.', // (18)
        'Fütursuz kaçığa göre japon şemsiyeleri bedava, hacı!', // (15)
        'Füsun kaçtığına göre yemyeşil japon cihazı bedava.', // (14)
        'Cılız ve duygulu japon balığı Fethi, sıçarken ölmüş.', // (14)
        'Bakkalı pejmürde gösteriveren fahişe çocuğuyuz.', // (13)
        'Çocuğu gramaj bazında ek hayvan itlafı pörsütmüş.', // (13)
        'Füsun, öptüğü çocuk bagaja sıkışır diye havlamaz.', // (12)
        'Tanrım, dört beş felç vaka, çoğu yüzgece sahip, Joe!', // (11)
        'Çoğu şef, garip bej cihazıyla müstakil eve döner.', // (11)
        'Hazcı bedevi yağlı ruju götüne sokup felç olmuş.', // (11)
        'Fahiş bluz güvencesi yağdırma projesi çöktü.', // (9)
        'Vakfın çoğu bu hayasız genci plajda görmüştü.', // (9)
        'Hayvancağız tüfekçide bagaj törpüsü olmuş.', // (8)
        'Öküz ajan hapse düştü yavrum, ocağı felç gibi.', // (8)
        'Bu Ganj öküzü hapis düştü yavrum, ocağı felç.', // (7)
        'Saf ve haydut kız çocuğu bin plaj görmüş.' // (4)
    ];

    /**
     * TRStringHelper constructor.
     *
     * @param string $input
     */
    public function __construct($input = '')
    {
        $this->string = $input;
    }

    /**
     * @return $this
     */
    public function toLower()
    {
        $this->string = $this->setToLower($this->string);
        return $this;
    }

    /**
     * @return $this
     */
    public function toUpper()
    {
        $this->string = $this->setToUpper($this->string);
        return $this;
    }

    /**
     * @return $this
     */
    public function ucFirst()
    {
        $this->string = $this->setUcFirst($this->string);
        return $this;
    }

    /**
     * @return $this
     */
    public function ucWords()
    {
        $this->string = $this->setUcWords($this->string);
        return $this;
    }

    /**
     * @param $str
     *
     * @return string
     */
    private function setToLower($str)
    {
        return mb_strtolower(str_replace($this->alphabet['B'], $this->alphabet['k'], $str), 'utf-8');
    }

    /**
     * @param $str
     *
     * @return string
     */
    private function setToUpper($str)
    {
        return mb_strtoupper(str_replace($this->alphabet['k'], $this->alphabet['B'], $str), 'utf-8');
    }

    /**
     * @param $str
     *
     * @return string
     */
    private function setUcFirst($str)
    {
        return mb_strtoupper(mb_substr(str_replace($this->alphabet['k'], $this->alphabet['B'], $str), 0, 1, 'utf-8'), 'utf-8') . mb_strtolower(mb_substr(str_replace($this->alphabet['B'], $this->alphabet['k'], $str), 1, mb_strlen($str, 'utf-8') - 1, 'utf-8'));
    }

    /**
     * @param $str
     *
     * @return string
     */
    private function setUcWords($str)
    {
        return mb_convert_case(ltrim(str_replace($this->alphabet['Bi'], $this->alphabet['ki'], ' ' . $str)), MB_CASE_TITLE, 'utf-8');
    }

    /**
     * @param $str
     *
     * @return $this
     */
    public function withString($str)
    {
        $this->string = $str;
        return $this;
    }

    /**
     * @param bool $isRandom
     *
     * @return $this
     */
    public function withPangram($isRandom = true)
    {
        $this->string = self::pangram($isRandom);
        return $this;
    }

    /**
     * @return string
     */
    public function result()
    {
        return $this->string;
    }

    /**
     * @param bool $isRandom
     *
     * @return string
     */
    public static function pangram($isRandom = true)
    {
        if ($isRandom) {
            shuffle(static::$pangrams);
        }
        return static::$pangrams[0];
    }
}
