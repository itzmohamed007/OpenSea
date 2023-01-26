<?php
    include_once 'connection.php';

    $collections = "SELECT * FROM collections";
    $nfts = "SELECT * FROM nfts";

    $collections_querried = mysqli_query($connection, $collections);
    $nfts_querried = mysqli_query($connection, $nfts);

// i've putted this piece of code in here before html tags because the function header will cause an error if was putted after html tages 
    if(isset($_GET["delete_id"])) {
        $deleted_id = $_GET["delete_id"];
        $delete = "DELETE FROM collections WHERE collection_id = $deleted_id";
        if(mysqli_query($connection, $delete)) {
            header('location: dashboard.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Admin Dashboard</title>
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css style -->
    <link rel="stylesheet" href="assets/css/main-style.css">
</head>
<body>
    <div class="dashboard">
        <div class="container">
            <div class="dashboard-btns">
                <a href="add-collection.php"><button class="add-collection dash-btn">Add Collection</button></a>
                <a href="index.php"><button class="add-collection dash-btn">Main Page</button></a>
            </div>
            <div class="statistique">
                <!-- box -->
                <div class="statique-box">
                    <h1>Total Nfts</h1>
                    <div class="box">
                        <i class="bx bxs-component"></i>
                        <p> <?php echo mysqli_num_rows($nfts_querried) ?> </p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>Total Collection</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p> <?php echo mysqli_num_rows($collections_querried) ?> </p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>NFT la plus cher</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p>
                            <?php
                                $max_price = "SELECT nft_name FROM nfts ORDER BY nft_price DESC";
                                $max_price_quered = mysqli_query($connection, $max_price);
                                $result = mysqli_fetch_assoc($max_price_quered);
                                if(mysqli_num_rows($nfts_querried) !== 0) {
                                    echo $result["nft_name"];
                                }else {
                                    echo '0';
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>NFT la moin cher</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p>
                            <?php
                                $max_price = "SELECT nft_name FROM nfts ORDER BY nft_price ASC";
                                $max_price_quered = mysqli_query($connection, $max_price);
                                $result = mysqli_fetch_assoc($max_price_quered);
                                if(mysqli_num_rows($nfts_querried) !== 0) {
                                    echo $result["nft_name"];
                                }else {
                                    echo '0';
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="main-heading">
                <h1>Collections Dashboard</h1>
            </div>
            
            <!-- nft-img.png -->
            <div class="display-table">
            <?php
                    $request_collections = "SELECT * FROM collections";
                    $request_nfts = "SELECT * FROM nfts";

                    $sql_collections = mysqli_query($connection, $request_collections);

                    while($data = mysqli_fetch_assoc($sql_collections)) {
                        $collection_id = $data['collection_id'];

                        $name = $data['collection_name'];
                        $image = $data['collection_image'];
                        $artiste = $data['collection_artiste'];
                        echo '
                        <div class="collection nft">
                            <img src="'. $image .'" alt="nft image" width="100%" height ="300px">
                            <h3>'. $name .'</h3>
                            <p>'. $artiste .'</p>
                            <div class="operation-td">
                                <a href="collection_nfts.php?view_nfts='. $collection_id .'" name="view" class="view"><i class="bx bxs-show"></i>View</a> 
                                <a href="update_collection.php?update_id='. $collection_id .'" name="update" class="update"><i class="bx bxs-edit"></i>Update</a>
                                <a href="dashboard.php?delete_id='. $collection_id .'" name="delete" class="delete"><i class="bx bxs-eraser"></i>Delete</a>
                            </div>
                        </div>
                        ';
                    }
                ?>
        </div>
    </div>
    <script src="assets/js/main-script.js"></script>
</body>
</html>