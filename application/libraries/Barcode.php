<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barcode
{
    public function __construct()
    {
        require_once APPPATH.'third_party/Barcode/BarcodeGenerator.php';
    }
}