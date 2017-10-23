<?php
if(isset($_FILES['fileUpload']))
{
      $title = $_FILES['fileUpload']['name']; //Pegando 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
      <title><?php if($title){ echo $title; }else{ echo "Raptor";} ?></title>
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style type="text/css">
    textarea{
        width: 100em;
    }
    </style>
  </head>
  <body>
      
      <form action="index.php" method="POST" enctype="multipart/form-data">
      <input class="btn btn-primary" type="file" name="fileUpload" accept=".txt">
      <input class="btn btn-success" type="submit" value="Enviar">
      
   </form>
<?php 
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

function getUrl($url)
{
    $dom = new Dom;
    $dom->load($url);
    $contents = $dom->find('meta');
    foreach ($contents as $content)
    {
        $propriedade = $content->getAttribute('property');
        if($propriedade == "og:video"){
            return $content->getAttribute('content');
        }
    }
}
echo "<div>";
if(isset($_FILES['fileUpload']))
{
      date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
      $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
      $dir = 'uploads/'; //Diretório para uploads
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
    $file = file($dir.$new_name);
    foreach ($file as $value)
    {
        $file = explode("- ", $value);
        $url = trim($file[1]);
        $num = trim($file[0]);
        if(filter_var($url, FILTER_VALIDATE_URL)) {
          //  echo "'".$file."'<br />";
            $url = getUrl($url);
            $url = explode("=", $url);
            echo $num. " - ";
            echo $url[0]; 
            echo "\n <br />";   
        }
    }
}
echo "</div>";
   

?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>