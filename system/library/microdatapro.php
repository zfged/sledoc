<?php
class MicrodataPro {
	public function opencart_version($d){
		$opencart_version = explode(".", VERSION);
		return $opencart_version[$d];
	}

	public function module_info($key, $admin = false){

		$domen = explode("//", $admin?HTTP_CATALOG:HTTP_SERVER);
		$information = array(
			'main_host'	=> str_replace("/", "", $domen[1]),
			'engine' 	=> VERSION,
			'version' 	=> '5.2',
			'module' 	=> 'MicrodataPro',
			'sys_key'	=> '327450',
			'sys_keyf'  => '7473'
		);
		return $information[$key];
	}
	
	public function clear($text = '') {
		if(is_string($text) && $text){
			$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8'); //переводим в теги
			$text = str_replace("><", "> <", $text); //что бы не слипался текст если есть пробел между тегами
			$text = str_replace(array("<br />", "<br>"), " ", $text); //fix br
			$text = strip_tags($text); //удаляем теги
			$find = array(PHP_EOL, "\r\n", "\r", "\n", "\t", '  ', '  ', '    ', '    ', '"', "'", "\\", '&varr;', '&nbsp;', '&pound;', '&euro;', '&para;', '&sect;', '&copy;', '&reg;', '&trade;', '&deg;', '&plusmn;', '&frac14;', '&frac12;', '&frac34;', '&times;', '&divide;', '&fnof;', '&Alpha;', '&Beta;', '&Gamma;', '&Delta;', '&Epsilon;', '&Zeta;', '&Eta;', '&Theta;', '&Iota;', '&Kappa;', '&Lambda;', '&Mu;', '&Nu;', '&Xi;', '&Omicron;', '&Pi;', '&Rho;', '&Sigma;', '&Tau;', '&Upsilon;', '&Phi;', '&Chi;', '&Psi;', '&Omega;', '&alpha;', '&beta;', '&gamma;', '&delta;', '&epsilon;', '&zeta;', '&eta;', '&theta;', '&iota;', '&kappa;', '&lambda;', '&mu;', '&nu;', '&xi;', '&omicron;', '&pi;', '&rho;', '&sigmaf;', '&sigma;', '&tau;', '&upsilon;', '&phi;', '&chi;', '&psi;', '&omega;', '&larr;', '&uarr;', '&rarr;', '&darr;', '&harr;', '&spades;', '&clubs;', '&hearts;', '&diams;', '&quot;', '&amp;', '&lt;', '&gt;', '&hellip;', '&prime;', '&Prime;', '&ndash;', '&mdash;', '&lsquo;', '&rsquo;', '&sbquo;', '&ldquo;', '&rdquo;', '&bdquo;', '&laquo;', '&raquo;'); //что чистим 
			$text = str_replace($find, ' ', $text); //чистим текст
		}
		return $text;
	}
	
	public function mbCutString($str, $length, $encoding='UTF-8'){
		if (function_exists('mb_strlen') && (mb_strlen($str, $encoding) <= $length)) {
			return $str;
		}
		if (function_exists('mb_substr')){
			$tmp = mb_substr($str, 0, $length, $encoding);
			return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding); 			
		}else{
			return $str;
		}
	}
	
	public function key($key, $admin = false){
		$license = false;
		$a=0;if(isset($key) && !empty($key)){ $key_array = explode("327450", base64_decode(strrev(substr($key, 0, -7))));if($key_array[0] == base64_encode($this->module_info('main_host',$admin)) && $key_array[1] == base64_encode($this->module_info('sys_key').$this->module_info('sys_keyf')+100)){$a= 1;}}
		return $license=str_replace($key,$this->module_info('main_host',$admin),$a);
	}	
}
?>