<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" >
    
    <title>Braintem Online University</title>
    {{-- one signal --}}
    <link rel="manifest" href="/manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "927dc3a7-ced1-4550-bbfa-cc127860a2e1",
    });
  });
</script>


<!-- Start of Async ProveSource Code --><script>!function(o,i){window.provesrc&&window.console&&console.error&&console.error("ProveSource is included twice in this page."),provesrc=window.provesrc={dq:[],display:function(o,i){this.dq.push({n:o,g:i})}},o._provesrcAsyncInit=function(){provesrc.init({apiKey:"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2NvdW50SWQiOiI1Y2E0MWY0MWU4MDZhYTU5NGUwNWU2OTgiLCJpYXQiOjE1NTQyNTk3Nzd9.7w44V8Fyc9z_dYF0napNhfJFAgp0o9Hr9IGaMbPdFhU",v:"0.0.3"})};var r=i.createElement("script");r.type="text/javascript",r.async=!0,r.charset="UTF-8",r.src="https://cdn.provesrc.com/provesrc.js";var e=i.getElementsByTagName("script")[0];e.parentNode.insertBefore(r,e)}(window,document);</script><!-- End of Async ProveSource Code -->
  </head>



  <body>
    

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand mb-3" style="font-size: 25px; color: grey;" href="/">
          {{--  <img src="/images/logo-coral.svg" width="100px" >  --}}
         <b> Braintem </b>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" 
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
         aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse " id="navbarSupportedContent">


          <ul class="navbar-nav mr-auto container-fluid">
           
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-list-ul"></i> Categories
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach($categories as $category)
                          <a class="dropdown-item" href="/categories/{{ $category->id }}">{{ $category->name }}</a>
                      @endforeach
               {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>  --}}
              </div>
            </li>
{{--  
            <li class="nav-item col-8">
                     <form class="form-inline my-2 my-lg-0 inbutton">
                            <input class="form-control form-control-lg mr-sm-0 col-8 bg-light border-0 "
                            style="border-radius: 5px 0px 0px 5px" 
                            type="search" placeholder="Search for Courses" aria-label="Search">
                             
                            <button class="btn btn-light btn-lg  my-2 my-sm-0 ml-0 col-2" 
                          style="border-radius: 0px 5px 5px 0px;"
                            type="submit"><i class="fas fa-search text-danger "></i></button>
                        </form>
                    </li>  --}}

          </ul>

           
                {{--  <a class="nav-link btn btn-light  mx-2" href="#"
                
                data-toggle="popover" title="Try Udemy for Business"
                data-placement="bottom",
                data-trigger="focus"
                data-content="Get your team access to Udemy’s top 2,500 courses anytime,
                 anywhere.">Udemy for Business</a>
                <a class="nav-link btn btn-light  mx-2" href="#">Become an Instructor</a>  --}}

                <a class="nav-link btn btn-light  mx-2 rounded-circle" href="#">  <i class="fas fa-shopping-cart"></i> </a>
                <a data-toggle="modal" data-target="#loginModal"class="nav-link btn btn-outline-dark" href="/login">Login</a>
           
                <a data-toggle="modal" data-target="#registerModal" class="nav-link btn btn-danger mx-2" href="/register">Signup</a>
            

          
        </div>
      </nav>

      {{-- One signal invitation 
      <div class='onesignal-customlink-container'></div> --}}     
    {{-- 
      <div class="jumbotron big-banner mb-0 jumbotron-fluid" 
      style="height: 500px; padding-top: 100px;">
         

          <div class="container">
            
                <div class="row align-items-center">
                  
                  <div class="col">
                    <div class="col-md-5 text-light" 
                    style=" background:rgba(151, 19, 19, 0.6); border-radius: 10px;">
                        <h3 class="display-5">Earn thousands of dollars every
                           month after owning any of these easy courses right 
                           away!</h3>
                        <p class="lead pb-3">
                          To start now <i class="glyphicon glyphicon-hand-right"></i> 
                           <a href="/login" data-toggle="modal" data-target="#loginModal" class="btn btn-success btn-lg">Login</a> or 
                           <a href="/register" data-toggle="modal" data-target="#registerModal" class="btn btn-primary btn-lg">Register</a> 
                          </p>
                  </div>



                  </div>
                 
                </div>
              </div>

       </div> --}}


       <div class="fresh-content text-light py-3" >
           <div class="container">
               <div class="row">
                   <div class="col-md-4">
                       <div class="media">
                            <i class="far fa-play-circle mr-3 display-4" ></i>
                            <div class="media-body">
                              <h5 class="mt-0">Fresh Courses</h5>
                              Choose from 100s of videos with new additions published every month
                            </div>
                          </div>
                   </div>

                   <div class="col-md-4">
                        <div class="media">
                             <i class="fas fa-ribbon mr-3 display-4" ></i>
                             <div class="media-body">
                               <h5 class="mt-0">Trusted Instructors</h5>
                               Take courses taught by industry experts around the world
                             </div>
                           </div>
                    </div>
                   
                   <div class="col-md-4">
                        <div class="media">
                             <i class="fas fa-spinner mr-3 display-4" ></i>
                             <div class="media-body">
                               <h5 class="mt-0">Flexible Learning</h5>
                               Learn on your terms with lifetime course access and the Udemy mobile app
                             </div>
                           </div>
                    </div>

                    
                 
               </div>
           </div>
       </div>




     




       <div class="container mt-5 text-center" >
           <h3>
                <small class="text-muted">Top Courses</small>
              </h3>

            <div class="card-columns" >
                  @foreach($courses as $course)
                    <div class="card mx-1">
                        <span class="badge  badge-warning w-50 mt-2"
                          style="position: absolute; z-index: 3"
                        >BEST SELLER</span>
                    <a href="/courses/{{ $course->id }}" class="card-img-top h-50"  >  
                        <img   class="w-100" src="/images/course.jpg" alt="{{ $course->title }}"> 
                    </a> 
                    <br/>
                      <div class="card-body px-2">
                        <h6>{{ $course->title }}</h6>
                        <p class="card-text" style="font-size: 11px;">{{ $course->user['name'] }} | {{ $course->sub_title }}</p>
                        <p class="card-text"><small class="text-muted">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half text-warning"></i>
                          {{--  4.5 (18,560)  --}}
                        </small>
                          <span class="d-block"></span>
                         
                          <span class="float-left" style=" font-size: 25px;"> 
                            ${{ number_format($course->discount_price/360) }} 
                            <small style="text-decoration: line-through; color:brown;" >
                              (${{number_format($course->actual_price / 360)}}) </small> <br/>

                              
                              <small style="font-size: 15px;">
                               or 
                               
                               <span class="text-success text-bold">
                                 <b>₦{{ number_format($course->discount_price) }}</b>
                              </small>
                              </small>
                              <small style="font-size: 15px;text-decoration: line-through; color:brown;" >
                              (₦{{number_format($course->actual_price)}}) </small>
                              
                            </span>
                           <div style="float:right;" >
                          {{-- <a href="/courses/{{ $course->id }}" class="btn btn-lg btn-default text-dark btn-oyline" >Read more</a> --}}
                          <a href="/courses/{{ $course->id }}" class="btn btn-lg btn-danger" >Enroll Now</a>
                           </div>
                          </p>
                      </div>
                    </div>
                    @endforeach
                  </div>



                  
       </div>


       {{--  <div class="container mt-5" >
          <h3>
               <small class="text-muted">Top Courses in "Business"</small>
             </h3>

             <div class="row">
               <div class="col">
                  <a href="#" class="btn btn-primary btn-block btn-lg">Top Rated</a>
               </div>
               <div class="col">
                  <a href="#" class="btn btn-secondary btn-block btn-lg">Trending</a>
                </div>
               <div class="col">
               <a href="#" class="btn btn-info btn-block btn-lg">New and Notworthy</a>
               </div>
             </div>

      </div>  --}}


      {{--
      <div class="container mt-5" >
          <h3>
               <small class="text-muted">Achieve Your Goals</small>
             </h3>

             <div class="row">
               <div class="col-md-4">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/woman_photo2.jpg" style="height: 250px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Expand your programming knowledge</figcaption>
                        </figure>
                  </a>
               </div>
               <div class="col-md-4">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/woman_photo1.jpeg" style="height: 250px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Be your own boss</figcaption>
                        </figure>
                  </a>
                </div>
               <div class="col-md-4">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/laptop1.jpg" style="height: 250px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Land an exciting new tech job</figcaption>
                        </figure>
                  </a>
               </div>
             </div>

      </div>



      <div class="container mt-3" >
             <div class="row">
                <div class="col-md-3">
                    <a href="#" >
                        <figure class="figure">
                            <img src="/images/laptop2.jpg" style="height: 150px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                            <figcaption class="figure-caption text-center">
                              Indulge your curiousity</figcaption>
                          </figure>
                    </a>
                 </div>

               <div class="col-md-3">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/woman_photo2.jpg" style="height: 150px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Expand your programming knowledge</figcaption>
                        </figure>
                  </a>
               </div>
               <div class="col-md-3">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/woman_photo1.jpeg" style="height: 150px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Be your own boss</figcaption>
                        </figure>
                  </a>
                </div>
               <div class="col-md-3">
                  <a href="#" >
                      <figure class="figure">
                          <img src="/images/laptop1.jpg" style="height: 150px;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                          <figcaption class="figure-caption text-center">
                            Land an exciting new tech job</figcaption>
                        </figure>
                  </a>
               </div>
             </div>

      </div>

--}}

