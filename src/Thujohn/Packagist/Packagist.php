<?php namespace Thujohn\Packagist;

class Packagist {
	public function query($name, $parameters = array()){
		$baseUrl = 'https://packagist.org/'.$name.'.json';

		$query = array_map("rawurlencode", $parameters);

		$baseUrl .= "?".http_build_query($query);
		$baseUrl = str_replace("&amp;","&",$baseUrl);

		$options = array();
		$options[CURLOPT_HEADER] = false;
		$options[CURLOPT_URL] = $baseUrl;
		$options[CURLOPT_RETURNTRANSFER] = true;
		$options[CURLOPT_SSL_VERIFYPEER] = false;
		$options[CURLOPT_USERAGENT] = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : 'Packagist L4';

		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$response = curl_exec($feed);
		curl_close($feed);

		return $response;
	}

	/**
	 * Parameters :
	 * - q
	 * - tags
	 */
	public function search($parameters = array(), $paginate = true){
		if (empty($parameters)){
			throw new \Exception('Parameter missing');
		}

		$results = array();
		$response = json_decode($this->query('search', $parameters));
		$results = $response->results;

		if (!$paginate && isset($response->next)){
			while (isset($response->next)){
				$url = parse_url($response->next);
				parse_str($url['query'], $query);
				$parameters['page'] = $query['page'];
				$response = json_decode($this->query('search', $parameters));
				$results = array_merge($results, $response->results);
			}
		}

		return $results;
	}

	public function package($package){
		$response = $this->query('p/'.$package);

		return json_decode($response);
	}

	public function packages($parameters = array()){
		$response = $this->query('packages/list', $parameters);

		return json_decode($response);
	}
}