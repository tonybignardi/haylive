<?php 
function numfoto($diretorio){
    $dir = opendir("$diretorio/");
    $total = 100;
while($arq = readdir($dir))
	{
    
		if(!in_array($arq,array(".","..")))
		{
                            $total+=1;
   		
		}
	}
    
        return $total;
        
}

if(isset($_POST))
{
    $f=@$_POST["ENVIOU"].' - '.@$_FILES["arquivo"]["name"];
    file_put_contents("ok.txt", $f);
}

    $enviaFoto = false;
    $msg="";
     if(isset($_GET["liveid"])){
        
        if(@opendir($_GET["liveid"]."/")){
            $enviaFoto=true;
        }
     }
     
	if(@$_POST["enviou"]=="S")
	{
		#echo "<pre>";
		#print_r($_FILES["arquivo"]);
		#echo "</pre>";
		$extensao = explode(".",$_FILES["arquivo"]["name"]);
		$ext = $extensao[sizeof($extensao)-1];
		
		//$caminhoNome="arquivos/".$_FILES["arquivo"]["name"];
		$caminhoNome=$_GET["liveid"]."/".numfoto($_GET["liveid"]).".".$ext;
                
                if(isset($_POST))
                {
                    $f=@$_POST["ENVIOU"].' - '.@$_FILES["arquivo"]["name"];
                    file_put_contents("ok.txt", $f."S");
                }
		if($_FILES["arquivo"]["size"]<=(1024*1000))
		{
			if(isset($_POST))
                            {
                                $f=@$_POST["ENVIOU"].' - '.@$_FILES["arquivo"]["name"];
                                file_put_contents("ok.txt", $f."tamok");
                            }
                        $copiou = copy($_FILES["arquivo"]["tmp_name"],$caminhoNome);
			if($copiou)
			{
				$enviaFoto=false;
                                $msg = "Enviada";
                                
                                if(isset($_POST))
                                    {
                                        $f=@$_POST["ENVIOU"].' - '.@$_FILES["arquivo"]["name"];
                                        file_put_contents("ok.txt", $f."enviadas");
                                    }
			}
		}else
		{
                    $enviaFoto=false;
                    $msg="Problema";
		}
		
		
		
	}



?>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <title>Hay - Live</title>
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="colorful.css">
  <!-- Script: Navbar on-top -->
    <link href="formstone/dist/css/upload.css" rel="stylesheet" type="text/css"/>
  


</head>
<body>
    
  <div class="modal fade youtube" id="meuyoutube">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div id="divImage">
                    <?php 
                    if($enviaFoto){?>
              
            <form action="" method="post" enctype="multipart/form-data"s>
       <h2 class="text-center">Enviar foto - Haylive</h2>   
        <div class="form-group">
        	<input type="file" class="form-control" name="arquivo" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="enviou" value="S" class="btn btn-primary btn-lg btn-block">ENVIAR FOTO</button>
        </div>
            </form>
                    <?php }else{
                        if($msg=="") {
                        ?>
                         <div class="alert alert-primary">LIVE ID INVALIDO</div>
                    <?php
                    }
                        
                    else{
                        if($msg=="Enviada"){?>
                         <div class="alert alert-success">FOTO ENVIADA</div>
                        <?php } else {?>
                     <div class="alert alert-danger">PROBLEMA AO ENVIAR</div>
                    <?php }}}
                    ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script>
  
     $(document).ready(function(){
         $("#meuyoutube").modal("show");
         
    });
    
  </script>
  <script src="js/navbar-ontop.js"></script>
  <script src="formstone/dist/js/core.js" type="text/javascript"></script>
<script src="formstone/dist/js/upload.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- Script: Smooth scrolling between anchors in the same page -->
  
  <script src="js/smooth-scroll.js"></script>
</body>

</html>