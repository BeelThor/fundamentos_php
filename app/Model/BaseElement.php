<?php
namespace app\Model;
require_once("vendor/autoload.php");
use app\Model\Printable;

class BaseElement implements Printable {

private $title;
public $description;
public $visible;
public $month;


public function __construct($title, $description) {
    $this->setTitle($title);
    $this->description = $description;
}

public function setTitle($t) {
    if($t == '') {
        $this->title = 'N/A';
    } else {
        $this->title = $t;
    }
}

public function getTitle() {
    return $this->title;
}

public function getDurationAsString() {
    $years = floor($this->month / 12);
    $extraMonths = $this->month % 12;
  
    return "$years years $extraMonths months";
}
public function getDescription (){
    $description = $this->description;
}
}