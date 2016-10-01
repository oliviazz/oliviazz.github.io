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
     $city = $_POST['city']
     You are looking for restaurants in: <?php echo $city; 
     $response = http_get("http://api.yelp.com/v2/search?term=food&location="+city);
     ?> 
     Response is <?php echo $response; ?>
     
 </body>
</html>