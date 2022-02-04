<?php
function CSSLINK($csspath){

    $url=BASEURL."/".$csspath;
    echo "<link rel='stylesheet' href='".$url.'">';

}
function JSLINK($jspath){
    $jslink=BASEURL."/".$jspath;
    echo "<script src='".$jslink.'"></script>';

}

?>
