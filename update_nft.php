<?php
    include_once 'connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Add New NFT</title>
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css style -->
    <link rel="stylesheet" href="assets/css/main-style.css">
</head>
<body>
    <section class="add-nft-page">
        <div class="container">
            <div class="form-wrapper">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="nft_name">NFT Name</label>
                        <input type="text" name="nft_name" id="name" placeholder="Enter NFT Name">
                    </div>
                    <div class="input-field">
                        <label for="nft_image">NFT Image</label>
                        <input type="file" name="nft_image" id="image" accept="png jpeg">
                    </div>
                    <div class="input-field">
                        <label for="nft_description">NFT Description</label>
                        <textarea name="nft_description" id="nft-description" cols="30" rows="10" placeholder="Enter NFT Description"></textarea>
                    </div>
                    <div class="input-field">
                        <label for="nft_collection_id">Collection Name</label>
                        <select name="nft_collection_id" id="nft_collection_id">
                            <?php
                                $select_coll = "SELECT * FROM collections";
                                $query = mysqli_query($connection, $select_coll);
                                while($row = mysqli_fetch_assoc($query)) {
                                    echo '<option value="'. $row["collection_id"] .'">'. $row["collection_name"] .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="nft_price">Price</label>
                        <input type="text" name="nft_price" id="price" placeholder="Enter Price">
                    </div>
                    <div class="input-field">
                        <input type="submit" name="submit" id="submit" value="Add NFT">
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
                            $name = $_POST["nft_name"];
                            $image_name = $_FILES["nft_image"]["name"]; //name
                            $location = $_FILES["nft_image"]["tmp_name"];  //temperary location
                            $folder = "images/" . $image_name; //new location
                            $description = $_POST["nft_description"];
                            $collection_id = $_POST["nft_collection_id"];
                            $price = $_POST["nft_price"];
                            
                            // creating query
                            $update = "UPDATE `nfts` SET `nft_name`='$name',`nft_description`='$description',
                            `nft_price`='$price',`nft_image`='$folder',
                            `nft_collection_id`='$collection_id ' WHERE $update_id";

                            
                                    
                            move_uploaded_file($location, $folder);
                            // executing query
                            mysqli_query($connection, $update);
                            // rediricting to dashboard page after finishing this process
                            header("Location: dashboard.php?update=success");
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