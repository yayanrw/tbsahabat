<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['jwt_key'] = 'aYyWWEzd3aZOfjwOUEitwrFbATE21Z84zz';
$config['algorithm'] = 'HS256';

/*Generated token will expire in 1 minute for sample code
* Increase this value as per requirement for production
*/
$config['token_timeout'] = 1440; //24 jam

/* End of file jwt.php */
/* Location: ./application/config/jwt.php */
