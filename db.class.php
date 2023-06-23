<?php

/*
	Criação da classe de conexão com o banco de dados
	Variáveis públicas $conn e $sth para uso das funções internas da classe
*/
class db
{
	public $conn;
	public $sth;

	/*
		Construtor para conexão com o banco de dados
	*/
	function __construct ()
	{
		try
		{
			$this->conn = new PDO('mysql:host=localhost:3306;dbname=processoSeletivo2023_Athos_Fernandez', 'root', '');
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) // Mensagem em caso de erro de conexão com o banco de dados
		{
			die("ERROR: Could not connect. " . $e->getMessage());
		}
	}

	/*
		Função de listagem para popular a tabela de dentistas na página principal
		Busca todos os dentistas com id, nome, email, CRO, UF da CRO e lista as especialidades, separando por vírgula, e o id de cada especialidade atrelada ao dentista, separados por pipe
	*/
	public function read()
	{
		try
		{
			$this->sth = $this->conn->prepare("SELECT d.id, d.name, d.email, d.cro, d.cro_uf, GROUP_CONCAT(especialidades.nome SEPARATOR ', ') AS especialidades, GROUP_CONCAT(especialidades.id SEPARATOR '|') AS esps_id FROM dentistas d JOIN dentistas_especialidades ON dentista_id = d.id JOIN especialidades ON dentistas_especialidades.especialidade_id = especialidades.id GROUP BY d.name ORDER BY d.id");
			$this->sth->execute();

			return $this->sth->fetchAll();
		} catch(PDOException $e) // Mensagem em caso de erro na busca dos dados
		{
			return 'Error: ' . $e->getMessage();
		}

	}

	/*
		Função de listagem para popular os checkboxes de especialidades nos formulários de criação de novo dentista e edição de dentista existente
	*/
	public function readEsp()
	{
		try
		{
			$this->sth = $this->conn->prepare("SELECT * FROM especialidades");
			$this->sth->execute();

			return $this->sth->fetchAll();
		} catch(PDOException $e) // Mensagem em caso de erro na busca dos dados
		{
			return 'Error: ' . $e->getMessage();
		}
	}

	/*
		Função de inserção de novo dentista no banco de dados
		$dados recebe todos os campos do form quando submetido
		O nome dos campos no form é o mesmo das colunas no banco de dados
	*/
	public function insert($dados)
	{
		try
		{
			$fields = "";
			$values = "";
			foreach ($dados as $campo => $valor) // Construção da string utilizando os nomes dos campos do form e os dados enviados
			{
				if ($campo != "check")
				{
					$fields .= $campo.", ";
					if ($campo == "cro")
						$values .= $valor.", ";
					else
						$values .= "'".$valor."', ";
				}
			}
			$fields = substr($fields, 0, -2); // Remove os últimos dois caracteres (vírgula e espaço) da string
			$values = substr($values, 0, -2); // Remove os últimos dois caracteres (vírgula e espaço) da string

			$sql = "INSERT INTO dentistas ($fields) VALUES ($values)"; // Insere os dados do dentista
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();

			$sql = "SELECT d.id AS id FROM dentistas d WHERE name = ".$dados['name']." AND cro = ".$dados['cro']." AND cro_uf = ".$dados['cro_uf']; // Busca o id do dentista que foi inserido
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();
			$maxID = $this->sth->fetchAll();

			$sql = "INSERT INTO dentistas_especialidades VALUES "; // Atrela o dentista à suas especialidades
			foreach ($dados['check'] as $valor)
			{
				$sql .= "(".$valor.", ".$maxID[0]['id']."), ";
			}
			$sql = substr($sql, 0, -2); // Remove os últimos dois caracteres (vírgula e espaço) da string
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();
		} catch(PDOException $e) // Mensagem em caso de erro na inserção dos dados no banco de dados
		{
			die("Error: " . $e->getMessage());
		}
	}

	/*
		Função de atualização dos dados de dentista no banco de dados
		$dados recebe todos os campos do form quando submetido
		O nome dos campos no form é o mesmo das colunas no banco de dados 
	*/
	public function update($dados)
	{
		try
		{
			$sql = "UPDATE dentistas SET ";

			foreach ($dados as $campo => $valor) // Construção da string utilizando os nomes dos campos do form e os dados enviados
			{
				if ($campo != "check" && $campo != "id")
				{
					$sql .= $campo . " = ";
					if ($campo == "cro")
						$sql .= $valor.", ";
					else
						$sql .= "'".$valor."', ";
				}
			}
			$sql = substr($sql, 0, -2); // Remove os últimos dois caracteres (vírgula e espaço) da string
			$sql .= " WHERE id = ".$dados['id'];

			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();

			$sql = "DELETE FROM dentistas_especialidades WHERE dentista_id = ".$dados['id']; // Apaga do banco de dados todas as especialidades atreladas ao dentista atualizado para evitar conflito nos dados
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();

			$sql = "INSERT INTO dentistas_especialidades VALUES ";
			foreach ($dados['check'] as $valor) // Construção da string de inserção das especialidades do dentista atualizado
			{
				$sql .= "(".$valor.", ".$dados['id']."), ";
			}
			$sql = substr($sql, 0, -2); // Remove os últimos dois caracteres (vírgula e espaço) da string
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();
		} catch(PDOException $e) // Mensagem em caso de erro na atualização dos dados
		{
			die("Error: " . $e->getMessage());
		}

	}

	/*
		Função de exclusão de dentista do banco de dados
		$id recebe o id do dentista a ter seus dados excluídos
	*/
	public function delete($id)
	{
		try
		{
			$sql = "DELETE FROM dentistas WHERE id = ".$id; // Remove todos os dados do dentista
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();

			$sql = "DELETE FROM dentistas_especialidades WHERE dentista_id = ".$id; // Remove todas as especialidades do dentista
			$this->sth = $this->conn->prepare($sql);
			$this->sth->execute();
		} catch(PDOException $e) // Mensagem em caso de erro na exclusão dos dados
		{
			die("Error: " . $e->getMessage());
		}
	}
}

?>