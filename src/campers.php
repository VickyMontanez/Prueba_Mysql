<?php
namespace App;
class campers extends connect{
    private $queryPost = 'INSERT INTO campers(idCamper, nombreCamper, apellidoCamper, fechaNac,) VALUES(:id_Camper,:name_Camper, :surname_Camper, :datebirth_Camper)';
    private $queryGetAll = 'SELECT * FROM campers';
    private $queryDelete = 'DELETE FROM campers WHERE idCamper = :id_Camper';
    private $queryUpdate = 'UPDATE campers SET nombreCamper = :name_Camper, apellidoCamper = :surname_Camper, fechaNac = :datebirth_Camper, WHERE idCamper = :id_Camper';
    private $message;

    function __construct(private $idCamper, public $nombreCamper, public $apellidoCamper, public $fechaNac){parent::__construct();}

    public function postCampers(){
        try{
            $res = $this->conx->prepare($this->queryPost);  
            $res->execute();
            $this->message = ["Code"=>200+$res->rowCount(), "Message" => "Inserted data"];
        }catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=>$res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function getAllCampers(){
        try{
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        }catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=>$res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function deleteCampers($idCamper){
        try{
            $res = $this->conx->prepare($queryDelete);
            $res->bindValue(':id_Camper', $idCamper);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Deleted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function updateCampers($idCamper, $newName, $newSurname, $newDatebirth){
        try{
            $res = $this->conx->prepare($queryUpdate);
            $res->bindValue(':name_Camper', $newName);
            $res->bindValue(':surname_Camper', $newSurname);
            $res->bindValue(':datebirth_Camper', $newDatebirth);
            $res->bindValue(':id_Camper', $idCamper);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Updated data"];
        } catch(\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }


}   

?>