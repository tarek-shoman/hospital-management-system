</div>

<!-- page data -->
<div class="page-data" id="page">
<header>
    
    <div class="bars" id="go">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div class="cart-box">
        <i class="fa-solid fa-cart-shopping"></i>
        <?php
            $user_id = $_SESSION['userid'];
            $cart_num = $conn -> query("SELECT COUNT(cart_id) FROM cart
            WHERE user_userid = $user_id") -> fetchAll(PDO::FETCH_COLUMN);
            $num = (count($cart_num) > 0) ? $cart_num[0] : 0;
        ?>
        <div class="cart-num" id="cart-result"><?php echo $num; ?></div>
    </div>

    <div class="user-name">
        <ul class="ul-main" id="set">
            <li>
                <?php 
                    echo $_SESSION['user'];
                ?>
                <i class="fas fa-chevron-down" id="icon-arrow"></i>
                <ul class="ul-sub h-s" id="sub-ul">
                    <li>
                        <a href="change_pass.php">change password</a>
                    </li>
                    <li>
                        <a href="out.php">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</header>
