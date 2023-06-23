<?php
	require ('db.class.php');

	// Instanciação da classe do banco de dados
	$db = new db();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>DentalUni</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
		<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<div class="cover" id="cover"></div>
		<div class="header">
			<a href="javascript:openModal('modalCreate')" class="btn btn-primary">Inserir Dentista</a>
		</div>
		</br>
		<!-- Criação da tabela de dentistas -->
		<table id="dent" class="table table-dark dentTable">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">Nome</th>
					<th scope="col">CRO</th>
					<th scope="col">Email</th>
					<th scope="col">Especialidades</th>
					<th scope="col">Ações</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
					// População da tabela com os dados do banco
					$dents = $db->read();
					foreach ($dents as $dent)
					{
						echo "<tr>";
						echo "<td>".$dent['id']."</td>";
						echo "<td>".$dent['name']."</td>";
						echo "<td>".$dent['cro']." - ".$dent['cro_uf']."</td>";
						echo "<td>".$dent['email']."</td>";
						echo "<td>".$dent['especialidades']."</td>";
						echo "<td><a href=\"javascript:openModal('modalUpdate')\" class=\"action\">Editar</a>&nbsp;&nbsp;<a href=\"javascript:openModal('modalDelete')\" class=\"action\">Excluir</a></td>";
						echo "<td>".$dent['esps_id']."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		

		<!-- Modal Inserir -->
		<div id="modalCreate" class="modal">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title">Inserir</h5>
				<a class="btn btn-secondary" href="javascript:closeModal()">
					<span>&times;</span>
				</a>
				</div>
				<div class="modal-body">
					<form id="formCreate" action="insert.php" method="post">
						<div class="row">
							<div class="col-md-6">
								<label>Nome</label>
								<input type="text" name="name" id="nameI" class="form-control">
							</div>
							<div class="col-md-4">
								<label>CRO</label>
								<input type="number" name="cro" id="croI" class="form-control">
							</div>
							<div class="col-md-2">
								<label>CRO UF</label>
								<input type="text" name="cro_uf" id="cro_ufI" class="form-control" maxlength="2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Email</label>
								<input type="text" name="email" id="emailI" class="form-control">
							</div>
							<div class="col-md-6">
								<label>Especialidades</label>
								<?php
									// Criação dos checkboxes de especialidades com os dados do banco
									$esps = $db->readEsp();
									foreach ($esps as $esp)
									{
										echo "<div class='form-check'>";
										echo "<input class='form-check-input' type='checkbox' value='".$esp['id']."' name='check[]' id='check".$esp['id']."'>";
										echo "<label class='form-check-label' for='check".$esp['id']."'>";
										echo $esp['nome'];
										echo "</label>";
										echo "</div>";
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button style="float: right;" type="submit" class="btn btn-success">Salvar</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="javascript:closeModal()">Cancelar</a>
				</div>
			</div>
		</div>

		<!-- Modal Editar -->
		<div id="modalUpdate" class="modal">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title">Editar</h5>
				<a class="btn btn-secondary" href="javascript:closeModal()">
					<span>&times;</span>
				</a>
				</div>
				<div class="modal-body">
					<form id="formUpdate" action="update.php" method="post">
						<div class="row">
							<div class="col-md-6">
								<label>Nome</label>
								<input type="text" name="name" id="nameU" class="form-control">
								<input type="hidden" name="id" id="idU">
							</div>
							<div class="col-md-4">
								<label>CRO</label>
								<input type="number" name="cro" id="croU" class="form-control">
							</div>
							<div class="col-md-2">
								<label>CRO UF</label>
								<input type="text" name="cro_uf" id="cro_ufU" class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Email</label>
								<input type="text" name="email" id="emailU" class="form-control">
							</div>
							<div class="col-md-6">
								<label>Especialidades</label>
								<?php
									// Criação dos checkboxes de especialidades com os dados do banco
									$esps = $db->readEsp();
									foreach ($esps as $esp)
									{
										echo "<div class='form-check'>";
										echo "<input class='form-check-input' type='checkbox' value='".$esp['id']."' name='check[]' id='checkU".$esp['id']."'>";
										echo "<label class='form-check-label' for='check".$esp['id']."'>";
										echo $esp['nome'];
										echo "</label>";
										echo "</div>";
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button style="float: right;" type="submit" class="btn btn-success">Salvar</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="javascript:closeModal()">Cancelar</a>
				</div>
			</div>
		</div>

		<!-- Modal Excluir -->
		<div id="modalDelete" class="modal">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title">Excluir</h5>
				<a class="btn btn-secondary" href="javascript:closeModal()">
					<span>&times;</span>
				</a>
				</div>
				<div class="modal-body">
					<form id="formDelete" action="delete.php" method="post" onsubmit="return confirm('Tem certeza que deseja excluir? Essa ação não pode ser desfeita.');">
						<div class="row">
							<div class="col-md-6">
								<label>Nome</label>
								<input type="text" name="name" id="nameD" class="form-control" disabled>
								<input type="hidden" name="id" id="idD">
							</div>
							<div class="col-md-4">
								<label>CRO</label>
								<input type="number" name="cro" id="croD" class="form-control" disabled>
							</div>
							<div class="col-md-2">
								<label>CRO UF</label>
								<input type="text" name="cro_uf" id="cro_ufD" class="form-control" disabled>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Email</label>
								<input type="text" name="email" id="emailD" class="form-control" disabled>
							</div>
							<div class="col-md-6">
								<label>Especialidades</label>
								<input type="text" name="esps" id="esps" class="form-control" disabled>
							</div>
						</div>
						</br>
						<div class="row">
							<div class="col-md-12">
								<button style="float: right;" type="submit" class="btn btn-success">Excluir</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="javascript:closeModal()">Cancelar</a>
				</div>
			</div>
		</div>
	</body>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="./script.js"></script>
</html>