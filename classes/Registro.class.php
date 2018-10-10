<?php 
##### Registro.class.php #####

class Registro 
{ 
    private $data; 
    private $tabela;
    private static $con;
 
    public function __construct($tabela,PDO $con)
    {
        $this->tabela=$tabela;
        self::$con=$con;
    }

    public function __set($prop, $value) 
    { 
        $this->data[$prop] = $value; 
    } 

    public function __get($prop) 
    { 
        return $this->data[$prop]; 
    } 

    public function save($id=NULL) 
    {   
        if($id==-1)
        {
            $sql= 'INSERT INTO ' . $this->tabela . 
            '('.implode(',', array_keys($this->data)).') VALUES '. 
            "('".implode("','", array_values($this->data))."')"; 
            try{
                self::$con->query($sql);
                return self::$con->lastInsertId();
                exit;
             } catch(Exception $e){
                 echo "Erro na operação!<p> {$e->getMessage()}";exit;
             }
        }
        if($id==NULL)
        {
            $sql= 'INSERT INTO ' . $this->tabela . 
            '('.implode(',', array_keys($this->data)).') VALUES '. 
            "('".implode("','", array_values($this->data))."')"; 
        }else{
            $conta=1;
            $qtde=sizeof($this->data);
            foreach($this->data as $key => $value)
            {
                if($conta==1){
                    $sql="update " . $this->tabela . " set ";
                }
                if ($conta>=$qtde){
                    $sql.= " $key = '$value' ";
                }else{
                    $sql.= " $key = '$value', ";  
                }
                $conta++;
            }
            $sql.= "  where $id";
        }
        try{
           return self::$con->query($sql);
           //echo $sql;exit;
        } catch(Exception $e){
            echo "Erro na operação!<p> {$e->getMessage()}";exit;
        }
    } 

    public function delete($id) // campo=valor
    { 
        $sql = "DELETE FROM " . $this->tabela . ' WHERE '.$id; 
        try{
            return self::$con->query($sql);
            //echo $sql;exit;
        }catch(Exception $e){
            echo "Erro na operação!<p> {$e->getMessage()}";exit;
        }
    } 

    public function find($id=NULL) // campo=valor
    { 
        if($id){
            $sql = "SELECT * FROM " . $this->tabela . ' WHERE '.$id;
            $stmt=self::$con->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        }else{
            return array(array_keys($this->data));
        }
    } 

    public function findAll() 
    { 
        $sql = "SELECT * FROM " . $this->tabela;
        $stmt=self::$con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } 

    public function findLike($key,$criterio) 
    { 
        $sql = "SELECT * FROM " . $this->tabela . " where " . $key . " like '%" . $criterio . "%'";
        $stmt=self::$con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } 

    public function findCriterio($campos,$criterio) 
    { 
        $sql = "SELECT ". $campos ." FROM " . $this->tabela . " " . $criterio;
        //echo $sql;exit;
        $stmt=self::$con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findTabelas($campos,$tabelas,$criterio) 
    { 
        $sql = "SELECT ". $campos ." FROM " . $tabelas . " where " . $criterio;
        //echo $sql;exit;
        $stmt=self::$con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}