<?php

class Funciones
{
	static function dateFormat($fecha, $formatoCorto = 0)
	{
		$phpdate = strtotime($fecha);
		if ($formatoCorto == 1)
			return date('M d', $phpdate);
		else
			return date('d/m/Y', $phpdate);
	}
	static function fechaToMySQL($fecha)
	{
		list($dia, $mes, $anio) = explode("/", $fecha);
		$fechaMySQL =  $anio . '-' . $mes . '-' . $dia;
		return $fechaMySQL;
	}
	static function fechaTweet($created_at)
	{
		$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

		// restar 18000 = 5 horas = 5 * 60 *60  -  hora del servidor de twitter
		$fechaTwitter = strtotime($created_at);

		$dia = date('j', $fechaTwitter);
		$mes = date('n', $fechaTwitter) - 1;
		$hora = date('G:i', $fechaTwitter);

		return "$dia $meses[$mes] $hora";
	}
	static function colorPregunta($frase)
	{
		$buscar = array('¿', '?');
		$reemplazar = array('<span>¿</span>', '<span>?</span>');
		return str_replace($buscar, $reemplazar, $frase);
	}
	static function getInstagramByTag($tag)
	{
		$access_token = '1721052998.09fd609.4df03f7022f244f0a2c03a9e2b98fcf8';
		$client_id = '09fd60952ea742d5abb761b6c6a137aa';
		$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id.'&count=30'; //.'&access_token='.$access_token;

		$all_result  = Funciones::processURL($url);
		$decoded_results = json_decode($all_result, true);
		return $decoded_results['data'];
	}
	static function processURL($url)
	{
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2
		));

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	static function crearCaptcha()
	{
		$font = 'fonts/DINNextLTPro-Light.ttf';
		$cadena = Funciones::generateString();

		$image = imagecreatetruecolor(110, 34);
		$bg = imagecolorallocate($image, 255, 103, 2);
		imagefill($image, 0, 0, $bg);

		$color = imagecolorallocate($image, 0, 0, 0);
		$line = imagecolorallocate($image, rand(0,255), rand(0,255), 220);

		imagettftext($image, 17, 0, 4, 20, $color, $font, $cadena);

		for($i = 0; $i <= count($cadena); $i++){
			$x1 = rand(0,100);
			$x2 = rand(0,100);
			$y1 = rand(0,100);
			$y2 = rand(0,100);
			imageline($image,$x1,$y1,$x2,$y2,$line);
		}

		imagealphablending($image, false);

		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
		header('Pragma: no-cache');
		header("Content-type: image/png");
		imagepng($image);
		imagedestroy($image);
	}
	static function generateString()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 6; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		Session::put('captchaseguridad', $randomString);
		return $randomString;
	}
	static function checkCaptcha($value)
	{
		$captchasess = Session::get('captchaseguridad');
		return $value != null && $captchasess != null && $captchasess == $value;
	}
	static function getIp()
	{
		return Request::getClientIp(true);
	}
	
}
