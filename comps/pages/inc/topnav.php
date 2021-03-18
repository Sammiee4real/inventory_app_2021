   <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0">
    <div class="container-fluid px-0">
      <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
        <div class="d-flex" >
          <h5>Making Sales Management Seamless...</h5>
          <!-- Search form -->
          <!-- <form class="navbar-search form-inline" id="navbar-search-main" style="width: 100%;">
            <div class="input-group input-group-merge search-bar" >
                <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                <input  type="text" class="form-control" placeholder="Search" aria-label="Search">
            </div>
          </form> -->
        </div>
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center">
         <!--  <li class="nav-item dropdown">
            <a class="nav-link text-dark mr-lg-3 icon-notifications" data-unread-notifications="true" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="icon icon-sm">
                <span class="fas fa-bell bell-shake"></span>
                <span class="icon-badge rounded-circle unread-notifications"></span>
              </span>
            </a>
           
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media d-flex align-items-center">
                <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder" src="../assets/img/default.jpg">
                <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                  <span class="mb-0 font-small font-weight-bold"><?php echo $fullname; ?>(Logged in as <?php echo $role; ?>)</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
              <a class="dropdown-item font-weight-bold" href="profile.php"><span class="far fa-user-circle"></span>My Profile</a>
             <!--  <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-cog"></span>Settings</a>
              <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-envelope-open-text"></span>Messages</a>
              <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-user-shield"></span>Support</a> -->
              <div role="separator" class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-bold" href="logout.php"><span class="fas fa-sign-out-alt text-danger"></span>Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
</nav>