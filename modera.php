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
$tem=array();
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
                            $tem[]=substr($ext[0],0,-3);
                    }
                    else{
                      
                            $total+=1;
                            $vet[]=$ext[0];
                            $exts[$ext[0]]=$extensao;
                       
                    }
                 
		}
	}
     #print_r($vet);
     #echo $tempototal . " - ".($total*$tempo) . "<br>";
     sort($vet);
        #print_r($vet);
     #print_r($vet);
     #echo $tempototal%($total*$tempo);
   ;
     $html="";

     foreach($vet as $ind => $img)
     {
         #echo $img;
   
           if(in_array($img, $tem)){
                $dfile = getimagesize($diretorio."/".$vet[$ind]."-ok.".$exts[$vet[$ind]]);
                $w="height='150'";
                if($dfile[0]<$dfile[1])
                    $w="height='150' width='100'";
                    
               
         $html.= "<a onclick=\"modera(0,'$diretorio/".$vet[$ind]."-ok.".$exts[$vet[$ind]]."',this)". '" style="border:10px solid green;float:left">'."<img  $w  src='$diretorio/".$vet[$ind]."-ok.".$exts[$vet[$ind]]."'></a>";
           }else
           {
                $dfile = getimagesize($diretorio."/".$vet[$ind].".".$exts[$vet[$ind]]);
                $w="height='150'";
                if($dfile[0]<$dfile[1])
                    $w="height='150' width='100'";
               
         $html.= "<a onclick=\"modera(1,'$diretorio/".$vet[$ind].".".$exts[$vet[$ind]]."',this)".'" style="border:10px solid red;float:left">'."<img $w src='$diretorio/".$vet[$ind].".".$exts[$vet[$ind]]."'></a>";      
           }
   
     }
     echo $html;
     
     
     
       
    
?>