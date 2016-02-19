<?php 

namespace Epigra;

class TRStringHelper {

	private $string;

	private $harfler = [
		'B' => ['I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'],
		'k' => ['ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'],
		'Bi' => [' I', ' ı', ' İ', ' i'],
		'ki' => [' I', ' I', ' İ', ' İ']
	];

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

	function __construct($input=""){
		if($input) $this->string = $input;
		
		return $this;
	}

	public function toLower(){
		$this->string = $this->settolower($this->string);
		return $this;
	}

	public function toUpper(){
		$this->string = $this->settoupper($this->string);
		return $this;
	}

	public function ucFirst(){
		$this->string = $this->setucfirst($this->string);
		return $this;
	}

	public function ucWords(){
		$this->string = $this->setucworsds($this->string);
		return $this;
	}

	public function capitalizeFirst($c = array('. ', '.', '? ', '?', '! ', '!', ': ', ':')){

		foreach ($c as $cc) {
			$s = explode($cc, $this->string);
			foreach ($s as $k => $ss) {
				$s[$k] = $this->setucfirst($ss);
			}
			$str = implode($cc, $s);
		}

		$this->string = $str;
		return $this;

		foreach ($c as $cc) {
		    $s = explode($cc, $this->string);
		    foreach ($s as $k => $ss) {
		        $s[$k] = $this->setucfirst($ss);
		    }
		    $str = implode($cc, $s);
		}
		$this->string = $str;
		return $this;
	}

	private function settolower($str){
		return mb_strtolower(str_replace($this->harfler['B'],$this->harfler['k'],$str) , 'utf-8');
	}

	private function settoupper($str){
		return mb_strtoupper(str_replace($this->harfler['k'],$this->harfler['B'], $str), 'utf-8');
	}

	private function setucfirst($str){
		return mb_strtoupper(str_replace($this->harfler['k'],$this->harfler['B'], mb_substr($str, 0, 1, 'utf-8')), 'utf-8') . mb_substr($str, 1, mb_strlen($str, 'utf-8') - 1, 'utf-8');
	}

	private function setucworsds($str){
		return ltrim(mb_convert_case(str_replace($this->harfler['Bi'],$this->harfler['ki'], ' ' . $str), MB_CASE_TITLE, 'utf-8'));
	}

	public function withString($str)
	{
		$this->string = $str;
		return $this;
	}

	public function withPangram(){
		shuffle(static::$pangrams);
		$this->string = static::$pangrams[0];
		return $this;
	}

	public function result()
	{
		return $this->string;
	}

	public static function pangram($value='')
	{
		shuffle(static::$pangrams);
		return static::$pangrams[0];
	}
}