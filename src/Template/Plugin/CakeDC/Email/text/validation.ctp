<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$activationUrl = [
    '_full' => true,
    'plugin' => null,
    'prefix' => null,
    'controller' => 'Users',
    'action' => 'validateEmail',
    isset($token) ? $token : ''
];
?>
<?= __d('CakeDC/Users', "Hi {0}", isset($first_name)? $first_name : '') ?>,

<?= __d('CakeDC/Users', "Please copy the following address in your web browser {0}", $this->Url->build($activationUrl)) ?>

<?= __d('CakeDC/Users', 'Thank you') ?>,
