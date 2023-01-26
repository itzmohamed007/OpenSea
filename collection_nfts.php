<?php
    include_once 'connection.php';
    
    $collections = "SELECT * FROM collections";
    $nfts = "SELECT * FROM nfts";

    $collections_querried = mysqli_query($connection, $collections);
    $nfts_querried = mysqli_query($connection, $nfts);

    // i've putted this piece of code in before html tags because the function header will cause an error if was putted after html tages 
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
    <title>NFTea - nfts Dashboard</title>
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css style -->
    <link rel="stylesheet" href="assets/css/main-style.css">
</head>
<body>
    <div class="dashboard">
        <div class="container">
            <div class="dashboard-btns">
                <a href="add-nft.php"><button class="add-nft dash-btn">Add NFT</button></a>
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
                <h1>NFTs Dashboard</h1>
            </div>
            
            <!-- nft-img.png -->
            <div class="display-table">
            <?php
                    if(isset($_GET['view_nfts'])) {
                        $view_id = $_GET['view_nfts'];
                        $request = "SELECT * FROM nfts where nft_collection_id = $view_id";
                        $sql = mysqli_query($connection, $request);
                        
                        while($data = mysqli_fetch_assoc($sql)) {
                            $nft_id = $data['nft_id'];
                            $name = $data['nft_name'];
                            $image = $data['nft_image'];
                            $price = $data['nft_price'];
                            echo '
                            <div class="collection nft">
                                <img src="'. $image .'" alt="nft image" width="100%" height ="300px">
                                <h3>'. $name .'</h3>
                                <p>'. $price .' ETH</p>
                                <?php
                                }
                                ?>
                                <div class="operation-td">
                                    <!--<a name="view" class="view"><i class="bx bxs-show"></i>View</a> -->
                                    <a href="update_nft.php?update_id='. $nft_id .'" name="update" class="update"><i class="bx bxs-edit"></i>Update</a>
                                    <a href="?deleteid='. $nft_id .'" name="delete" class="delete"><i class="bx bxs-eraser"></i>Delete</a>
                                </div>
                            </div>
                            ';
                        }
                    }
                ?>   
                <?php
                    if(isset($_GET["deleteid"])) {
                        $deleted_id = $_GET["deleteid"];
                        $delete = "DELETE FROM nfts WHERE nft_id = $deleted_id";
                        if(mysqli_query($connection, $delete)) {
                            header('location: dashboard.php');
                        }
                    }
                ?> 
        </div>
    </div>
    <script src="assets/js/main-script.js"></script>
</body>
</html>