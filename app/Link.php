<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
     //table name
     protected $table='links';

     //primary key
     public $primaryKey='id';
     public $timestamps=true;
}
