<?php

//  use PDO;    

class Database
{

    private static $dbtype   = "";
    private static $host     = "";
    private static $port     = "";
    private static $user     = "";
    private static $password = "";
    private static $db       = "";

    /*Método construtor do banco de dados*/

    public function __construct(
        $db_dbtype = db_dbtype,
        $db_host = db_host,
        $db_port = db_port,
        $db_user = db_user,
        $db_password = db_password,
        $db_bdados = db_bdados
    ) {

        self::$dbtype   = $db_dbtype;
        self::$host     = $db_host;
        self::$port     = $db_port;
        self::$user     = $db_user;
        self::$password = $db_password;
        self::$db       = $db_bdados;
    }

    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e 
          remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /*Metodos que trazem o conteudo da variavel desejada
        @return   $xxx = conteudo da variavel solicitada*/
    private function getDBType()
    {
        return self::$dbtype;
    }
    private function getHost()
    {
        return self::$host;
    }
    private function getPort()
    {
        return self::$port;
    }
    private function getUser()
    {
        return self::$user;
    }
    private function getPassword()
    {
        return self::$password;
    }
    private function getDB()
    {
        return self::$db;
    }

    public  function connect()
    {

        try {

            if ($this->getDBType() == 'mysql')             // MySQL
            {
                $this->conexao = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";port=" . $this->getPort() . ";dbname=" . $this->getDB(), $this->getUser(), $this->getPassword());
            } else if ($this->getDBType() == 'sqlsrv')        // SQL Server
            {
                $this->conexao = new PDO($this->getDBType() . ":Server=" . $this->getHost() . "," . $this->getPort() . ";DataBase=" . $this->getDB(), $this->getUser(), $this->getPassword());
            }
        } catch (PDOException $i) {
            //se houver exceçao, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return ($this->conexao);
    }

    private function disconnect()
    {
        $this->conexao = null;
    }


    /*
         * Método select que retorna um array de objetos
         */

    public function db_select($sql, $params = null)
    {

        $query = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $query->execute($params);
        $rs = $query;

        self::__destruct();

        return $rs;
    }



    /*
         * Método insert que insere valores no banco de dados e retorna o último id inserido
         */

    public function db_insert($sql, $params = null)
    {

        $conexao = $this->connect();
        $query   = $conexao->prepare($sql);
        $query->execute($params);

        $rs      = $conexao->lastInsertId(); // or die(print_r($query->errorInfo(), true));

        self::__destruct();

        return $rs;
    }

    /* Método update que altera valores do banco de dados e retorna o número de linhas afetadas */

    public function db_update($sql, $params = null)
    {

        $query = $this->connect()->prepare($sql);
        $query->execute($params);

        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();

        return $rs;
    }

    /*
         * Método delete que exclusão valores do banco de dados retorna o número de linhas afetadas
         */

    public function db_delete($sql, $params = null)
    {

        $query = $this->connect()->prepare($sql);

        try {

            $query->execute($params);
            $rs = $query->rowCount();
        } catch (Exception $exc) {
            echo "Erro ao Excluir Registro, favor entrar em contato com Suporte Tenico" . $exc->getTraceAsString();
        }

        self::__destruct();

        if ($rs == array()) {
            return false;
        } else {

            return $rs;
        }
    }


    /*
         * Método que retornar a posição atual do registro (OBJ)
         */

    public function db_busca_dados($rscPdo)
    {
        return $rscPdo->fetch(PDO::FETCH_OBJ);
    }

    /*
         * Método que retornar todos os registros (OBJ)
         */

    public function db_busca_dados_all($rscPdo)
    {
        return $rscPdo->fetchAll(PDO::FETCH_OBJ);
    }

    /*
         * Método que retornar a posição atual do registro (matriz)
         */

    public function db_busca_array($rscPdo)
    {
        return $rscPdo->fetch(PDO::FETCH_ASSOC);
    }

    /*
         * Método que retornar a posição atual do registro (matriz)
         */

    public function db_busca_array_all($rscPdo)
    {
        return $rscPdo->fetchall(PDO::FETCH_ASSOC);
    }

    /*
         * Método que retornar o Numero de linhas Selecionadas
         */

    public function db_num_linhas($rscPdo)
    {
        return $rscPdo->rowCount();
    }

    /*
         * Método que retornar o Numero de Colunas Selecionadas
         */

    public function db_num_colunas($rscPdo)
    {
        return $rscPdo->columnCount();
    }


    public function db_resultado($rscRes, $CampoRetorno)
    {
        $rowResX = $this->db_busca_matriz($rscRes);

        return $rowResX[$CampoRetorno];
    }
}
