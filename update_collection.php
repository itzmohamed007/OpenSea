<?php
    include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Add New Collection</title>
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css style -->
    <link rel="stylesheet" href="assets/css/main-style.css">
</head>
<body>
    <section class="add-nft-page">
        <div class="container">
            <div class="form-wrapper">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="name">Collection Name</label>
                        <input type="text" name="collection_name" id="name" placeholder="Enter Collection Name">
                    </div>
                    <div class="input-field">
                        <label for="image">Collection Image</label>
                        <input type="file" name="collection_image" id="image" accept="png jpeg">
                    </div>
                    <div class="input-field">
                        <label for="collectionid">Collection Author</label>
                        <input type="text" name="collection_artiste" id="collectionid" placeholder="Enter Collection Author">
                    </div>
                    <div class="input-field">
                        <input type="submit" name="submit" id="submit" value="Update Collection">
                    </div>
                </form>
                <?php
                    // checking if the button is clicked
                    if(isset($_GET["update_id"])){
                        // getting the id of the choosen collection 
                        $update_id = $_GET["update_id"]; 

                        // checking if the submit button is clicked
                        if(isset($_POST["submit"]))
                        {
                            // getting data and soring it in variables
                            $name = $_POST["collection_name"];
                            $image_name = $_FILES["collection_image"]["name"]; //name
                            $location = $_FILES["collection_image"]["tmp_name"];  //temperary location
                            $folder = "images/" . $image_name; //new location
                            $artiste = $_POST["collection_artiste"];
                            
                            // creating query
                            $update = "UPDATE `collections` 
                                        SET `collection_name`='$name',
                                        `collection_image`='$folder',
                                        `collection_artiste`='$artiste' 
                                        WHERE collection_id = $update_id";
                                    
                            move_uploaded_file($location, $folder);
                            // executing query
                            mysqli_query($connection, $update);
                            // rediricting to dashboard page after finishing this process
                            header("Location: dashboard.php");
                        }                    
                    }
                ?>
                <a href="dashboard.php"><button class="cancel">Cancel</button></a>
            </div>
        </div>
    </section>
    <script src="assets/js/main-script.js"></script>
</body>
</html>