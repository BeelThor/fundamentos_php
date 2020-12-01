<?php
namespace app\Model;
require_once("../vendor/autoload.php");
use Illuminate\Database\Eloquent\Model;
class User extends Model{
    protected $table = 'users';

}
?>