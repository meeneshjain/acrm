<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Meenesh Jain
 *  License    : Protected 
 *  Email      : http://www.meeneshjain.com
 * 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/plugins/excel/PHPExcel.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
?>