<?php
    include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Digital Arts Platform</title>
    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- main css style -->
    <link rel="stylesheet" href="assets/css/main-style.css?v=">
</head>
<body>
    <!-- hero -->
    <section class="hero">
        <!-- header -->
        <header>
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <h1><a href="index.php">NF<span>Tea</span></a></h1>
                    </div>
                    <div class="burger-menu">
                        <div class="bar top"></div>
                        <div class="bar middle"></div>
                        <div class="bar bottom"></div>
                    </div>
                    <nav class="navigation-menu">
                        <ul class="nav-links">
                            <li class="nav-link"><a href="index.php">Home</a></li>
                            <li class="nav-link"><a href="market-place.php">MarketPlace</a></li>
                        </ul>
                        <a href="dashboard.php"><button class="log-in">Dashboard</button></a>
                    </nav>
                </div>
            </div>
        </header>
        <!-- hero content -->
        <div class="hero-content">
            <div class="container">
                <div class="content-wrapper">
                    <p>Discover, Create & Sell Extraordinary Digital Artworks. Discover, Create & Sell Extraordinary Digital</p>
                    <div class="hero-heading">
                        <h1>Discover<img src="assets/imgs/hero-item1.png" alt="" loading="lazy">Create<img src="assets/imgs/hero-item2.png" alt="" loading="lazy">& Sell Extraordinary
                        <img src="assets/imgs/hero-item3.png" alt="" loading="lazy">Digital Artworks.</h1>
                    </div>
                    <div class="hero-btns">
                        <button class="hero-btn"><a href="dashboard.php">Get Start</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services -->
    <div class="services-section">
        <div class="container">
            <div class="services-wrapper">
                <div class="main-heading">
                    <h1>Create & Sell NFTS</h1>
                    <hr>
                </div>
                <div class="services">
                    <div class="service">
                        <i class='bx bxs-edit'></i>
                        <h2>Create NFTS</h2>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium
                        </p>
                    </div>
                    <div class="service">
                        <i class='bx bxs-shopping-bags'></i>
                        <h2>NFTS MarketPlace</h2>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium
                        </p>
                    </div>
                    <div class="service">
                        <i class='bx bxs-collection'></i>
                        <h2>Collect NFTS</h2>
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popular collections -->
    <section class="popular-collections">
        <div class="container">
            <div class="collections-wrapper">
                <div class="main-heading">
                    <h1>Get Popular Collections Here</h1>
                    <hr>
                </div>
                <div class="collections">
                <?php
                    $request_collections = "SELECT * FROM collections";

                    $sql_collections = mysqli_query($connection, $request_collections);

                    
                    while($data = mysqli_fetch_assoc($sql_collections)) {

                        $name = $data['collection_name'];
                        $image = $data['collection_image'];
                        $artiste = $data['collection_artiste'];
                        echo '
                        <div class="collection nft">
                            <img src="'. $image .'" alt="nft image" width="100%" height ="300px">
                            <h3>'. $name .'</h3>
                            <p>'. $artiste .'</p>
                        </div>
                        ';
                    }
                ?>   
                </div>
            </div>
        </div>
    </section>
    <div class="trend-creators-section">
        <div class="container">
            <div class="creators-wrapper">
                <div class="main-heading">
                    <h1>Our Trending Creators</h1>
                    <hr>
                </div>
                <div class="creators">
                    <!-- creator -->
                    <?php
                                $collections = "SELECT collection_artiste FROM collections";
                                $querry = mysqli_query($connection, $collections);

                                while($display = mysqli_fetch_assoc($querry)) 
                                {
                                    echo '
                                    <div class="creator">
                                        <div class="img"></div>
                                         <p>'. $display["collection_artiste"] .'</p>
                                    </div>
                                    ';
                                }
                                
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- frequently asked questions -->
    <div class="frequetly-questions">
        <div class="container">
            <div class="questions-wrapper">
                <div class="main-heading">
                </div>
            </div>
        </div>
    </div>
    <div class="news-letter-section">
        <div class="container">
            <div class="news-letter-wrapper">
                <div class="main-heading">
                    <h1>Subscribe to get Latest Updates</h1>
                    <hr>
                </div>
                <p class="news-letter-text">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                </p>
                <?php
                    if(isset($_POST["subscribe"])) {
                        $subscriber = $_POST["email"];
                        $send = "INSERT INTO `subscribers`(`email`) VALUES ('$subscriber')";
                        
                        if(mysqli_query($connection, $send)) {
                            header('location: index.php');
                        }
                        
                    }
                ?>
                <form action="?" method="post">
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                    <input name="subscribe" type="submit" value="Subscribe">
                </form>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-wrapper">
                <div class="info-links">
                    <div class="website-info">
                        <h1 class="footer-logo">NF<span>Tea</span></h1>
                        <p class="website-desc">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                        </p>
                    </div>
                    <div class="website-links links">
                        <h4>Page Links</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">Home</a></li>
                            <li class="page-link"><a href="#">MarketPlace</a></li>
                            <li class="page-link"><a href="#">About Us</a></li>
                            <li class="page-link"><a href="#">Support</a></li>
                        </ul>
                    </div>
                    <div class="useful-links links">
                        <h4>Useful Links</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">Home</a></li>
                            <li class="page-link"><a href="#">MarketPlace</a></li>
                            <li class="page-link"><a href="#">About Us</a></li>
                            <li class="page-link"><a href="#">Support</a></li>
                        </ul>
                    </div>
                    <div class="contact-info links">
                        <h4>Contact Info</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">info@nftea.com</a></li>
                            <li class="page-link"><a href="#">+1 (234) 9845 342</a></li>
                            <li class="page-link"><a href="#">+1 (983) 4855 239</a></li>
                        </ul>
                    </div>
                </div>
                <div class="copyright-section">
                    <div class="copyright-text">
                        Copyright 2022 - <p>NF<span>Tea</span></p> - All Rights are Reserved
                    </div>
                    <ul class="social-links">
                        <li class="social-link"><a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a></li>
                        <li class="social-link"><a href="#" title="Twitter"><i class='bx bxl-twitter' ></i></a></li>
                        <li class="social-link"><a href="#" title="Dribble"><i class='bx bxl-dribbble' ></i></a></li>
                        <li class="social-link"><a href="#" title="Blog"><i class='bx bxl-blogger' ></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/main-script.js"></script>
</body>
</html>