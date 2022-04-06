<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Cookie&family=Fleur+De+Leah&family=Merienda&family=Pacifico&display=swap" rel="stylesheet">

    <style type="text/css">
        *{
            margin: 10px;
        }

        a{
            color: red;
        }
        h2{
            text-align: center;
            padding: 5px;
            font-family: 'Pacifico', cursive;
            font-size: 100px;
            color: #BA1200;
        }

        h3{
            text-align: center;
            color:yellow;
        }

        body{
            background-color: black;
            background-image: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3),rgba(0,0,0,0.3)) ,url(film3.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        input[type="text"]{
            position: absolute;
            left: 350px;
            border: none;
            border-radius: 10px;
            color: black;
            font-size: 20px;
            width: 200px;
            height: 25px;
        }

        table{
            position: relative;
            border-collapse:collapse;
            left: 655px;
            top: -320px;
            color: white;
        }

        input[type="submit"]{
            background-color: black;
            color: white;
            width: 140px;
            height: 40px;
            font-size: 20px;
            border-radius: 10px;
        }

        th, td {
            padding: 6px;
            color: white;
            font-size: 15px;
        }

        .main{
            font-family: 'Baloo 2', cursive;
            padding:5px;
            font-size: 30px;
            box-sizing: border-box;
            background-color:#BA1200;
            color: white;
            position: relative;
            left: 480px;
            border-radius: 15px;
            width: 600px;
        }
    </style>
    <title>Movies database</title>
</head>
<body>
    <h2>Favourite Movies</h2>
    <div class="main">
        <form method=post action=moviedatabase.php >
            <label>Enter movie name</label>
            <input type="text" name="movie_name"><br>
            <label>Enter lead_actor</label>
            <input type="text" name="lead_actor"><br>
            <label>Enter lead_actress</label>
            <input type="text" name="lead_actress"><br>
            <label>Enter year of release</label>
            <input type="text" maxlength="4" name="year"><br>
            <lable>Enter director of movie</lable>
            <input type="text" name="director"><br>
            <input type="submit" name="submit" value="Submit">
            <input type="submit" name="submit" value="View">
            <input type="submit" name="submit" value="Query">
        </form>
    </div>
    <div class="box">
            <table border="1" bordercolor="#BA1200">
          <tr>
            
      </div>
</body>
</html>
<?php      
 $host = "localhost";  
    $user = "mulesoft";  
    $password = 'mulesoft@2021';  
    $db_name = "movies";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
    
    if(isset($_GET['em'])){
          $uem=$_GET['em'];
          $query= "DELETE FROM movie WHERE movie_name='$uem'";
          $data=mysqli_query($con,$query);
          echo "<h3>Movie deleted from your favourites</h3>";
          /*if($data)
          {
            header("Location:moviedatabase.php");
          }
          else
          {
            header("Location:moviedatabase.php");
          }*/
        }

    else if(isset($_POST['submit']) && $_POST['submit']=="Query")
    {

        if($_POST['movie_name']=="" && $_POST['lead_actor']=="" && $_POST['lead_actress']=="" && $_POST['year']=="" && $_POST['director']=="")
        {
                echo "<h3>please enter any field to query<h3>";
        }

        else
        {
            function PrintTable()
            {
                    echo "<style type='text/css'>
                .main{
                    position:relative;
                    left:20px;
                    top:20px;
                }</style>";
                echo "<th>movie_name</th>";
                echo "<th>lead_actor</th>";
                echo "<th>lead_actress</th>";
                echo "<th>year</th>";
                echo "<th>director_name</th>";
            }

            function PrintData($data)
            {
                while($row = mysqli_fetch_array($data))
                    {
                        echo "<tr>";
                        echo "<td>" . $row['movie_name'] . "</td>";
                        echo "<td>" . $row['lead_actor'] . "</td>";
                        echo "<td>" . $row['lead_actress'] . "</td>";
                        echo "<td>" . $row['year_of_release'] . "</td>";
                        echo "<td>" . $row['director_name'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
            }

            if(isset($_POST['movie_name']) && $_POST['movie_name']!="")
            {
                $temp=$_POST['movie_name'];
                $result = mysqli_query($con,"SELECT * FROM movie where movie_name='$temp'");
                if(mysqli_num_rows($result)==0)
                    echo "<h3>No related movies found</h3>";
                else
                {
                    PrintTable();
                    PrintData($result);
                }
            }

            else if ($_POST['lead_actor'] && $_POST['lead_actor']!="") 
            {
                $temp=$_POST['lead_actor'];
                $result = mysqli_query($con,"SELECT * FROM movie where lead_actor='$temp'");
                if(mysqli_num_rows($result)==0)
                    echo "<h3>No related movies found</h3>";
                else
                {
                    PrintTable();
                    PrintData($result);
                }
                
            }

            else if($_POST['lead_actress'] && $_POST['lead_actress']!=""){
                $temp=$_POST['lead_actress'];
                $result = mysqli_query($con,"SELECT * FROM movie where lead_actress='$temp'");
                if(mysqli_num_rows($result)==0)
                    echo "<h3>No related movies found</h3>";
                else
                {
                    PrintTable();
                    PrintData($result);
                }

            }
            else if($_POST['year'] && $_POST['year']!="")
            {
                $temp=$_POST['year'];
                $result = mysqli_query($con,"SELECT * FROM movie where year_of_release='$temp'");
                if(mysqli_num_rows($result)==0)
                    echo "<h3>No related movies found</h3>";
                else
                {
                    PrintTable();
                    PrintData($result);
                }
            }
            else if($_POST['director'] && $_POST['director']!="")
            {
                $temp=$_POST['director'];
                $result = mysqli_query($con,"SELECT * FROM movie where director_name='$temp'");
                if(mysqli_num_rows($result)==0)
                    echo "<h3>No related movies found</h3>";
                else
                {
                    PrintTable();
                    PrintData($result);
                }   
            }
        }
    }

    else if(isset($_POST['submit']) && $_POST['submit']=="View")
    {
        echo "<style type='text/css'>
        .main{
            position:relative;
            left:20px;
            top:20px;
        }</style>";
        echo "<th>movie_name</th>";
        echo "<th>lead_actor</th>";
        echo "<th>lead_actress</th>";
        echo "<th>year</th>";
        echo "<th>director_name</th>";
        echo "<th>action</th>";
        $result = mysqli_query($con,"SELECT * FROM movie");
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['movie_name'] . "</td>";
            echo "<td>" . $row['lead_actor'] . "</td>";
            echo "<td>" . $row['lead_actress'] . "</td>";
            echo "<td>" . $row['year_of_release'] . "</td>";
            echo "<td>" . $row['director_name'] . "</td>";
            echo "<td><a href='moviedatabase.php?em=".$row['movie_name']."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
   
   else if(isset($_POST['movie_name']) && isset($_POST['lead_actor']) && isset($_POST['lead_actress']) && isset($_POST['year']) && isset($_POST['director']) && $_POST['movie_name']!="" && $_POST['lead_actor']!="" && $_POST['lead_actress']!="" && $_POST['year']!="" && $_POST['director']!=""  && $_POST['year']>1000)
  {   
    $movie_name = $_POST['movie_name'];  
    $lead_actor = $_POST['lead_actor']; 
    $lead_actress= $_POST['lead_actress'];
    $year=$_POST['year'];
    $director=$_POST['director'];
        if($stmt = $con->prepare("INSERT INTO movie(movie_name,lead_actor,lead_actress,year_of_release,director_name) VALUES(?,?,?,?,?)")){
        $stmt->bind_param('sssis',$movie_name,$lead_actor,$lead_actress,$year,$director);
        $stmt->execute();
        $stmt->close();
        echo "<h3>Movie added successfully</h3>";
    }
  }
  else if(isset($_POST['submit']) && $_POST['submit']=="Submit")
    echo "<h3>please enter every fields</h3>";
  mysqli_close($con);  
?>  
