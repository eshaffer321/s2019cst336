<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style>
            #images{
                display: block;
                margin: 0 auto;
            }
            img{
                width: 300px;
            }
            .heart{
                display: block;
                height: 50px;
                width: 50px;
                margin: 0 auto;
            }
            .col{
                display: flex;
            }
            #searchText{
                font-size: 2em;
                display: inline;
            }
            input{
                height: 30px;
            }
            input[type="text"]
            {
                font-size:25px;
            }
            #searchButton {
                background-color: #008CBA;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            #favoriteButton {
                background-color: #f44336;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div id="searchText">Search: </div> <input type="text" name="search" id="search"><br>
        <button id="searchButton">Submit</button>
        <button id="favoriteButton">Favorites</button>
        
        <div id="images"></div>
        
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>

        function heartClicked(image) {

            if( document.getElementById(image).getAttribute("src") == "img/favorite.png"){
                
                document.getElementById(image).setAttribute("src", 'img/favorite-on.png');
                
                $.ajax({
                    type: "get",
                    url: "api/api.php",
                    data: {
                        "url" : image,
                        "action" : "like"
                    },
                    success: function(data) {
                       console.log("image liked"); 
                    },
                    error: function(err) {
                        console.log(arguments);  
                    },
                });
            }
            else{
                document.getElementById(image).setAttribute("src", 'img/favorite.png');
                
                $.ajax({
                    type: "get",
                    url: "api/api.php",
                    data: {
                        "url" : image,
                        "action" : "unlike"
                    },
                    success: function(data) {
                       console.log("image unliked"); 
                    },
                    error: function(err) {
                        console.log(arguments);  
                    },
                });
            }
                
            console.log(image);
        }
        
        $( "#searchButton" ).click(function() {
            
            $( "#images" ).empty();
            
            $(document).ready(function(e) {
                $.ajax({
                    type: "get",
                    url: "https://pixabay.com/api/",
                    dataType: "json",
                    data: {
                        "key" : "12231109-134e2a74c3777571c5765b2eb",
                        "q" : document.getElementById("search").value
                    },
                    success: function(data) {
                        
                        for(var i=0; i<9 && i < data.hits.length ; i += 3){
                            var col = document.createElement("DIV");
                            col.setAttribute("class", "col");
                            
                            for(var j=0; j<3 && i+j < data.hits.length; j++){
                            
                                var imgdiv = document.createElement("DIV");
                                imgdiv.setAttribute("class", "imgdiv");
                                
                                var image = document.createElement("IMG");
                                image.setAttribute("src", data.hits[i+j]["largeImageURL"]);
                                imgdiv.appendChild(image);
                                
                                var heart = document.createElement("IMG"); // < img >
                                heart.setAttribute("src", "img/favorite.png"); // < img src="img/favorite.png">
                                heart.setAttribute("class", "heart"); // < img src="img/favorite.png" class="heart">
                                heart.setAttribute("onclick", "heartClicked(this.id)")
                                heart.setAttribute("id", data.hits[i+j]["largeImageURL"]);
                                imgdiv.appendChild(heart);
                                
                                col.appendChild(imgdiv);
                            }
                            
                            document.getElementById("images").appendChild(col);
                        }
                         
                    },
                    error: function(err) {
                        console.log(arguments);  
                    },
                });
            });
        });
        
        $( "#favoriteButton" ).click(function() {
            
            $( "#images" ).empty();
            
            $.ajax({
                type: "get",
                url: "api/api.php",
                dataType: "json",
                data: {
                    "action" : "getFavorites"
                },
                success: function(data) {
                    
                    console.log(data);
                    for(var i=0; i < data.length ; i += 3){
                        var col = document.createElement("DIV");
                        col.setAttribute("class", "col");
                        
                        for(var j=0; j<3 && i+j < data.length; j++){
                        
                            var imgdiv = document.createElement("DIV");
                            imgdiv.setAttribute("class", "imgdiv");
                            
                            var image = document.createElement("IMG");
                            image.setAttribute("src", data[i+j]["link"]);
                            imgdiv.appendChild(image);
                            
                            var heart = document.createElement("IMG"); // < img >
                            heart.setAttribute("src", "img/favorite-on.png"); // < img src="img/favorite.png">
                            heart.setAttribute("class", "heart"); // < img src="img/favorite.png" class="heart">
                            heart.setAttribute("onclick", "heartClicked(this.id)")
                            heart.setAttribute("id", data[i+j]["link"]);
                            imgdiv.appendChild(heart);
                            
                            col.appendChild(imgdiv);
                        }
                        
                        document.getElementById("images").appendChild(col);
                    }
                     
                },
                error: function(err) {
                    console.log(arguments);  
                },
            });
        });
        
    </script>

    </body>
</html>
