<?php

require '../../AltoRouter.php';

// Force request_order to be GP
// http://www.mail-archive.com/internals@lists.php.net/msg33119.html
$_REQUEST = array_merge($_GET, $_POST);

$router = new AltoRouter();
//$router->setBasePath('/AltoRouter/examples/basic');
$router->map('GET|POST','/', 'home#index', 'home');
$router->map('GET','/users/', array('c' => 'UserController', 'a' => 'ListAction'));
$router->map('GET','/users/[i:id]', 'users#show', 'users_show');
$router->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');

// match current request
$match = $router->match();
?>
<h1>AltoRouter</h1>

<h3>Current request: </h3>
<pre>
	Target: <?php print_r($match['target']); ?>
	Params: <?php print_r($match['params']); ?>
	Name: 	<?php print_r($match['name']); ?>
</pre>

<h3>Try these requests: </h3>
<p><a href="<?php echo $router->generate('home'); ?>">GET <?php echo $router->generate('home'); ?></a></p>
<p><a href="<?php echo $router->generate('users_show', array('id' => 5)); ?>">GET <?php echo $router->generate('users_show', array('id' => 5)); ?></a></p>
<p><form action="<?php echo $router->generate('users_do', array('id' => 10, 'action' => 'update')); ?>" method="post"><button type="submit"><?php echo $router->generate('users_do', array('id' => 10, 'action' => 'update')); ?></button></form></p>
