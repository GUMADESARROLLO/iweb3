<?php
class Liquidacion_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function listar6Meses()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM Vencimientos_6meses",SQLSRV_FETCH_ASSOC);
        if($query){
            return $query;
        }
        $this->sqlsrv->close();
    }

    public function listar12Meses()
    {
        $query = $this->sqlsrv->fetchArray("SELECT * FROM Vencimientos_12meses", SQLSRV_FETCH_ASSOC);
        if ($query) {
            return $query;
        }
        $this->sqlsrv->close();
    }
    
}