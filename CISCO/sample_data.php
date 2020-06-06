<?php 

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//usage 
// only min-width of cells is set
$mask = "|%5s |%-30s | %-20s | \n";
printf($mask, 'Num', 'Spid');
for($i=1;$i<=20;$i++)
{
    $code = generateRandomString(5);
    printf($mask, $i, "$code", "$code");

}
?>