<?php

namespace Noem;

use \PDO;
use Noem\Database;

class Model extends Database
{
    protected $id;
    
    public function save()
    { 
        // Test with "php example/SchemaOfUse/createFilm.php" commande line
        // If the resulte is null it's normal
        if($this->issetTable()) //table exist in db
        {
            // entity exist in database : update 
            if($this->issetEntity()) {
                $this->update();
            // : create
            } else {
                $this->create();
            }
        }
                    
        //TODO: ELSE => Message d'erreur "la table existe pas"
    }

    
    
    private function create()
    {   
        $values = $this->getValuesWithName();
        $valuesPrepared = join(',',array_keys($values));
        $sql = "INSERT INTO " . $this->gettable() . " (" . $this->getFieldsName() . ") VALUES(" . $valuesPrepared . ")";
        var_dump($sql);
        $query = $this->db->prepare($sql);
        $query->execute($values);
    }
    
    public function delete($id) 
    {
        $query = $this->db->prepare("DELETE FROM " . $this->gettable() . " WHERE id = :id");
        $query->execute([
            ":id" => $id
        ]);
    }
    
    private function update() 
    {   // UPDATE `films` SET `title` = 'The Rooms', `release_date` = '2003-01-07', `Duration` = '180' WHERE `films`.`id` = 1 
        
        $fields = [];
        $query = "UPDATE " . $this->gettable() . " SET " . $fields . " WHERE id =" . $this->id;
       
         
        //TODO:   
     }
     public function getAll()
    {
        
        $query = $this->db->prepare("SELECT * FROM " . $this->gettable()  );
        $query->execute();  
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
        

    }
    
    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM " . $this->gettable() . " WHERE id = :id" );
        $query->execute([
            ':id' => $id,
        ]);  
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    private function issetTable()
    { 
        $query = "SELECT 1 FROM " . $this->gettable() . " LIMIT 1";
        return $this->db->query($query);

    }

    private function issetEntity()
    {
        return !empty($this->id);
    }

    private function getFieldsName()
    {  //TODO: querry to generate fieldname 
        $properties = get_object_vars($this);    
        unset($properties['value']);
        return implode(',', $properties['fillable']);
    
    }
    
    private function getValuesWithName()
    {  
        $keys = get_object_vars($this)['fillable'];    
        $values = [];
        foreach($keys as $key) {
            $arrayKey = ':' . $key;
            $values[$arrayKey] = $this->{$key};
        }

        return $values;
    }

    private function gettable()
    {   
        $table = substr(strrchr(get_class($this), "\\"), 1);
        return strtolower($table) . 's' ;
    }

}