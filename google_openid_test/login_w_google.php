
<?php
require_once 'openid.php';
$openid = new LightOpenID("maydenlab.slu.edu");
 
if ($openid->mode) {
    if ($openid->mode == 'cancel') {
        echo "User has canceled authentication !";
        echo "<a href=\"example1.php\">Login</a>";
    } elseif($openid->validate()) {
        $data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
        echo "Identity : $openid->identity <br>";
        echo "Email : $email <br>";
        echo "First name : $first";
    } else {
        echo "The user has not logged in";
    }
} else {
    echo "Go to index page to log in.";
    echo "<a href=\"example1.php\">Login</a>";
}
?>

