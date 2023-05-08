<?php 
if(isset($_POST['submit']) && $_POST['submit']="Submit"){

    $expression = base64_encode($_POST['expression']);
    header('Location:calculus.php?query='.$expression);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    h1, h2 {
        margin-top: 0;
    }
    input[type="text"] {
        width: 200px;
        padding: 5px;
        margin-right: 5px;
    }
    button {
        padding: 5px;
    }
    #result {
        margin-top: 10px;
    }
    #history {
        margin-top: 10px;
        list-style: none;
        padding: 0;
    }
    #history li {
        margin-bottom: 5px;
    }
    #history span:first-child {
        font-weight: bold;
    }

    #main{
        text-align:center;
    }
    a{
        text-decoration:none;
    }
</style>
</head>
<body>
<div id="main">
    <h1>Calculator</h1>
    <div>
        <form action="" method="post">
            <input type="text" id="expression" name="expression">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <a href="calculus.php?action=history">Show JSON History>></a>
</div>
</body>
</html>