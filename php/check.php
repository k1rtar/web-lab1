<?php

function checkNum($x,$y,$r){
    if (is_numeric($x) && is_numeric($y) && is_numeric($r)){
        $yParts = explode(".", $y);
        if ((count($yParts) > 1 && strlen($yParts[1]) <= 15) || strlen($yParts[0])) {
            return true;}
    }
    return false;
}

function checkValueRange($x,$y,$r){
    return in_array($x,[-4,-3,-2,-1,0,1,2,3,4]) &&
    $y>-3 && $y<3 && in_array($r,[1,1.5,2,2.5,3]);
}

function hit($x,$y,$r){
    $square = $x>=0 && $x<=$r && $y<=$r && $y>=0;
    $triangle = $x<=0 && $x>=-$r && $y>=0 && $y<=$r && $y<=$x+$r;
    $quadrant = $y>=-$r && $y<=0 && $x>=0 && $x<=$r && $x**2 + $y**2<=$r**2;
    return $square || $triangle || $quadrant;

}

function validate($x,$y,$r){
    return checkNum($x,$y,$r) && checkValueRange($x,$y,$r);
}   

?>