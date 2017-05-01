<?php

    function init()
    {
      if(file_exists('../application/third_party/mx'))
      {
        MXToThirdPartyMX();
        CreateModulesFolder();
        return false;
      }
      else
      {
        //mkdir('../application/third_party');
        mkdir('../application/third_party/MX');
        MXToThirdPartyMX();
        CoreToCICore();
        CreateModulesFolder();
      }
    }

    function MXToThirdPartyMX()
    {
      $files_under_mx=scandir('mx');
      foreach($files_under_mx as $file)
      {
        if($file!='.' or $file!='..')
        @copy('mx/'.$file,'../application/third_party/mx/'.$file);
      }
    }
    function CoreToCICore(){
      $files_under_core=scandir('core');
      foreach($files_under_core as $file)
      {
        if($file!='.' or $file!='..')
        {
          @copy('core/'.$file,'../application/core/'.$file);
        }
      }
    }
    function CreateModulesFolder()
    {
      if(!file_exists('../application/modules'))
      {
        mkdir('../application/modules');
      }
    }

    function CreateModuleFoldersAndFiles($module_name)
    {
      if(file_exists('../application/modules/'.$module_name))
      {
        echo PHP_EOL.$module_name." is already an exiting module. Please, try another module name";
      }
      else
      {
        mkdir('../application/modules/'.strtolower($module_name));
        mkdir('../application/modules/'.$module_name.'/controllers');
        CreateController($module_name);
        WriteCodeToController($module_name);
        /*******************************************/
        mkdir('../application/modules/'.$module_name.'/models');
        CreateModel($module_name);
        /*******************************************/
        mkdir('../application/modules/'.$module_name.'/views');
        CreateView($module_name);
        /*******************************************/
      }
    }

    function CreateController($module_name)
    {
      fopen('../application/modules/'.$module_name.'/controllers/'.ucfirst($module_name.'.php'),'w');
    }

    function CreateModel($module_name)
    {
      fopen('../application/modules/'.$module_name.'/models/'.ucfirst($module_name.'_Model.php'),'w');
    }
    function CreateView($module_name)
    {
     fopen('../application/modules/'.$module_name.'/views/'.ucfirst($module_name.'_index.php'),'w'); 
     fopen('../application/modules/'.$module_name.'/views/'.ucfirst($module_name.'_views.php'),'w'); 
     fopen('../application/modules/'.$module_name.'/views/'.ucfirst($module_name.'_edit.php'),'w'); 
     fopen('../application/modules/'.$module_name.'/views/'.ucfirst($module_name.'_details.php'),'w');
    }

    function WriteCodeToController($module_name)
    {
      $handle=fopen('../application/modules/'.$module_name.'/controllers/'.ucfirst($module_name.'.php'),'w'); 
      $module_name_passed=ucfirst($module_name);
      $model_name='"'.$module_name.'_model"';
      $controller_pre_code=<<<EOD
      <?php 
      defined('BASEPATH') OR exit('No direct script access allowed');
      Class $module_name extends MX_Controller
      {
        public function __construct()
        {
          parent::__construct();
          \$this->load->model($model_name);
        }
        public function index()
        {

        }
        public function create()
        {

        }
        public function view()
        {

        }
        public function show(\$id)
        {

        }
        public function edit(\$id)
        {

        }

        public function update()
        {

        }

        public function delete(\$id)
        {

        }


      }
EOD;
      fwrite($handle,$controller_pre_code);
    }
?>
