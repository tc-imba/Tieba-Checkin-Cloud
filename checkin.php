private function gettbs()
	{
		$url = 'http://tieba.baidu.com/dc/common/tbs';
		$result = json_decode(file_get_contents($url));
		return $result->tbs;
	}

	public function getlist()
	{
		$url = 'http://tieba.baidu.com/f/like/mylike';
		$result = json_decode(file_get_contents($url));
		print_r($result);
	}

	public function send_post()
	{
		$this->getlist();
		$tbs = $this->gettbs();
		echo $tbs;

		$url = 'http://c.tieba.baidu.com/c/c/forum/sign';
		$post_data = array(
			'BDUSS' => 'UNmeGhjQU9NblY2VFNlMFBkNDZGYjJVektrQ3JmMm9mZ3NydXo0U0VPYkttelJYQVFBQUFBJCQAAAAAAAAAAAEAAAASyBw6zeO2ubzUsMkyODI1usUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMoODVfKDg1Xc',
			'fid'   => '179758',
			'kw'    => '西南位育',
			'tbs'   => $tbs,
		    'sign'  => ''
		);
		$sign = strtoupper(md5('BDUSS='.$post_data['BDUSS'].'fid='.$post_data['fid'].'kw='.$post_data['kw'].'tbs='.$post_data['tbs'].'tiebaclient!!!'));
		//echo $sign, '<br>';
		$post_data['sign'] = $sign;

		$postdata = http_build_query($post_data);
		$options = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type:application/x-www-form-urlencoded',
				'content' => $postdata,
				'timeout' => 15 * 60
			)
		);
		$context = stream_context_create($options);
		//$result = file_get_contents($url, false, $context);

		//echo $result;
	}
