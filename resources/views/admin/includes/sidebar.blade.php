
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('ad/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('ad/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a> --}}
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <a href="{{ route('home') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
       
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Website Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            

              <li class="nav-item">
                <a href="{{ route('Sitesetting.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Sitesettings
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('Coverimage.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cover Image</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('Backimage.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Background Image</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('About.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('RestaurantTables.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Table Info
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('Viewmenu.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Food Menu
                  </p>
                </a>
              </li>

            </ul>
          </li>
         
         
          <li class="nav-item">
            <a href="{{ route('Welcome.index') }}" class="nav-link">
              <i class="fa fa-star" aria-hidden="true"></i>
              <p>
                Welcome page
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Category.index') }}" class="nav-link">
              <i class="fa fa-fire" aria-hidden="true"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('Post.index') }}" class="nav-link">
              <i class="fa fa-eye" aria-hidden="true"></i>
              <p>
                Post
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('BookTables.index') }}" class="nav-link">
              <i class="fa fa-calendar-check" aria-hidden="true"></i>
              <p>
                Book Table
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('Services.index') }}" class="nav-link">
              <i class="fa fa-handshake" aria-hidden="true"></i>
              <p>
                Services
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
              <i class="fas fa-shopping-cart" aria-hidden="true"></i>
              <p>
               Order
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.payments') }}" class="nav-link">
              <i class="fa fa-dollar-sign" aria-hidden="true"></i>
              <p>
               Payment
              </p>
            </a>
          </li>
         

          <li class="nav-item">
            <a href="{{ route('Team.index') }}" class="nav-link">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>
                Team
              </p>
            </a>
          </li>
        
         
          <li class="nav-item">
            <a href="{{ route('Photogallery.index') }}" class="nav-link">
              <i class="fa fa-folder" aria-hidden="true"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('Video.index') }}" class="nav-link">
              <i class="fa fa-folder" aria-hidden="true"></i>
              <p>
                Video Links
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('Projects.index') }}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Projects
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="{{ route('Testimonials.index') }}" class="nav-link">
              <i class="fa-light fa-message-check"></i>
              <p>
                Testimonials
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('Contacts.index') }}" class="nav-link">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              <p>
                Contacts
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
