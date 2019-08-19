<?php
Class lib_php{
	private $dato_ej;

	public function __construct() {
        $this->dato_ej=1;
    }

	public function llamar_api_get($url_completa){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url_completa);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $resp= "cURL Error #:" . $err;
		} else {
		  $resp= json_decode($response);
		}
		return $resp;
	}

	public function llamar_api_post($url,$data){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $resp= "cURL Error #:" . $err;
		} else {
		  $resp= json_decode($response);
		}
		return $resp;
	}
	public function llamar_api_post_json($url,$data){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $resp= "cURL Error #:" . $err;
		} else {
		  $resp= json_decode($response);
		}
		return $resp;
	}
}

?>