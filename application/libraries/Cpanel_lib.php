<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
class Cpanel_lib {

  public function __construct() {

    $CI =& get_instance();
		$CI->config->load('credentials');

    // DNS cPanel Credentials 
    $this->cPanelUser = $CI->config->item('CPANEL_USER');
    $this->cPanelPwd = $CI->config->item('CPANEL_PWD');
    $this->hostName = $CI->config->item('CPANEL_HOST_NAME');
    $this->mainDomain = $CI->config->item('CPANEL_MAIN_DOMAIN');
    $this->cPanelPort = $CI->config->item('CPANEL_PORT');
    
    // Mail cPanel Credentials 
    $this->mailcPanelUser = $CI->config->item('MAIL_CPANEL_USER');
    $this->mailcPanelPwd = $CI->config->item('MAIL_CPANEL_PWD');
    $this->mailhostName = $CI->config->item('MAIL_CPANEL_HOST_NAME');
    $this->mailmainDomain = $CI->config->item('MAIL_CPANEL_MAIN_DOMAIN');
    $this->mailcPanelPort = $CI->config->item('MAIL_CPANEL_PORT');

    // DNS  WHM Credentials 
    $this->whmUser = $CI->config->item('WHM_USER');
    $this->whmToken = $CI->config->item('WHM_API_TOKEN');

    // MAIL  WHM Credentials 
    $this->mailwhmUser = $CI->config->item('MAIL_WHM_USER');
    $this->mailwhmToken = $CI->config->item('MAIL_WHM_API_TOKEN');

}

/////////////// MYSQL CPANEL //////////////////

public function createDataBaseMySQL($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/create_database?name=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function createUserMySQL($user, $password) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/create_user?name=$user&password=$password";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function deleteDataBaseMySQL($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/delete_database?name=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function deleteUserMySQL($user) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/delete_user?name=$user";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}


public function setPrivilegesMySQL($user, $database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/set_privileges_on_database?user=$user&database=$database&privileges=ALL";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function setPasswordUserMySQL($user, $password) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/set_password?user=$user&password=$password";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function renameUserMySQL($userold, $usernew) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/rename_user?oldname=$userold&newname=$usernew";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function renameDataBaseMySQL($dbold, $dbnew) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/rename_database?oldname=$dbold&newname=$dbnew";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function checkDataBaseMySQL($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/check_database?name=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function dumpDataBaseMySQL($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Mysql/dump_database_schema?dbname=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}


/////////////// END MYSQL CPANEL //////////////////



/////////////// POSTGRESQL CPANEL //////////////////

public function createDataBasePostgre($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Postgresql/create_database?name=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function createUserPostgre($user, $password) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Postgresql/create_user?name=$user&password=$password";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function deleteDataBasePostgre($database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Postgresql/delete_database?name=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function deleteUserPostgre($user) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Postgresql/delete_user?name=$user";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function allPrivilegesPostgre($user, $database) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Postgresql/grant_all_privileges?user=$user&database=$database";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////////// END POSTGRESQL CPANEL //////////////////


/////////////// QUOTA CPANEL //////////////////

public function getLocalQuota() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Quota/get_local_quota_info";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getInfoQuota() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Quota/get_quota_info";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////////// END QUOTA CPANEL //////////////////


/////////////// GET SERVER INFO //////////////////

public function getServerInfo() {

$func = "https://$this->hostName:$this->cPanelPort/execute/ServerInformation/get_information";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////////// END SERVER INFO //////////////////

/////////////// DNSSEC //////////////////

public function enableDNSSEC($domain) {

  $func = "https://$this->hostName:$this->cPanelPort/execute/DNSSEC/enable_dnssec?domain=$domain";
  return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);
  
}

public function disableDNSSEC($domain) {

  $func = "https://$this->hostName:$this->cPanelPort/execute/DNSSEC/disable_dnssec?domain=$domain";
  return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);
  
}

public function getDNSSECkey($domain) {

  $func = "https://$this->hostName:$this->cPanelPort/execute/DNSSEC/fetch_ds_records?domain=$domain";
  return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);
  
}

/////////////// END DNSSEC //////////////////

/////////////// DNS MANAGMENT //////////////////

public function getDomainDnsRecords($domain) {

  $func = "https://$this->hostName:2087/json-api/dumpzone?api.version=1&domain=$domain";
  return $this->exe_whm($func,$this->whmUser,$this->whmToken);
  
}

public function setDomainDnsRecord($domain,$record) {

  $func = "https://$this->hostName:2087/json-api/addzonerecord";

  if($record['name'] == '@'){
    $record['name'] = $domain.'.';
  }

  $data = "class=IN" .
  "&domain={$domain}" .
  "&name={$record['name']}" .
  "&address={$record['address']}" .
  "&ttl={$record['ttl']}" .
  "&type={$record['type']}";

  if($record['type'] == 'MX'){
    $data .= "&exchange={$record['address']}";
    $data .= "&preference={$record['preference']}";
  }

  if($record['type'] == 'CNAME'){
    $data .= "&cname={$record['address']}";
  }

  if($record['type'] == 'TXT'){
    $data .= "&txtdata={$record['address']}";
  }

  if($record['type'] == 'NS'){
    $data .= "&nsdname={$record['address']}";
  }

  return $this->exe_whm_post($func,$data,$this->whmUser,$this->whmToken);
  
}

public function editDomainDnsRecord($domain,$record) {

  $func = "https://$this->hostName:2087/json-api/editzonerecord";

  if($record['name'] == '@'){
    $record['name'] = $domain.'.';
  }

  $data = "line={$record['line']}" .
  "class=IN" .
  "&domain={$domain}" .
  "&name={$record['name']}" .
  "&address={$record['address']}" .
  "&ttl={$record['ttl']}" .
  "&type={$record['type']}";

  if($record['type'] == 'MX'){
    $data .= "&exchange={$record['address']}";
    $data .= "&preference={$record['preference']}";
  }

  if($record['type'] == 'CNAME'){
    $data .= "&cname={$record['address']}";
  }

  if($record['type'] == 'TXT'){
    $data .= "&txtdata={$record['address']}";
  }

  if($record['type'] == 'NS'){
    $data .= "&nsdname={$record['address']}";
  }

  return $this->exe_whm_post($func,$data,$this->whmUser,$this->whmToken);
  
}

public function deleteDomainDnsRecord($domain,$line) {

  $func = "https://$this->hostName:2087/json-api/removezonerecord?api.version=1&zone=$domain&line=$line";

    return $this->exe_whm($func,$this->whmUser,$this->whmToken);
  
}

/////////////// END DNS MANAGMENT //////////////////

public function clearSpamBox() {

$func = "https://$this->hostName:$this->cPanelPort/execute/SpamAssassin/clear_spam_box";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getBandwidth($timezone) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Stats/get_bandwidth?timezone=$timezone";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getErrors() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Stats/get_site_errors?domain=$this->mainDomain&log=suexec&maxlines=250";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function createSubdomain($subdomain, $folder = '') {

if($folder == '') {
    $folderdir = '%2Fpublic_html%2F'.$subdomain;
} else {
    $folderdir = '%2Fpublic_html%2F'.$folder;
}

$func = "https://$this->hostName:$this->cPanelPort/execute/SubDomain/addsubdomain?domain=$subdomain&rootdomain=$this->mainDomain&dir=$folderdir&disallowdot=0";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function createAddondomain($domain) {

if($folder == '') {
    $folderdir = 'public_html';
} else {
    $folderdir = '%2Fpublic_html%2F'.$folder;
}

$func = "https://$this->hostName:$this->cPanelPort/json-api/cpanel?cpanel_jsonapi_user=user&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=AddonDomain&cpanel_jsonapi_func=addaddondomain&dir=$folderdir&newdomain=$domain&subdomain=$domain";


return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getAddondomainList($domain) {

  
$func = "https://$this->hostName:$this->cPanelPort/json-api/cpanel?cpanel_jsonapi_user=user&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Park&cpanel_jsonapi_func=listaddondomains&regex=$domain";

return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// BACKUPS ///////////////

public function ftpBackupFull($username, $password, $ftp, $emailnoty, $dirftp = 'public_ftp', $port = '21') {

$func = "https://$this->hostName:$this->cPanelPort/execute/Backup/fullbackup_to_ftp?variant=active&username=$username&password=$password&host=$ftp&port=$port&directory=%2F$dirftp&email=$emailnoty";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function createBackup() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Backup/fullbackup_to_homedir";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function restaureBackup($dir) {

// /home/cpuser/backup_cpuser_9-10-2019.tar.gz

$func = "https://$this->hostName:$this->cPanelPort/execute/Backup/restore_files?backup=$dir&verbose=1&timeout-3600";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// END BACKUPS ///////////////

/////////// FTP ///////////////

public function ftpCreate($user, $password, $quota = '1024') {

$func = "https://$this->hostName:$this->cPanelPort/execute/Ftp/add_ftp?user=$user&pass=$password&quota=$quota";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function ftpHomeDir($user, $homedir) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Ftp/set_homedir?user=$user&domain=$this->mainDomain&homedir=$homedir%2F";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function ftpQuota($user, $quota) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Ftp/set_quota?user=$user&quota=$quota";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function ftpSetPassword($user, $password) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Ftp/passwd?user=$user&pass=$password";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function ftpDelete($user) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Ftp/delete_ftp?user=$user&destroy=1";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// END FTP ///////////////


/////////// EMAIL ///////////////

public function createEmail($usermail, $password, $quota) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/add_pop?email=$usermail&password=$password&quota=$quota&domain=$this->mailmainDomain&send_welcome_email=1";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);


}

public function deleteEmail($usermail) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/delete_pop?email=$usermail&domain=$this->mailmainDomain";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function listEmail($usermail) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/list_pops?regex=$usermail";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}


public function setPasswordEmail($usermail, $password, $domain) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/passwd_pop?email=$usermail&password=$password&domain=$domain";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}


public function addSpamFilter($email, $score = '8.0') {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/add_spam_filter?required_score=$score&account=$email";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function addForwarder($usermail, $emailfwd) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/add_forwarder?domain=$this->mailmainDomain&email=$usermail%40$this->mailmainDomain&fwdopt=fwd&fwdemail=$emailfwd";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function suspendEmail($email) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/suspend_login?email=$email";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function unsuspendEmail($email) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/unsuspend_login?email=$email";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function verifyPasswordEmail($email, $password) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/verify_password?email=$email&password=$password";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function traceDeliveryEmail($email) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/trace_delivery?recipient=$email";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function getSpamSettings($email) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/get_spam_settings?account=$email";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function quotaEmail($usermail) {

$func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Email/get_pop_quota?email=$usermail&domain=$this->mailmainDomain&as_bytes=1";
return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);

}

public function createEmailLoginSession($usermail,$password,$domain_name) {

  $func = "https://$this->mailhostName:$this->mailcPanelPort/execute/Session/create_webmail_session_for_mail_user_check_password?login=$usermail&domain=$domain_name&password=$password";
  return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);
  
}

public function getSPFrecords($domain) {

  $func = "https://$this->mailhostName:2087/json-api/validate_current_spfs?api.version=1&domain=$domain";
    return $this->exe_whm($func,$this->mailwhmUser,$this->mailwhmToken);
  
}

public function getDKIMrecords($domain) {

  $func = "https://$this->mailhostName:2087/json-api/validate_current_dkims?api.version=1&domain=$domain";
    return $this->exe_whm($func,$this->mailwhmUser,$this->mailwhmToken);
  
}

public function createEmailAddondomain($domain) {

  if($folder == '') {
      $folderdir = 'public_html';
  } else {
      $folderdir = '%2Fpublic_html%2F'.$folder;
  }
  
  $func = "https://$this->mailhostName:$this->mailcPanelPort/json-api/cpanel?cpanel_jsonapi_user=user&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=AddonDomain&cpanel_jsonapi_func=addaddondomain&dir=$folderdir&newdomain=$domain&subdomain=$domain";
  
  
  return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);
  
}

public function getEmailAddondomainList($domain) {
    
  $func = "https://$this->mailhostName:$this->mailcPanelPort/json-api/cpanel?cpanel_jsonapi_user=user&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Park&cpanel_jsonapi_func=listaddondomains&regex=$domain";
  return $this->exe_cpanel($func,$this->mailcPanelUser,$this->mailcPanelPwd);
  
}

/////////// END EMAIL ///////////////

/////////// ADDONS ///////////////


public function getUsages() {

$func = "https://$this->hostName:$this->cPanelPort/execute/ResourceUsage/get_usages";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getResellers() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Resellers/list_accounts";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function setLocale($locale = 'en') {

$func = "https://$this->hostName:$this->cPanelPort/execute/Locale/set_locale?locale=$locale";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getThemes() {

$func = "https://$this->hostName:$this->cPanelPort/execute/Themes/get_theme_base";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function setTheme($theme = 'paper_lantern') {

$func = "https://$this->hostName:$this->cPanelPort/execute/Themes/update?theme=$theme";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function emptyTrash($days = '31') {

$func = "https://$this->hostName:$this->cPanelPort/execute/Fileman/empty_trash?&older_than=$days";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// SSL ///////////////

public function autoSSL() {

$func = "https://$this->hostName:$this->cPanelPort/execute/SSL/start_autossl_check";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}


public function autoSSLProblems() {

$func = "https://$this->hostName:$this->cPanelPort/execute/SSL/get_autossl_problems";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function autoSSLExclude($domain) {

$func = "https://$this->hostName:$this->cPanelPort/execute/SSL/add_autossl_excluded_domains?domains=$domain";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function autoSSLRemoveExclude($domain) {

$func = "https://$this->hostName:$this->cPanelPort/execute/SSL/remove_autossl_excluded_domains?domains=$domain";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// TOKEN LOGIN ///////////////

public function createToken($nametoken, $time = '6') {

$timetoken = strtotime("+$time hours"); // Default Hours
$func = "https://$this->hostName:$this->cPanelPort/execute/Tokens/create_full_access?name=$nametoken&expires_at=$timetoken";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function revokeToken($nametoken) {

$func = "https://$this->hostName:$this->cPanelPort/execute/Tokens/revoke?name=$nametoken";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// WORDPRESS FUNCTION ///////////////

public function wordpressBackup() {

$func = "https://$this->hostName:$this->cPanelPort/execute/WordPressBackup/start?site=$this->mainDomain";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function wordpressSetPassword($wpid, $password) {

$func = "https://$this->hostName:$this->cPanelPort/execute/WordPressInstanceManager/change_admin_password?id=$wpid&password=$password";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function wordpressRestaure($backupfile) {
    
//PATCH DO BACK /home/user/public_html/backup.gz

$func = "https://$this->hostName:$this->cPanelPort/execute/WordPressRestore/start?site=$this->mainDomain&backup_path=$backupfile";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

/////////// DOMAINS ///////////////

public function listDomains() {

$func = "https://$this->hostName:$this->cPanelPort/execute/DomainInfo/list_domains";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function listDataDomains() {

$func = "https://$this->hostName:$this->cPanelPort/execute/DomainInfo/domains_data?format=hash&return_https_redirect_status=1";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}

public function getDataDomain($domain) {

$func = "https://$this->hostName:$this->cPanelPort/execute/DomainInfo/single_domain_data?domain=$domain&return_https_redirect_status=1";
return $this->exe_cpanel($func,$this->cPanelUser,$this->cPanelPwd);

}



/////////// PASSWORDS ///////////////

public function secure_password($length = 20){
  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789-=~!@#$%^&*()_+./<>?;:[]{}|';

  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[random_int(0, $max)];

  return $str;
}


public function simple_password($length = 20) {
    
    $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
    $password = substr(str_shuffle($password_string), 0, 12);
    return $password;
}


// END FUNCTIONS 



private function exe_cpanel($func = '',$cPanelUser,$cPanelPwd) {
    $query = $func;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    $header[0] = "Authorization: Basic " . base64_encode($cPanelUser.":".$cPanelPwd) . "\n\r";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $query);
    $result = curl_exec($curl);

    if ($result == false) {
        error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");   
    }
    curl_close($curl);
    return $result;
}

private function exe_whm($func = '',$user,$token) {

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

  $header[0] = "Authorization: whm $user:$token";
  curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
  curl_setopt($curl, CURLOPT_URL, $func);

  $result = curl_exec($curl);

  $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($http_status != 200) {
      echo "[!] Error: " . $http_status . " returned\n";
  }

  curl_close($curl);
  return $result;
}

private function exe_whm_post($func = '',$data,$user,$token) {

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST ,POST);
  curl_setopt($curl, CURLOPT_POSTFIELDS ,$data);

  $header[0] = "Authorization: whm $user:$token";
  curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
  curl_setopt($curl, CURLOPT_URL, $func);

  $result = curl_exec($curl);

  $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  if ($http_status != 200) {
      echo "[!] Error: " . $http_status . " returned\n";
  }

  curl_close($curl);
  return $result;
}

}
?>