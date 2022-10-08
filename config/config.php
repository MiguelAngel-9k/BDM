<?php
//dir FOR NGINX
//url FOR APACHE
define('URL', 'dir');
define('REGX_EMAIL', '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/');
define('REGX_NKNAME', "/^([a-zA-z0-9]{3,})$/");
define('REGX_PWD',  "/^((?=.+[A-Za-z])(?=.+\d)(?=.+[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,})$/");

define('SNAME', 'localhost');
define('UNAME', 'root');
define('DNAME', 'MERCADONA_DB');
define('PWD',  'quienSoy?Miguel9k');
define('REGX_NME', "/^[a-zA-Z\s]*$/");

//ADD YOUR PROYECT PATH
define('API', 'http://localhost/');
?>