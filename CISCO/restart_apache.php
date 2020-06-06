<?php

$submit = $_POST['submit'];

if($submit == "Restart") {

$message = '<p>Apache is being restarted</p>';
exec('/etc/init.d/httpd graceful');
$message .= '<p>Apache was restarted</p>';

}
echo '<html><head><title>Apache Restart</title></head><body>';
echo $message;
echo '<form action="" method="post">
<input type="submit" name="submit" value="Restart"></form>';

?>