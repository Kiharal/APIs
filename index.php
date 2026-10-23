<?php 
require_once __DIR__ . '/vendor/autoload.php';

use Unsplash\HttpClient;
use Unsplash\Search;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$access = 'yJzvQJAwsfFn1-FoxJGE2oqXviL9T6lh6eeqm-z0cXY';
$secret = 'gJd_LxAg-1OptAcMQoMisG-lW26vMbCfqd8Hi_rvUL0';
$app_name = 'Practice';


Unsplash\HttpClient::init([
    'applicationId' => $access,
    'secret' => $secret,
    'callbackUrl' => 'localhost/index.php',
    'utmSource' => $app_name
]);

$search = 'dog';
$page = 3;
$per_page = 14;
$orientation = 'landscape';

$result = Unsplash\Search::photos($search, $page, $per_page, $orientation);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        foreach ($result->getResults() as $image){
            echo "<img src='";
            echo $image['urls']['small'] ;
            echo "'> \n";
        }
        
    ?>    
</body>
</html>