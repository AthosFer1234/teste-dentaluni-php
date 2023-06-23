$(document).ready( function () {
	/*
		Inicialização e configuração da DataTable de dentistas
	*/
	var table = $("#dent").DataTable({
		"pageLength": 5, // Configura os dados exibidos por página para 5
		"lengthChange": false, // Impossibilita ao usuário mudar a quantidade de dados exibidos por página
		"info": false, // Não exibe as informações padrão da DataTable
		"language": { // Configura os textos exibidos na tabela
			"search": "Pesquisar", // Texto da barra de pesquisa
			"zeroRecords": "Nenhum registro encontrado", // Texto exibido caso não sejam encontrados dados
			"paginate": {
				"next": "Próxima", // Texto do botão de próxima página
				"previous": "Anterior" // Texto do botão de página anterior
		    },
		},
		"columnDefs": [{ // Torna as colunas de id invisíveis para o usuário, apenas para utilização dos dados
			target: 0,
			visible: false,
			searchable: false,
		},{
			target: 6,
			visible: false,
			searchable: false,
		}],
	});

	/*
		População dos formulários de edição e exclusão com os dados da tabela
	*/
	$("#dent tbody").on("click", "tr", function ()
	{
		$("#idU").val(table.row(this).data()[0]);
		$("#nameU").val(table.row(this).data()[1]);
		$("#croU").val(table.row(this).data()[2].split(" - ")[0]);
		$("#cro_ufU").val(table.row(this).data()[2].split(" - ")[1]);
		$("#emailU").val(table.row(this).data()[3]);
		var esps = table.row(this).data()[6].split("|");
		$.each(esps, function (i, v) // Marca as checkboxes de especialidade de acordo com os dados do dentista
		{
			$("#checkU"+v).prop("checked", true);
		});

		$("#idD").val(table.row(this).data()[0]);
		$("#nameD").val(table.row(this).data()[1]);
		$("#croD").val(table.row(this).data()[2].split(" - ")[0]);
		$("#cro_ufD").val(table.row(this).data()[2].split(" - ")[1]);
		$("#emailD").val(table.row(this).data()[3]);
		$("#esps").val(table.row(this).data()[4]);
	});
});

/*
	Função de abrir modal
	m recebe o id do modal a ser aberto
	Abre a cobertura da página, ao fundo do modal
*/
function openModal (m)
{
	$("#"+m).show();
	$("#cover").show();
}

/*
	Função de fechar modal
	Fecha todos os modais
	Fecha a cobertura da página, ao fundo do modal
*/
function closeModal ()
{
	$("#modalCreate").hide();
	$("#modalUpdate").hide();
	$("#modalDelete").hide();
	$("#cover").hide();
}