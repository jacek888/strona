<?php
/**
 * @SWG\Info(title="My First API", version="0.1")
 */
header('Access-Control-Allow-Origin: *');


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '/var/www/html/strona/vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($config);

/**
 * @SWG\Get(
 *     path="/{miasto}",
 *     @SWG\Response(response="200", description="wyswietlenie wszystkich zjawisk w miescie"),
 *     @SWG\Response(response="404", description="brak zasobu")
 * )
 */

$app->get('/{miasto}', function ($request, $response, array $args) {
$miasto = $args['miasto'];

    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query(array('miasto'=>$miasto));
    $cursor = $manager->executeQuery('baza.miasta', $query);    
    
   //print_r($cursor->toArray());
   $tab= json_encode($cursor->toArray());

   preg_match_all('/".*?"|\'.*?\'/', $tab, $matches);
   print_r($matches);

});

/**
 * @SWG\Get(
 *     path="/{miasto}/{zjawisko}",
 *     @SWG\Response(response="200", description="wyswietlenie zjawiska w miescie"),
 *     @SWG\Response(response="404", description="brak zasobu")
 * )
 */
$app->get('/{miasto}/{warunki}', function ($request, $response, array $args) {

$miasto = $args['miasto'];
$warunki = $args['warunki'];

    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query(array('miasto'=>$miasto));
    $cursor = $manager->executeQuery('baza.miasta', $query);    
    

   $tab= json_encode($cursor->toArray());
    //echo $tab;
   preg_match_all('/".*?"|\'.*?\'/', $tab, $matches);
    if($warunki=="temp")
   print_r($matches[0][6]);
    elseif($warunki=="opady")
    print_r($matches[0][4]);
    else
    echo "blad";

});



/**
 * @SWG\Post(
 *     path="/",
 *     @SWG\Response(response="200", description="dodano miasto i warunki pogodowe"),
 *     @SWG\Response(response="404", description="brak zasobu")
 * )
 */
$app->post('/', function ($request, $response, array $args) {

if (($_SERVER['PHP_AUTH_USER']!='admin')&&($_SERVER['PHP_AUTH_PW']!='admin'))
 {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'brak dostepu';
    exit;
}

$bulk = new MongoDB\Driver\BulkWrite;
$obj = file_get_contents("php://input", "r");
$tresc=json_decode($obj,true);
$_id1 = $bulk->insert($tresc);

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$result = $manager->executeBulkWrite("baza.miasta", $bulk);

});


/**
 * @SWG\Put(
 *     path="/{miasto}",
 *     @SWG\Response(response="200", description="zaktualizowano warunki pogodowe w miescie"),
 *     @SWG\Response(response="404", description="brak zasobu")
 * )
 */
$app->put('/{miasto}', function ($request, $response, array $args) {

if (($_SERVER['PHP_AUTH_USER']!='admin')&&($_SERVER['PHP_AUTH_PW']!='admin'))
 {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'brak dostepu';
    exit;
}

$miasto = $args['miasto'];
        $string=file_get_contents("php://input");
  	$tresc=json_decode($string,true);
        $bulk = new MongoDB\Driver\BulkWrite;

        $bulk->update(['miasto'=>$miasto],
                      ['$set' => $tresc],
                      ['multi' => true]);    
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $result = $manager->executeBulkWrite("baza.miasta", $bulk);
echo 'put dziala';
});

/**
 * @SWG\Delete(
 *     path="/{miasto}",
 *     @SWG\Response(response="200", description="usuniecie miasta"),
 *     @SWG\Response(response="404", description="brak zasobu")
 * )
 */
$app->delete('/{miasto}', function ($request, $response, array $args) {

if (($_SERVER['PHP_AUTH_USER']!='admin')&&($_SERVER['PHP_AUTH_PW']!='admin'))
 {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'brak dostepu';
    exit;
}

$miasto = $args['miasto'];
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete(['miasto' => $miasto]);

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$result = $manager->executeBulkWrite("baza.miasta", $bulk);    
echo 'pomyslnie usunieto';
});


$app->run();
