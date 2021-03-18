        <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-md-none">
    <a class="navbar-brand mr-lg-5" href="../index.html">
        <img class="navbar-brand-dark" src="../assets/img/brand/light.svg" alt="Volt logo" /> <img class="navbar-brand-light" src="../assets/img/brand/dark.svg" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

        <nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
      <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
        <div class="d-flex align-items-center">
          <div class="user-avatar lg-avatar mr-4">
            <img src="../assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white" alt="<?php echo $fullname; ?>">
          </div>
          <div class="d-block">
            <h2 class="h6">Hi, <?php echo $fullname; ?></h2>
            <a href="../logout.php" class="btn btn-secondary text-dark btn-xs"><span class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
          </div>
        </div>
        <div class="collapse-close d-md-none">
            <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
                aria-label="Toggle navigation"></a>
        </div>
      </div>
      <h3><strong>TRU-STEP</strong></h3>
      <ul class="nav flex-column">
        <li class="nav-item  active ">
          <a href="home.php" class="nav-link">
            <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item ">
          <a href="sell.php" class="nav-link">
              <span class="sidebar-icon"><span class="fas fa-hand-holding-usd"></span></span>
              <span>Enter New Order</span>
          </a>
        </li>

        <li class="nav-item ">
        <a href="orders.php" class="nav-link">
        <span class="sidebar-icon"><span class="fas fa-hand-holding-usd"></span></span>
        <span>View All Orders</span>
        </a>
        </li>
       

        <!-- ////only for admin -->
        <?php if($privilege_level == 1){?>
        <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-pages">
            <span>
              <span class="sidebar-icon"><span class="far fa-file-alt"></span></span> 
              Products
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span> 
          </span>
          <div class="multi-level collapse " role="list" id="submenu-pages" aria-expanded="false">
              <ul class="flex-column nav">
                  <li class="nav-item"><a class="nav-link" href="create_product.php"><span>Create</span></a></li>
                  <li class="nav-item"><a class="nav-link" href="products.php"><span>View/Edit</span></a></li>
               
              </ul>
          </div>
        </li>

        <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-pages2">
            <span>
              <span class="sidebar-icon"><span class="far fa-file-alt"></span></span> 
              Product Categories
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span> 
          </span>
          <div class="multi-level collapse " role="list" id="submenu-pages2" aria-expanded="false">
             <ul class="flex-column nav">
                  <li class="nav-item"><a class="nav-link" href="create_product_category.php"><span>Create</span></a></li>
                  <li class="nav-item"><a class="nav-link" href="categories.php"><span>View/Edit</span></a></li>
               
              </ul>
          </div>
        </li>

       

        <li class="nav-item">
          <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-components">
            <span>
              <span class="sidebar-icon"><span class="fas fa-box-open"></span></span> 
              Users
            </span>
            <span class="link-arrow"><span class="fas fa-chevron-right"></span></span> 
          </span>
          <div class="multi-level collapse " role="list" id="submenu-components" aria-expanded="false">
              <ul class="flex-column nav">
                  <li class="nav-item"><a class="nav-link" href="create_user.php"><span>Create</span></a></li>
                  <li class="nav-item"><a class="nav-link" href="users.php"><span>View/Edit</span></a></li>
              </ul>
          </div>
        </li>
          <?php } ?>
      
        <li role="separator" class="dropdown-divider mt-4 mb-3 border-black"></li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
              <img src="../assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1">Profile</span>
          </a>
        </li>
      
        <li class="nav-item ">
          <a href="logout.php" class="nav-link">
              <span class="sidebar-icon"><span class="fas fa-cog"></span></span>
              <span>Logout</span>
          </a>
        </li>


      </ul>
    </div>
</nav>