<?php
$date = new DateTime();
$tempototal= $date->getTimestamp();
$diretorio = @$_GET["dir"];
if(!isset($_GET["dir"]))
    header("location: index.php");
$arq = $_GET["arq"];
echo $arq;
$ext = explode(".",$arq);
$extensao = end($ext);
if (substr($ext[0],-2)=="ok")
{
    rename($arq,substr($ext[0],0,-3).".".$extensao);
}
else
{
    rename($arq,$ext[0]."-ok.".$extensao);
}

        

?>