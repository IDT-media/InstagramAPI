<?php 

$module_name = "InstagramAPI";
$mod = $modules->get($module_name);

if(isset($_REQUEST['code'])) {
	if($data = $mod->getOAuthToken($_REQUEST['code'])) {	

		$tokens = $cache->get($mod::token);
		$tokens[$data->user->id] = $data->access_token;

		$cache->save($mod::token, $tokens, WireCache::expireNever);	
	}
}

// URL is hard coded, i know, it's a bit shitty wayt, but neither does PW provide module edit URL from API level!!!
$session->redirect($config->urls->root . "admin/module/edit?name=$module_name&collapse_info=1");

return $this->halt();
