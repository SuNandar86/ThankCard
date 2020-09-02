<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{ 
	public $id;
    public $name;
    public $department_id;
    public $sub_deaprtment_id;
    public $user_id;
    public $address;
    public $email;
    public $phone;
    public $photo_name;
}
