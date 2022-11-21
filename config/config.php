<?php
//dir FOR NGINX
//url FOR APACHE
define('URL', 'url');
define('REGX_EMAIL', '/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/');
define('REGX_NKNAME', "/^([a-zA-z0-9]{3,})$/");
define('REGX_PWD',  "/^((?=.+[A-Za-z])(?=.+\d)(?=.+[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,})$/");

define('SNAME', '127.0.0.1');
define('UNAME', 'root');
define('DNAME', 'MERCADONA_DB');
define('PWD',  "");

define('REGX_NME', "/^[a-zA-Z\s]*$/");

//ADD YOUR PROYECT PATH
define('API', 'http://localhost/BDM/'); //URL FOR MY LOCAL
// define('API', 'http://10.52.3.61/captura/bdm/'); //URL FOR WORK LOCAL
?>