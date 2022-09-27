<?php
define('URL', 'dir');
define('REGX_EMAIL', '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/');
define('REGX_NKNAME', "/^([a-zA-z0-9]{3,})$/");
define('REGX_PWD',  "/^((?=.+[A-Za-z])(?=.+\d)(?=.+[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,})$/");
define('REGX_NME', "/^[a-zA-Z\s]*$/");
//dir FOR NGINX
//url FOR APACHE
?>