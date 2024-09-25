<?php
//
//$floatVar = 1.2;
//
//$stringVar = 'prikol!';
//
//$intVar = 228;
//
//$numberStringVar = '1.2';
//
//$a = rand(0,9);
//
//$b = rand(0,9);
//
//$sum = $a + $b;
//
////if ($a == $b) {
////    echo "Hooray! Numbers are equal.<br>You are very lucky";
////} elseif ($sum>9) {
////    echo "Sum of the numbers is higher than 9.<br>That's all, there is no any sense";
////} else {
////    echo "The summary of numbers is lower than 9.<br>That's quite normal!";
////}
//
//function math ($a, $b, $c)
//{
//    $k = (100 * 109.24 * $a) / ($b - $c)**3;
//
//    if ($a>0 and $b>0 and $c>0 and $b>$c) {
//        return ceil($k);
//    } else {
//        return 'NULL';
//    }
//
//}
//
//echo math(0, 5, 3);
$host = 'mysql';
$dbname = 'example_app';
$username = 'sail';
$password = 'password';
$port = 3306;

$db = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);

$articles = $db->query("SELECT * FROM `articles`")->fetchAll(PDO::FETCH_ASSOC);

foreach ($articles as $article) {
    echo "{$article['title']}<br><br>";
}

?>

<pre>
<?php //print_r($articles); ?>
</pre>
