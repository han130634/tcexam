<?php
//============================================================+
// File name   : cp_class_mailer.php
// Begin       : 2001-10-20
// Last Update : 2009-02-12
// 
// Description : Extend PHPMailer class with inheritance
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com S.r.l.
//               Via della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//
// License: 
//    Copyright (C) 2004-2009  Nicola Asuni - Tecnick.com S.r.l.
//    
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//    
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//    
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.
//     
//    Additionally, you can't remove the original TCExam logo, copyrights statements
//    and links to Tecnick.com and TCExam websites.
//    
//    See LICENSE.TXT file for more information.
//============================================================+

/**
 * PHPMailer class extension.
 * @package PHPMailer
 * @author Nicola Asuni
 * @copyright Copyright &copy; 2004-2009, Nicola Asuni - Tecnick.com S.r.l. - ITALY - www.tecnick.com - info@tecnick.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link www.tecnick.com
 * @since 2005-02-24
 */

/**
 */

require_once('../config/tce_config.php');

require_once('../../shared/config/tce_email_config.php'); //Include default public variables

// Set the custom error handler function 
// This suppress the warnings due to the fact that phpmailer class is written in PHP4
$old_error_handler = set_error_handler('F_error_handler', E_ERROR | E_WARNING | E_PARSE);
// include the phpmailer class
require_once("../../shared/phpmailer/class.phpmailer.php");

/**
 * C_mailer - PHPMailer class extension
 * @author Nicola Asuni
 * @copyright Copyright &copy; 2004-2009, Nicola Asuni - Tecnick.com S.r.l. - ITALY - www.tecnick.com - info@tecnick.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link www.tecnick.com
 * @package PHPMailer
 * @since 2005-02-24
 */
class C_mailer extends PHPMailer {

	/**
     * language array
     * @var string array
     */
	public $language;
		
	/**
	 * Replace the default SetError
	 * @var string $msg error message
	 * @access public
     * @return void
	 */
	public function SetError($msg) {
        $this->error_count++;
        $this->ErrorInfo = $msg;
        F_print_error('ERROR', $msg);
		exit;
    }
	
	/**
     * Returns a message in the appropriate language.
     * (override original Lang method).
     * @var string $key language key
     * @access private
     * @return string
     */
    public function Lang($key) {
        if(isset($this->language['m_mailerror_'.$key])) {
            return $this->language['m_mailerror_'.$key];
        } else {
            return 'UNKNOW ERROR: ['.$key.']';
        }
    }
} //end of class

//============================================================+
// END OF FILE                                                 
//============================================================+
?>