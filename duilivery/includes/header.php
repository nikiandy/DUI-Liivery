<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DUI-livery - <?php echo $pageTitle; ?></title>
<link rel="stylesheet" href="../css/header.css">

<body>
<div class="top-bar">

    <form class="search" action="../actions/searchProduct.php" method="get">
        <input type="text" name="search" placeholder="Search">
    </form>

    <div class="logo">
            <a href="index.php">
                <img class="img-logo" src="../images/logo.webp" alt="DUI-livery Logo" >
            </a>
            <br>
            <br>
        </div>

        <div class="loop-icon">
                <img src="../images/search.png" class="loop-icon">
            </a>
            <br>
            <br>
        </div>

        <div class="profile-icon">
            <a href="account.php">
                <img src="../images/profile.png" class="profile-icon">
            </a>
            <br>
            <br>
        </div>

        <div class="cart-icon">
            <a href="../public/shoppingCart.php">
                <img src="../images/shopping-cart.png" class="cart-icon">
            </a>
            <br>
            <br>
        </div>


</div>
        
<div class="navbar">
  <a href="#"></a>
  <a href="#"></a>
  <div class="subnav">
    <button class="subnavbtn">SPIRITS <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#deliver">Whiskey & Burbon</a>
      <a href="#package">Gin & Genever</a>
      <a href="#express">Tequila & Mezcal</a>
      <a href="#express">Vodka</a>
      <a href="#express">Absinthe</a>
    </div>
  </div>
  <div class="subnav">
    <button class="subnavbtn">WINES <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#deliver">Red Wine</a>
      <a href="#deliver">White Wine</a>
      <a href="#package">Rose Wine</a>
      <a href="#express">Sparkling Wine & Champagne</a>
      <a href="#express">Fortified & Sweet Wine</a>
      
    </div>
  </div> 
  <div class="subnav">
    <button class="subnavbtn">BEER & CIDER <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#express">Pale Ale</a>
      <a href="#deliver">Lager</a>
      <a href="#package">Stout & Porter</a>
      <a href="#express">Amber & Red Ale</a>
      <a href="#express">Sour</a>
      
    </div>
  </div>
  <div class="subnav">
    <button class="subnavbtn">COCKTAILS & MIX <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#express">Cocktail Mix</a>
      <a href="#deliver">Mixers</a>
      <a href="#package">Soft Drinks</a>
      <a href="#express">Seltzers</a>
      <a href="#express">Ready to Drink Cocktails</a>
    </div>
  </div>
  <div class="subnav">
    <button class="subnavbtn">LIQUEURS <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#express">Bitters</a>
      <a href="#deliver">Cream Liqueurs</a>
      <a href="#package">Fruit Liqueurs</a>
      <a href="#express">Cocktail Garnishes</a>
      <a href="#express">Nut Liqueurs</a>
      
    </div>
  </div>
    <div class="subnav">
        <button class="subnavbtn">DISTILLED BEVERAGES<i class="fa fa-caret-down"></i></button>
        <div class="subnav-content">
        <a href="#express">Gin</a>
        <a href="#deliver">Baijiu</a>
        <a href="#package">Shochu</a>
        <a href="#express">Soju</a>
        <a href="#express">Rum</a>
        
        </div>
    </div>  
</div>
</body>
</html>