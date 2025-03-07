<?php

if (isset($sponsors) && empty($sponsors)){
    require_once 'models/Sponsor.php';
    $sponsor_model = new Sponsor();
    $sponsors = $sponsor_model->getSponsorList();
}


?>