{{-- 

      <div class="container mt-5 text-center" >
          <h3>
               <small class="text-muted">Featured Topics</small>
             </h3>

             @foreach ($categories as $category )
                
             <a href="/categories/{{ $category->id }}" class="btn btn-light shadow">{{ $category->name }}</a> 
             @endforeach
      </div>


  <div class="container " style="margin-top: 120px;">
         <div class="row">
           <div class="col text-center border-right">
            <div class="col-8 offset-1">
             <h4>Become a Member</h4>
             <p class="lead" style="font-size: 15px;">Learn what you love. This platform gives you the tools to learn a lot from online courses.</p>
            <a href="/register" data-toggle="modal" data-target="#registerModal"class="btn btn-lg btn-danger">Start Learning</a>
            </div>
          </div>

          <div class="col text-center">
              <div class="col-8 offset-1">
               <h4>Login</h4>
               <p class="lead" style="font-size: 15px;">Get unlimited access to hundreds of our top videos for you and your team.</p>
              <a href="/login" data-toggle="modal" data-target="#loginModal" class="btn btn-lg btn-danger">Continue learning</a>
              </div>
            </div>


         </div>
      </div>

--}}

      {{--  <div class="container " style="margin-top: 120px;">
         <div class="row">
           <div class="col text-center border-right">
            <div class="col-8 offset-1">
             <h4>Become an Instructor</h4>
             <p class="lead" style="font-size: 15px;">Teach what you love. Udemy gives you the tools to create an online course.</p>
            <a href="#" class="btn btn-lg btn-danger">Start Teaching</a>
            </div>
          </div>

          <div class="col text-center">
              <div class="col-8 offset-1">
               <h4>Udemy for Business</h4>
               <p class="lead" style="font-size: 15px;">Get unlimited access to 2,500 of Udemy’s top courses for your team.</p>
              <a href="#" class="btn btn-lg btn-danger">Get Udemy for business</a>
              </div>
            </div>


         </div>
      </div>  --}}


