<?php
class DB
{
  private $host = "localhost";
  private $db_name = "fazenda_pecuaria";
  private $username = "root";
  private $password = "";
  public $conn;

  // Método para se conectar ao banco de dados
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    return $this->conn;
  }

  // Método para criar um novo registro na tabela de funcionários
  public function create($tabela, $dados)
  {
    $columns = implode(", ", array_keys($dados));
    $values = implode(", ", array_fill(0, count($dados), "?"));
    $sql = "INSERT INTO $tabela ($columns) VALUES ($values)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(array_values($dados));
    return $stmt->rowCount();
  }

  // Método para recuperar um registro da tabela de funcionários por ID
  public function read($tabela, $id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM $tabela WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    return $result;
  }

  public function readAll($tabela)
  {
    $stmt = $this->conn->prepare("SELECT * FROM $tabela");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function readWhere($tabela, $filtro)
  {
    $stmt = $this->conn->prepare("SELECT * FROM $tabela WHERE $filtro");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }

  public function readCount($tabela, $filtro=null)
  {
    $query = "SELECT COUNT(*) FROM $tabela";
    if ($filtro) {
      $query .= "WHERE $filtro";
    }
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
  }

  // Método para atualizar um registro na tabela de funcionários
  public function update($tabela, $dados, $filtro=null)
  {
    $query = "UPDATE $tabela SET ";
    $set = [];
    foreach ($dados as $key => $value) {
      $set[] = "$key = '$value'";
    }
    $query .= implode(', ', $set);
    if ($filtro) {
      $query .= " WHERE $filtro";
    }
    $stmt = $this->conn->prepare($query);
    return $stmt->execute();
  }

  // Método para excluir um registro da tabela de funcionários por ID
  public function delete($tabela, $id)
  {
    $stmt = $this->conn->prepare("DELETE FROM $tabela WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
  }

  public function consultaComJoin($query) {
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
  }
}
