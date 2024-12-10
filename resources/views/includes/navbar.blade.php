
<style>
  @media all and (min-width: 992px) {
	.navbar .nav-item .dropdown-menu{ display: none; }
	.navbar .nav-item:hover .nav-link{   }
	.navbar .nav-item:hover .dropdown-menu{ display: block; }
	.navbar .nav-item .dropdown-menu{ margin-top:0; }
}	
</style>

<section class="bot_nav">
  

  <nav class="navbar navbar-expand-lg">
    <div class="container">
     <a class="navbar-brand" href="{{ route('index') }}">
      <img class="logo" src="{{ url('uploads/sitesetting/' . $sitesetting->main_logo ?? '') }}" alt="logo">
     </a>
     
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation" >
      <i class="fa fa-bars" aria-hidden="true" style="color:white"></i>
     </button>

     <div class="collapse navbar-collapse" id="main_nav">
     <ul class="navbar-nav mx-auto">
       <li class="nav-item "> 
        <a class="nav-link bg-transparent"  aria-current="page" href="{{ route('index') }}" style="display: none"><i class="fa fa-home" aria-hidden="true"></i> 
        </a> 
      </li>

     <li class="nav-item">
        
      <a onclick="myFunction()" class="dropbtn nav-link">Services</a>
 
      <div id="myDropdown" class="dropdown-content">
        @foreach ($categoriesnav as $category)
        <a href="{{ route('Category', $category->id) }}">{{ $category->title }}</a>
       @endforeach
       <a href="{{ route('Viewmenu') }}">Food Menu</a>
      </div>
    </li>

       <li class="nav-item"><a class="nav-link" href="{{ route('About') }}"> About Us </a></li>
       <li class="nav-item"><a class="nav-link" href="{{ route('Gallery') }}">Gallery </a></li>
       <li class="nav-item"><a class="nav-link" href="{{ route('Video') }}">Videos </a></li>
      
       <li class="nav-item"><a class="nav-link" href="{{ route('Contact') }}"> Contact Us </a></li>
    
      {{-- <form class="d-flex" role="search" action="{{ route('Search') }}" method="GET">
        <input  type="text" name="search" required class="form-control me-2" style="font-family: FontAwesome;" aria-label="Search" placeholder='&#xf002 Search...' />

           </form> --}}
     </ul>
     </div> <!-- navbar-collapse.// -->
    </div> <!-- container-fluid.// -->
   </nav>

  </section>

    <script>
     document.querySelectorAll('.nav-link').forEach(link => {
      if(link.href===window.location.href){
        link.setAttribute('aria-current','page')
      }
      
     });
    
      </script>


<script>
  /* When the user clicks on the button, 
  toggle between hiding and showing the dropdown content */
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  </script>

    