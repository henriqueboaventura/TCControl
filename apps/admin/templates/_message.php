<?php
$message = array();
if($sf_user->hasFlash('error')){
    $message = array(
        'error',
        $sf_user->getFlash('error')
    );        
} else if ($sf_user->hasFlash('warning')){
    $message = array(
        'notice',
        $sf_user->getFlash('warning')
    );
} else if ($sf_user->hasFlash('success')){
    $message = array(
        'success',
        $sf_user->getFlash('success')
    );
}

if(count($message) > 0 AND $message[1] != ''){
    echo vsprintf('<p class="%s">%s</p>',$message);
}

?>
