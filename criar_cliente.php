<!--
	Autores:João Moacir Barth Junior
			Alan Palomero Machado
			Cynthia Rocha Oliveira

-->
<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/jinteki/system/system.php';
	//AcessPrivate();
	$key= $_GET['userkey'];
	

	//$dataUser = GetUser();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jinteki - Criar Cliente</title>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="estilos/w3.css">
  <link rel="stylesheet" href="estilos/bootstrap.min.css" />
  <script src="scripts/jquery.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
  <script src="scripts/center.js"></script>
  <script src="scripts/jquery.maskedinput.min.js"></script>
  <script src="scripts/jquery.validate.min.js"></script>
  <link rel="stylesheet" type="text/css" href="estilos/signin.css" />
  <link rel="stylesheet" href="estilos/movimentacao.css" />
  <link rel="stylesheet" href="estilos/detalhes.css" />
  <link rel="stylesheet" href="estilos/pendencias.css" /> 
  
</head>

<body>

	<iframe src="navbar.php" style=" margin-top: 10px; border: none; height: 70px; width: 100%"></iframe>

	<div class="container">

		<h3 class="titulo"><a href="movimentacoes.php">Home</a>><a class="active">Criar Morador</a></h3>
		<?php ValidateFormDweller() ?>
		<form action="criar_cliente.php" method="post" id="form_cli">
		<div class="meio">

			<div class="titulo-detalhes">Nome: </div> 
				<input class="w3-input inline " style="width:280px" type="text" name="nm_morador" form="form_cli" value="<?php echo GetPost('nm_morador'); ?> " data-validation="required" />
			<br />

			<div class="titulo-detalhes">Apartamento: </div> 
			<select name="ap" class="inline">
			<?php
			  $dataAP=DBRead('Apartamento as a','ORDER BY a.NomeAp','a.CodAp,a.NomeAp');
			  foreach ($dataAP as $res): ?>
			  	<option value="<?php echo $res['CodAp'] ?>"><?php echo $res['NomeAp'];?></option>
			  <?php endForEach;	?>
			</select>
			<br /><br />
			<div class="titulo-detalhes">TAGs: </div> <br />

			    <div class="container">
					<div class="row">
				        <div class="control-group" id="fields">
				            <div class="controls"> 
				                <form role="form" autocomplete="off" id="alt">
				                    <div class="entry input-group col-xs-3">


				                        <select class="form-control" name= "fields" form="form_cli">
				                        	<?php
												$dataM=DBRead('TAG as t','WHERE t.CodMorador is NULL AND t.Estado = 1 ORDER BY t.NumTag','t.CodMorador,t.NumTag');
											  	foreach ($dataM as $res) : ?>
											  		<option class="form-control campoTag" value="<?php echo $res['NumTag']; ?> "><?php echo $res['NumTag'];?></option>
											<?php endForEach; ?> 

				                        </select>
				                    	<span class="input-group-btn">
				                            <button class="btn btn-success btn-add" type="button">
				                                <span class="glyphicon glyphicon-plus"></span>
				                            </button>
				                        </span>
				                    </div>
				                </form>
				            <br>
				            </div>
				        </div>
					</div>
				</div>
			<div class="titulo-detalhes">Telefone 1: </div> 
				<input class="w3-input inline campoTelefone" style="width:130px" type="text" name="tel1" value="<?php echo GetPost('tel1'); ?>">
			<br />

			<div class="titulo-detalhes">Telefone 2: </div> 
				<input class="w3-input inline campoTelefone" style="width:130px" type="text" name= "tel2" value="<?php echo GetPost('tel2'); ?>">
			<br />

			<div class="titulo-detalhes">Email: </div> 
				<input class="w3-input inline" style="width:230px" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo GetPost('email'); ?>"  data-validation="email">
			<br />

			<div class="titulo-detalhes">RG: </div> 
				<input class="w3-input inline" style="width:110px"  type="text" name= "rg" id="RG" value="<?php echo GetPost('rg'); ?>">
			<br />

			<div class="titulo-detalhes">CPF: </div> 
				<input class="w3-input inline" style="width:120px"  type="text" name= "cpf" id="CPpF" value="<?php echo GetPost('cpf'); ?>" data-validation="cpf">
			<br /><br />
			  
			  <INPUT Type="button" class="botao-branco" VALUE="Voltar" onClick="history.go(-1);return true;">
			  <a type="button" class="botao" data-toggle="modal" data-target="#modalCriar">Criar</a>
		</div>
	</div>

		<!-- Modal -->
	  <div class="modal fade" id="modalCriar" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Confirmar Criação</h4>
	        </div>
	        <div class="modal-body">
	          <p class="vertical-center">Salvar o novo registro no banco de dados?</p>
	          <button type="button" class="btn btn-default left-2" data-dismiss="modal">Cancelar</button>
	          
	          <input class="btn btn-default right-2" type="submit" form="form_cli" name="send" value="Salvar"></input>
	        </div>
	      </div>      
   		</div>
   	</div>
   	</form>


<script>
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});
</script>

<script>
jQuery(function($){
       $(".campoTelefone").mask("(99) 9999-9999");
       $("#CPF").mask("999.999.999-99");
       $(".campoTag").mask("999.999.999");
});

</script>
<script>
  $.validate({
    modules : 'brazil'
  });
</script>
	

</body>
</html>