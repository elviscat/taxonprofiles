<?php
require_once 'openid.php';
$openid = new LightOpenID("maydenlab.slu.edu");


echo $openid->mode;

$openid->identity = 'https://www.google.com/accounts/o8/id';
$openid->required = array(
  'namePerson/first',
  'namePerson/last',
  'contact/email',
);
$openid->returnUrl = 'http://maydenlab.slu.edu/~hwu5/taxonprofiles/google_openid_test/login_w_google.php'
?>
 
<a href="<?php echo $openid->authUrl() ?>">Login with Google</a>
