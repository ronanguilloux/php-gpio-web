<?php
/** [TITLE] class file
 * Created on 2013-03-18 at 22:04
 * @copyright Toog SARL (Nantes, France) 2013
 * @author Ronan - @arno_u_loginlux
 * @link http://http://www.toog.fr
 * @license :  see the LICENSE file this source code was distribued with
 * @version //autogentag//
 */

require_once __DIR__.'/../vendor/autoload.php';

use PhpGpio\Gpio;

$app = new Silex\Application();

$app->get('/blink/{id}', function ($id) use ($app) {
    $result = exec('sudo /usr/bin/php ../blinker 17 20000');
    return $result;
});


$app->get('/', function () use ($app) {
    return 'Home';
});


$app['debug'] = true;
$app->run();

?>