{{--  <div class="row pt-5 px-3 border-top mt-5 " style="font-size: 13px;">
  <div class="col">

    
    <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-info" href="#"><b>Udemy for business</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info" href="#"><b>Become and Instructor</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-info" href="#">Mobile Apps</a>
        </li>
      </ul>


  </div>
  <div class="col">

      <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-info" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" href="#">Careers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" href="#">Blog</a>
          </li>
        </ul>

  </div>
  <div class="col">

      <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-info" href="#">Topics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" href="#">Support</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" href="#">Affiliate</a>
          </li>
        </ul>

  </div>
  <div class="col">
<form>
    <div class="form-group col-6 float-right">
        <select  class="form-control" id="exampleFormControlSelect2">
          <option><i class="fas fa-globe"></i> English</option>
          <option>Japanese</option>
          <option>Yoruba</option>
          <option>Igbo</option>
          <option>Hausa</option>
        </select>
      </div>
</form>

  </div>
</div>
  --}}


{{--  
<nav class="nav mt-5 ml-3" style="font-size: 12px;">
    <span class="nav-link active text-muted font-weight-bold" >Local Home Pages</span>
    <span class="nav-link" >English</span>
    <a class="nav-link text-info" href="#">Deutsch</a>
    <a class="nav-link text-info" href="#">Français</a>
    <a class="nav-link text-info" href="#">Português</a>
    <a class="nav-link text-info" href="#">日本語</a>
  </nav>  --}}
<hr/>

<div class="row" style="font-size: 12px;">
      <div class="col pl-5">
          {{--  <img src="/images/logo-coral.svg" width="100px" class="mr-5" >  --}}
           <a class="navbar-brand mb-3" style="font-size: 15px; color: grey;" href="/">
          {{--  <img src="/images/logo-coral.svg" width="100px" >  --}}
        
           <span>Copyright © 2019 Dave Partner Media.</span>
      </div>
      <div class="col">
          <ul class="nav justify-content-end">
              <li class="nav-item">
                <a class="nav-link active text-info" href="#">Terms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="#">Privacy and Cookie Policy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" href="#">Intellectual Property</a>
              </li>
            </ul>

      </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="loginModalLabel">Login</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>
      <div class="modal-body">
        @include('auth.login-element')
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" 
aria-labelledby="registerModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="registerModalLabel">Register</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>
      <div class="modal-body">
        @include('auth.register-element')
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>








 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  
  <script>
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
  
  </script>
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c9dd6a71de11b6e3b05cd12/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>



</html>