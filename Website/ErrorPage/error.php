<?php
function myErrorHandler ($errno, $errstr, $errfile, $errline){
    echo "<br><table bgcolor=\"#cccccc\"><tr><td>
          <p><strong>ERROR:</strong> ".$errstr. "</p> 
          <p>Please try again, or contact us and tell us the error that occurred in line".$errline." of file ".$errfile."</p>";
    exit;
}

echo "</td></tr></table>";

//set error handler
set_error_handler('myErrorHandler');
?>

<h1>ERROR</h1>
