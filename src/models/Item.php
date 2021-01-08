<?php
namespace mywishlist\models;
class Item extends \Illuminate\Database\Eloquent\Model
{
    protected $table ='item';
    protected $primaryKey ='id';
    public $timestamps=false;
    protected $img = 'default.jpg';

    public function liste(){
        return $this->belongsTo('\mywishlist\models\Liste','liste_id');
    }

}