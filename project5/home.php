<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
    
    <div class="container">
        <div id="nav">
            <a href="home.html" id="home">Home</a>
            |
            <a href="index.html" id="upload">Upload</a>
        </div>
        
        <div id="content">
            <?php
                $db = mysqli_connect("localhost","root","","project5"); 
                $sql = "SELECT * FROM up_files WHERE 1";
                $sth = $db->query($sql);
                while($result=mysqli_fetch_array($sth))
                {
                    echo $result['media'];
                    echo '<img style="width:300px; height:150px;" src="data:image/jpeg;base64,'. base64_encode( $result['media'] ) . '"/>';
                }
            ?>
        </div>
        
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
    
        var images = [];
        
        $.ajax({
            type:"GET",
            url:"getData.php",
            dataType: "json",
            success: function(data, status){
            
                console.log(data);
            },
            error: function(err) {
                console.log(arguments);  
            },
        });
    </script>
    </body>
</html>