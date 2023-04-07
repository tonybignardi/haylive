<!DOCTYPE html>
<?php
$abreFotos=false;
$moderaFotos =false;
$qrcode=false;
$autorizado=true;
    if(isset($_POST["liveid"])){
        
        if(@opendir($_POST["liveid"]."/")){
            $abreFotos=true;
            
            $_GET["erro"]="";
            if($_POST["opcao"]=="MODERAR"){
                $abreFotos=false;
                $moderaFotos=true;
            }
         
            
        }else{
            header("location: index.php?erro=id");
        }
        if($_POST["opcao"]=="QRCODE"){
            $qrcode=true;
        }
        if($_POST["senha"]!="powerdjs"){
            $autorizado=false;
            $qrcode=false;
            $abreFotos=false;
            $moderaFotos=false;
        }
    
        }

?>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- PAGE settings -->
  <title>HAY LIVE - Mande sua Foto</title>
  <meta name="description" content="Robô único com sinais, copytrader e a sua própria estratégia">
  <meta name="keywords" content="IQ Option Robô Trader Estratégia CopyTrader">
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="colorful.css">
  <!-- Script: Navbar on-top -->
  <script src="js/navbar-ontop.js"></script>
</head>
<body style="background-color:black !important">
<iframe width="560" height="315" src="https://www.youtube.com/embed/o3TqmvSBNyQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<?php exit();?>
  <div class="modal fade youtube" id="meuyoutube">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body" style="background-color: black !important">
          <div class="row">
            <div class="col-md-12 px-3">
                   <?php 
                if(@$_GET["erro"]=="id"){
                ?>
                <div class="alert alert-primary">LIVE ID INVALIDO</div>
                <?php }?>
                   <?php 
                if(@!$autorizado){
                ?>
                <div class="alert alert-danger">SENHA INVALIDA</div>
                <?php }?>
                <?php 
                if(!$abreFotos && !$moderaFotos && !$qrcode ) { ?>
               <form action="" method="post">
		
        <h2 class="text-center">Acessar Hay Live</h2>   
                <div class="form-group">
        	<input type="text" class="form-control" name="liveid" placeholder="LIVE ID" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="senha" placeholder="SENHA HAYLIVE" required="required">
        </div>     
        <div class="form-group">
            <input type="number" class="form-control" name="transicao" placeholder="TRANSICAO" required="required">
        </div>     
        <div class="form-group">
            <select name="opcao">
                <option value="QRCODE">QRCODE</option>
                <option value="EXIBIR">EXIBIR</option>
                <option value="MODERAR">MODERAR</option>
                
            </select>
        </div>   
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
        </div>
    </form>
                <?php } ?>
                <?php if($qrcode){?>
                <div align="center">
                    <img width="400" height="400" src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=http://pertin.com.br/haylive/up.php?liveid=<?php echo $_POST["liveid"]?>">
                    <h3>HAY LIVE - <?php echo $_POST["liveid"];?></h3>
                </div>
                    <?php }?>
                <div id="divImage">
                    
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
         
         <?php if($abreFotos && $autorizado && !$qrcode){ ?>
                 
            $.ajax({url: "carrega.php?dir=<?php echo $_POST["liveid"]?>&t=<?php echo $_POST["transicao"];?>", success: function(result){
                 $("#divImage").html(result);
           }})
                 
           setInterval(function(){ 
                 $.ajax({url: "carrega.php?dir=<?php echo $_POST["liveid"]?>&t=<?php echo $_POST["transicao"];?>", success: function(result){
                 $("#divImage").html(result);
           }})}, <?php echo $_POST["transicao"];?>000);
         <?php  } ?>
            <?php if($moderaFotos && $autorizado && !$qrcode){ ?>
                
                 modera =   function(vv,arquivo,ob)
          {
              
              msg = "Deseja ocultar a foto";
              cor="green"
              if (vv==1)
                msg = "Deseja exibir a foto";    
                cor="red"
              //if (confirm(msg)){
                    
                $.ajax({url: "ren.php?dir=<?php echo @$_POST["liveid"];?>&chave=<?php echo @$_POST["senha"]; ?>&arq="+arquivo, success: function(result){
                
                    $.ajax({url: "modera.php?dir=<?php echo $_POST["liveid"]?>&t=<?php echo $_POST["transicao"];?>&moderar=1", success: function(result2){
                    $("#divImage").html(result2);
                    }})
                
                 
                }});
              //}
          
          }
                
            $.ajax({url: "modera.php?dir=<?php echo $_POST["liveid"]?>&t=<?php echo $_POST["transicao"];?>&moderar=1", success: function(result){
                $("#divImage").html(result);
           }})
          setInterval(function(){ 
                 $.ajax({url: "modera.php?dir=<?php echo $_POST["liveid"]?>&t=<?php echo $_POST["transicao"];?>&moderar=1", success: function(result){
                $("#divImage").html(result);
           }})}, <?php echo $_POST["transicao"];?>000);
         <?php  } ?>
 
     
    });
    
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- Script: Smooth scrolling between anchors in the same page -->
  <script src="js/smooth-scroll.js"></script>
</body>

</html>