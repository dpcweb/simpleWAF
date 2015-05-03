<?php
class simpleWAF
{
	protected $logs = false;
	protected $parm;
	protected $ip;
	protected $vulns = ['union', 'by', '1 or 1', 'select'];

	public function __construct()
	{
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}
	
	/**
	* Add vulns to application
	*/
	public function add($item)
	{
		$this->vulns[] = $item;
	}
	
	/**
	* Secure a paramter ($_GET OR $_POST)
	*/
	public function secure($parm)
	{
		$this->parm = $parm;
	}

	/**
	* Add ip to blacklist (blacklist.txt file)
	*/
	public function blacklist()
	{
		file_put_contents("blacklist.txt", "{$this->ip} \n", FILE_APPEND);
	}

	/**
	* Saves logs about attacker( vuln, where, ip) to logs.txt
	*/
	public function logs($vuln, $where, $ip)
	{
		$message = "ip: [{$ip}] used [{$vuln}] on [{$where}] [".date("F j, Y, g:i a")."] \n";
		file_put_contents("logs.txt",  $message);
	}

	/**
	* Check for user ip if is banned in blacklist
	*/
	public function check()
	{
		$list = file_get_contents("blacklist.txt");
		$list = explode("\n", $list);
			foreach($list as $ip) {
				if($this->ip == trim($ip)){
					die('You are banned on this website!');
				}
			}
	}
	
	
	/**
	* Check in paramter if is used a value from vulns array.
	*/
	public function start()
	{
		if(is_array($this->parm)){
			foreach($this->parm as $key => $value)
			{
				foreach($this->vulns as $val){
					if(stripos($value, $val) !== false)
					{
						$this->logs($val, $key, $this->ip);
						$this->blacklist($this->ip);
						die('You are banned on this website!');
					}
				}
			}
		}
	}
}

