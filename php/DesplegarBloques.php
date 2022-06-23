<?php
require 'controller.php';

$c = new Controller();

$date = $_POST['date'];
$lab = $_POST['lab'];

$lista1 = $c->listarbloques($date, $lab);
$lista2 = $c->listarbloques1();

for ($i=0; $i < count($lista2); $i++) { 
    $b = $lista2[$i];
    $existe=false;
    if (count($lista1)>0) {
    for ($y=0; $y < $lista1; $y++) { 
        $blo = $lista1[$y];
        if ($b->getId() == $blo->getId()) {
            echo "<input disabled type='radio' class='btn-check' name='options' value='".$b->getId()."' id='option".($i+1)."' autocomplete='off' checked>";
            echo "<label class='btn btn-danger' for='option".($i+1)."'>".$b->getNombre()."<br/>".$b->getHorario()."</label>";
            $existe=true;
            break;
        }else{
            $existe=false;
        }
        
    }
    }
    
    if ($existe==false) {
        echo "<input type='radio' class='btn-check' name='options' value='".$b->getId()."' id='option".($i+1)."' autocomplete='off' checked>";
        echo "<label class='btn btn-success' for='option".($i+1)."'>".$b->getNombre()."<br/>".$b->getHorario()."</label>";
    }
   
}