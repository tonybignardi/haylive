<?php
$date = new DateTime();
$tempototal= $date->getTimestamp();
$diretorio = @$_GET["dir"];
if(!isset($_GET["dir"]))
    header("location: index.php");
$tempo=$_GET["t"];
$dir = opendir("$diretorio/");
$total = 0;
$vet=array();
$exts=array();
while($arq = readdir($dir))
	{
    
		if(!in_array($arq,array(".","..")))
		{
                    
                    $ext = explode(".",$arq);
                    $extensao = end($ext);
                    if(substr($ext[0],-2)=="ok")
                    {
                            $total+=1;
                            $vet[]=substr($ext[0],0,-3);
                            $exts[substr($ext[0],0,-3)]=$extensao;
                    }
                   
                    
                  
				
		
		}
	}
     #print_r($vet);
     #echo $tempototal . " - ".($total*$tempo) . "<br>";
     sort($vet);
        #print_r($vet);
     #print_r($vet);
     #echo $tempototal%($total*$tempo);
     $vv = array();
     $ima=$tempototal;
     while($ima<$tempototal+$total*$tempo)
     {
         $vv[]=$ima%$tempototal+($tempototal%$tempo);
         $ima+=$tempo;
     }
     #echo "<br>";
     #print_r($vv);
     #echo "<br>";
     foreach($vv as $ind => $img)
     {
     if ($tempototal%($total*$tempo)==$img){
      #   echo $vet[$ind];
         $dfile = getimagesize($diretorio."/".$vet[$ind]."-ok.".$exts[$vet[$ind]]);
         if($dfile[0]>$dfile[1])
         echo "<img class='card-img center-block img-fluid d-block' width='100%' src='$diretorio/".$vet[$ind]."-ok.".$exts[$vet[$ind]]."'>";
         else
         echo "<div align='center'><img align='center' class='center-block d-block img-fluid' width='32%' src='$diretorio/".$vet[$ind]."-ok.".$exts[$vet[$ind]]."'></div>";
             
         
     }
     }
     
     
     
       
    
?>