<?php
	define('WEBDAV_REQUIRES_LOGIN', true);
	define('WEBDAV_USER', 'eckraus');
	define('WEBDAV_PASSWORD', '8LK9BccSssu2');
	define('WEBDAV_BASE_URL', 'public_html/bcapi/mysql-export.csv/');
	define('DATE_BASED_DIR', true);

	function recursive_scan($src = './') {
		if(WEBDAV_REQUIRES_LOGIN == true) {
			$construct_url = '-u ' . WEBDAV_USER . ':' . WEBDAV_PASSWORD . ' ' . WEBDAV_BASE_URL;
		} else {
			$construct_url = WEBDAV_BASE_URL;
		}
	
		$all_content = scandir($src);
		if(DATE_BASED_DIR == true) {
			$folder = @date('m-y') . '-uploads';
			exec('curl -X MKCOL ' . $construct_url . $folder);
			$full_url = $construct_url . $folder . '/';
		} else {
			$full_url = $construct_url;
		}
		$upDir = str_replace('./', '', $src) . '/';
		if(strlen($upDir) > 0) {
			exec('curl -X MKCOL ' . $full_url . str_replace(' ', '', $upDir));
		}
		$files = array_diff($all_content, array('.', '..', pathinfo(__FILE__, PATHINFO_FILENAME) . '.' . pathinfo(__FILE__, PATHINFO_EXTENSION)));
		if(is_array($files)) {
			foreach ($files as $file) {
				if(is_dir($src.$file)) {
					exec('curl -X MKCOL ' . $full_url . str_replace(' ', '', $upDir) . str_replace(' ' , '', $file));
					recursive_scan($src.$file.'/');
				} else {
					exec('curl -T "' . $src . $file . '" ' . $full_url . str_replace(' ', '', $upDir) . str_replace(' ', '', $file));
				}
			}
		}
	}

    recursive_scan('./');
    ?>