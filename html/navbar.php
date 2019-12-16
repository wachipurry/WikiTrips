 <!-- NAVBAR header -->
 <div id="wt_navbar">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 col-md-6 col-sm-12">
                 <a href="#default" id="wt_logo">
                     <p class="text-dark text-left">WikiTrips</p>
                 </a>
             </div>
             <div class="col-lg-4 col-md-6 col-sm-12 text-right">
                 <div id="wt_navbar-right" class=>
                     <p class="text-dark"><?=$_SESSION['username']?></p>
                     <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#sigInModal"> SIGN IN </button>
                     <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#logInModal"> LOG IN </button>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <!-- ANTERIOR

                <a href="#default" id="wt_logo">
                <p class="text-dark text-left">WikiTrips</p>
            </a>
            <div id="wt_navbar-right">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#sigInModal"> SIGN IN </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#logInModal"> LOG IN </button>
            </div>

-->