<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; ?> 
     <br>
<?php echo  $_SERVER['HTTP_USER_AGENT']; ?>
     <br>
     Hello, <?php echo $_POST['name']; ?>.
     You are <?php echo $_POST['age']; ?> years old. 
     
     You are looking for restaurants in: <? $city = $_POST['city'];
     echo $city; 
     $response = http_get("https://api.yelp.com/v2/search/?location=Washington", array("timeout"=>1), $info);
     print_r($info);
     ?> 
     Response is <?php echo $response; ?>
     
 </body>
</html>