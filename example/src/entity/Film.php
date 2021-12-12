<?php
namespace App\Entity;


use Noem\Model;

class Film extends Model {
  public $timestamps = false;
  protected $fillable = ["title", "release_date", "duration"]; 

  public function seances(){
 
 
    
    //     return $this->belongsTo(Entity::class);
    
  }
}