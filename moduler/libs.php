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
        mkdir('../application/modules/'.$module_name.'/models');
        CreateModel($module_name);
        mkdir('../application/modules/'.$module_name.'/views');
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
?>
