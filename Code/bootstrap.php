<?php

function generatePage($body, $title="Example") {
    $page = <<<EOPAGE
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <title>$title</title>
    </head>
            
    <body>
            <div class="page-header" style="background-color: red;">
                <img style="margin-top:15px; margin-left:10px;" src="https://upload.wikimedia.org/wikipedia/en/3/3e/University_of_Maryland_seal.svg" alt="UMD Logo" height="70" width="70">
                <img style="margin-top:15px; margin-left:10px;" src="http://s3.amazonaws.com/umdheader.umd.edu/app/images/umd-bar-logo.png" alt="toggle">
                <a class="btn float-right" href="logout.php">Logout</a>
                <hr>
            </div>  
            </br>
            <div class="container">
                $body
            </div>
            
    </body>
</html>
EOPAGE;
    return $page;
}
?>
