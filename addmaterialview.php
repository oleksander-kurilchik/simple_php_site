<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/interfaces/IMainPlaceDiv.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addmaterialview
 *
 * @author profesor
 */
class AddMaterialView implements IMainPlaceDiv  {
    public $header;
    public $material;
    public $headermessage;
    public $materialmessage;
    public $materrialaddedmessage; 
     public function __construct()
    {
        
    }

    public function buildForm()
    {
          $page =  file_get_contents("formaddmaterial.html");
          $page =  preg_replace('|{\$header}|im', $this->header,  $page);
          $page =  preg_replace('|{\$material}|im', $this->material,  $page);
          $page =  preg_replace('|{\$headermessage}|im', $this->headermessage,  $page);
          $page =  preg_replace('|{\$materialmessage}|im', $this->materialmessage,  $page);
          $page =  preg_replace('|{\$materrialaddedmessage}|im', $this->materrialaddedmessage,  $page);
          return $page;
        
    }


    //put your code here
}
