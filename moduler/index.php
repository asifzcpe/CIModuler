<?php
  include_once('libs.php');
  echo "Do you want to initialize HMVC in your Codeigniter project?y/n".PHP_EOL;
  $handle=fopen("php://stdin","r");
  $given_answer=trim(fgets($handle));
  if($given_answer=='y' or $given_answer=='Y')
  {
      init();
  }
  else if($given_answer=='n' or $given_answer=='N')
  {
    echo 'no';
  }
  else
  {
    echo "Please, answer Y or N";
  }

  echo PHP_EOL."Module Name :".PHP_EOL;
  $module_name=fopen('php://stdin',"r");
  $given_module=trim(fgets($module_name));
  CreateModuleFoldersAndFiles($given_module);
?>
