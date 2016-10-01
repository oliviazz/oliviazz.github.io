
 <html>
 <head>
  <title>Restaurant Search Results</title>
      <link rel="stylesheet" href="CSS/index.css" type="text/css">
 </head>
 <body>
     <h1>Search Results:</h1>
     
     <div id = "name">
         Hello, 
         <?php 
         echo $_POST['name'];
        ?>
         from
         <?php
         echo $_POST['location'];
            ?>
         ! Here are your results:
         <br><br>
     </div>
     <form action = "rstart.php" method = "post" id = "form2">
        <select name = "numResults" id = "num">
            <option value = "3" >3</option>
            <option value = "5" >5</option>
            <option value = "10">10</option>
            <option value = "15">All</option>
         </select>
         <input type = "hidden" id = "loc" name = "location" value = <?php echo $_POST['location']?>>
         <input type = "hidden" id = "na" name = "name" value = <?php echo $_POST['name']?>>
         <input type = "hidden" id = "ft" name = "foodType" value = <?php echo $_POST['foodType']?> >
         
         <button id = "sBut" type="submit" accesskey="c" name="submit"><u>C</u>hange # Results Shown</button>
     </form>
     <div id = "mssg"  style="display: none;">
  <?php  
    
    if (isset($_POST['submit'])){

        session_start();
        $my_location = $_POST['location']; 
        $name = $_POST['name'];
        $term = $_POST['foodType'];
        $numResults = intval($_POST['numResults']);
        echo $numResults;
                echo("yo");
        if(!is_int($numResults)){
            $numResults = 3; //Defaults to 5
        }
        //echo "Hello, ", $name , " from ",$my_location, "! Here are your results: <br><br>"; ?>
     </div>
     
         <script>
     document.getElementById('sBut').style.width = "200px";
     document.getElementById('num').style.width = "50px";
     var number = document.getElementById('mssg').innerHTML;
     document.getElementById('num').value = parseInt(number);
//        document.getElementById('num').onchange=function(){
//        document.getElementById('changeNum').submit();
//        };
             
      xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               alert(xmlhttp.responseText);
                //var price = xmlhttp.responseText; //Price from php file
               
            }
            else{
                        console.error(xmlhttp.statusText);
                    
            }   
        }
        xmlhttp.open("GET", "https://www.tjhsst.edu/~2016choang/Agency/priceCalc.php", true);
        xmlhttp.send();
        
     </script>
     <div id = "searchResults">
     <?php
        include 'yelpOriginal2.php';
        $searchResults = printResults($term, $my_location, $numResults);
        
        $getName =  "/(?<=\"name\": \").{3,18}(?=\", \"rating_img_url_small)/";
        $getLat = "/(?<=\"latitude\":).{1,30}(?=, \"longitude\")/";
        $getLong = "/(?<=\"longitude\":).{1,30}(?=},)/";
        $getRating = "/(?<=\"rating\":).{1,5}(?=, \"mobile_url\")/";
        
        preg_match_all($getName, $searchResults, $allRestNames);
        preg_match_all($getLat, $searchResults, $lat);
        preg_match_all($getLong, $searchResults, $long);
        preg_match_all($getRating, $searchResults, $rating);
   
        //Loop through all the names!
        for ($i = 0; $i < sizeof($allRestNames[0]); $i++) {
           
            print($allRestNames[0][$i]. "__________________Average Rating: [".$rating[0][$i]." ]");
            print("<br>");
            $restName = preg_replace('/\s+/', '_', $allRestNames[0][$i]);
            $restLat = trim($lat[0][$i]);
            $restLong = trim($long[0][$i]);
            echo '<a href=trafficPage.php?name='.$restName.'&long='.$restLong.'&lat='.$restLat.'>View Current Traffic</a>';
            echo '<br>';
        }
        
        
      
        $_SESSION['restName'] = $allRestNames[0][0];
        $_SESSION['latitude'] = $lat[0][0];
        $_SESSION['longitude'] = $long[0][0];
        $_SESSION['rating'] = $rating[0];
             
        ?>
         </div> 
     <?php
        
        
        echo "<br><i>Top ", strval(sizeof($allRestNames[0])), " Result(s) Displayed<i>";
        
       
        echo '<br /><a href="trafficPage.php?' . SID . '">View Current Traffic</a>';
        echo '<hr>';
        //echo $searchResults;

        
       
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
        
}
else{
    echo "Information not submitted. Please go <a href = 'index.html'>back</a> and try again";
}
         
?>
    
    
 <div> <a href = "index.html">Back to Main Page</a>   </div>
 </body>
</html>    
  
  
  
