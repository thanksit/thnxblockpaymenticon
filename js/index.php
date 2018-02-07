<?php
if(empty($_POST)) { die(); }
class ezTweet {
	private $consumer_key = '';
	private $consumer_secret =  '';
	private $user_token =  '';
	private $user_secret =  '';
	private $lib = './lib/';
	private $cache_enabled = false;
	private $cache_interval = 15;
	private $cache_dir = './';
	private $debug = false;
	public function __construct() {
		include_once('../../../config/config.inc.php');
		include_once('../../../init.php');
		$this->pathify($this->cache_dir);
		$this->pathify($this->lib);
		$this->message = '';
		$this->consumer_key =Configuration::get('thnx_TW_KEY');
		$this->consumer_secret = Configuration::get('thnx_TW_SECRET');
		$this->user_token =Configuration::get('thnx_TW_TOKEN');
		$this->user_secret = Configuration::get('thnx_TW_TSECRET');
		if($this->debug === true) {
			error_reporting(-1);
		} else {
			error_reporting(0);
		}
	}
	public function fetch() {
		echo json_encode(
			array(
				'response' => json_decode($this->getJSON(), true),
				'message' => ($this->debug) ? $this->message : false
			)
		);
	}
	private function getJSON() {
		if($this->cache_enabled === true) {
			$CFID = $this->generateCFID();
			$cache_file = $this->cache_dir.$CFID;
			if(file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * intval($this->cache_interval)))) {
				return file_get_contents($cache_file, FILE_USE_INCLUDE_PATH);
			} else {
				$JSONraw = $this->getTwitterJSON();
				$JSON = $JSONraw['response'];
				if($JSONraw['errno'] != 0) {
					$this->consoleDebug($JSONraw['error']);
					return $JSON;
				}
				if($this->debug === true) {
					$pj = json_decode($JSON, true);
					if(isset($pj['errors'])) {
						foreach($pj['errors'] as $error) {
							$message = 'Twitter Error: "'.$error['message'].'", Error Code #'.$error['code'];
							$this->consoleDebug($message);
						}
						return false;
					}
				}
				if(is_writable($this->cache_dir) && $JSONraw) {
					if(file_put_contents($cache_file, $JSON, LOCK_EX) === false) {
						$this->consoleDebug("Error writing cache file");
					}
				} else {
					$this->consoleDebug("Cache directory is not writable");
				}
				return $JSON;
			}
		} else {
			$JSONraw = $this->getTwitterJSON();

			if($this->debug === true) {
				// Check for CURL errors
				if($JSONraw['errno'] != 0) {
					$this->consoleDebug($JSONraw['error']);
				}
				$pj = json_decode($JSONraw['response'], true);
				if(isset($pj['errors'])) {
					foreach($pj['errors'] as $error) {
						$message = 'Twitter Error: "'.$error['message'].'", Error Code #'.$error['code'];
						$this->consoleDebug($message);
					}
					return false;
				}
			}
			return $JSONraw['response'];
		}
	}
	private function getTwitterJSON() {
		require $this->lib.'tmhOAuth.php';
		require $this->lib.'tmhUtilities.php';
		$tmhOAuth = new tmhOAuth(array(
			'host'                  => $_POST['request']['host'],
			'consumer_key'          => $this->consumer_key,
			'consumer_secret'       => $this->consumer_secret,
			'user_token'            => $this->user_token,
			'user_secret'           => $this->user_secret,
			'curl_ssl_verifypeer'   => false
		));
		$url = $_POST['request']['url'];
		$params = $_POST['request']['parameters'];

		$tmhOAuth->request('GET', $tmhOAuth->url($url), $params);
		return $tmhOAuth->response;
	}
	private function generateCFID(){
		return md5(serialize($_POST)).'.json';
	}
	private function pathify(&$path) {
		$path = realpath($path).'/';
	}
	private function consoleDebug($message) {
		if($this->debug === true) {
			$this->message .= 'tweet.js: '.$message."\n";
		}
	}
}
$ezTweet = new ezTweet;
$ezTweet->fetch();
?>
