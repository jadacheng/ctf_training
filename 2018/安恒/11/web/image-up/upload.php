<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Upload Form</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">


</head>

<body>
<?php
    $error = "";
    $exts = array("jpg","png","gif","jpeg");
    if(!empty($_FILES["image"]))
    {
        $temp = explode(".", $_FILES["image"]["name"]);
        $extension = end($temp);
        if((@$_upfileS["image"]["size"] < 102400))
        {
            if(in_array($extension,$exts)){
              $path = "uploads/".md5($temp[0].time()).".".$extension;
              move_uploaded_file($_FILES["image"]["tmp_name"], $path);
              $error = "ä¸ä¼ æå!";
            }
        else{
            $error = "ä¸ä¼ å¤±è´¥ï¼";
        }

        }else{
          $error = "æä»¶è¿å¤§ï¼ä¸ä¼ å¤±è´¥ï¼";
        }
    }

?>
<div class="form">
  <div class="thumbnail"><img src="hat.svg"/></div>
  <form class="login-form" action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" placeholder="image"/>
    <button type="submit">login</button>
  </form>
  <?php echo $error;?>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



<script  src="js/index.js"></script>




</body>

</html>
