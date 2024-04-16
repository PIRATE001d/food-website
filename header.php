<?php require_once('./config.php'); 





?>

<header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="<?php echo APP_BASE_URL;?>/index.php">
                            <img src="logo.svg" width="160" height="36" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="<?php echo APP_BASE_URL;?>/index.php">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="<?php echo APP_BASE_URL;?>/menu.php">Menu</a></li>
                                <li><a href="#gallery">Gallery</a></li>
                                <li><a href="#blog">Blog</a></li>
                                <li><a href="<?php echo APP_BASE_URL;?>/contactus.php ">ContactUS</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <form action="#" class="header-search-form for-des">
                                <input type="search" class="form-input" placeholder="Search Here...">
                                <button type="submit">
                                <i class="uil uil-search"></i>
                                </button>
                            </form>
                            <a href="<?php echo APP_BASE_URL;?>/cart.php" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number">0</span>
                            </a>
                            <?php require_once('./session_manager.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>