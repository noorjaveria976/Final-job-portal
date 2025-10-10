<?php $pageTitle = "Dashboard"; ?>

<section class="section">
          <div class="pageSearch  pb-md-5">
            <form action="https://www.sharjeelanjum.com/demos/jobsportal-update/search-jobs" method="get">
              <!-- Page Title start -->
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-lg-7">
                    <h3 class="mt-0 text-center">Welcome to Your Candidate Dashboard</h3>
                    <div class="searchform p-2 border border-1 border-success bg-white" style="border-radius: 15px;">
                      <div class="input-group p-1 border-0 mysearch" style="font-size: 19px;">
                        <input type="text" name="search" id="jbsearch" value="" class="form-control ui-autocomplete-input p-4 border-0" placeholder="Enter Skills or job title">
                        <button type="submit" class="btn btn-primary text-white fs-3 px-3" style="border-radius: 8px;"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Page Title end -->
            </form>
          </div>




          <!-- cards section start -->
          <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-30">159</h5>
                          <h2 class="mb-3 font-15"><strong>Profile Views</strong></h2>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0">
                        <div class="card-content">
                          <h5 class="font-30"> 3</h5>
                          <h2 class="mb-1 font-15">Followers</h2>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-30">1 </h5>
                          <h2 class="mb-3 font-15">My CV List</h2>


                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">0</h5>
                          <h2 class="mb-3 font-18">Messages</h2>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- coverphoto -->
          <div class="row usercoverphoto" style="position: relative; height: 300px; overflow: hidden; border-radius: 15px; background: #eee;">
            <div class="col-12 px-0">
              <img src="./assets/img/cover pic.jpg" class="w-100 d-block" alt="Job Seeker" title="Job Seeker">
              <a href="my_profile.php" class="text-decoration-none"><i class="fas fa-edit"></i></a>
            </div>
          </div>
          <!-- profile -->
          <div class="profileban" style="position: relative; margin-top: -70px;">
            <div class="abtuser" style="background: #f1f5ff; padding: 20px; border-radius: 15px; margin: 0 50px; margin-bottom: 30px;">
              <div class="row">
                <div class="col-lg-2 col-md-3">
                  <div class="uavatar"><img src="./assets/img/user.png" alt="Job Seeker" title="Job Seeker" style="display: block; width: 120px; height: 120px; object-fit: cover; border-radius: 5px;"></div>
                </div>
                <div class="col-lg-10 col-md-9">
                  <h4>Job Seeker</h4>
                  <ul class="userdata">
                    <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Bainbridge Island, Washington, United States of America</li>
                    <li><i class="fas fa-phone" aria-hidden="true"></i> +1234567890</li>
                    <li><i class="fas fa-envelope" aria-hidden="true"></i> seeker@jobsportal.com</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Applied jobs -->
          <div class="appliedjobswrap">
            <h3>My Applied Jobs</h3>
            <p>No applied jobs found.</p>
          </div>
          <!-- Recommended Jobs -->

          <div class="recommendedjobs">
            <h3>Recommended Jobs </h3>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-primary">
                  <div class="jobint p-3 ">

                    <!-- <span class="promotepof-badge"><i class="fa fa-bolt" title="This Match is Featured"></i></span> -->
                    <div class="d-flex">
                      <div class="fticon"><i class="fas fa-briefcase"></i> Full Time/Permanent</div>
                    </div>
                    <h4>
                      <a href="" class="text-decoration-none text-dark" title="UI/UX Designer">
                        UI/UX Designer
                      </a>
                    </h4>

                    <div class="salary mb-2">Salary:
                      <strong>$30000 - $90000/Monthly</strong>
                    </div>

                    <strong><i class="fas fa-map-marker-alt"></i> Islamabad</strong>
                    <div class="jobcompany d-flex mt-3 justify-content-between align-items-center p-3 bg-light" style="border-radius: 15px;">
                      <div class="ftjobcomp">
                        <div>Mar 07, 2025</div>
                        <a href="" class="text-decoration-none text-dark" title="Power Color">Power Color</a>
                      </div>           
                      <a href="" class="company-logo" title="Power Color" style=" display: block; flex-shrink: 0;"><img src="./assets/img/power-color-1536854682-955.jpg" alt="Power Color" title="Power Color" style=" border-radius: 50%;  width: 60px;  height: 60px; object-fit: contain; border: 2px solid #ffffff;"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-secondary">
                  <div class="jobint p-3 ">

                    <!-- <span class="promotepof-badge"><i class="fa fa-bolt" title="This Match is Featured"></i></span> -->
                    <div class="d-flex">
                      <div class="fticon"><i class="fas fa-briefcase"></i> Full Time/Permanent</div>
                    </div>
                    <h4>
                      <a href="" class="text-decoration-none text-dark" title="UI/UX Designer">
                        IOS Developer
                      </a>
                    </h4>

                    <div class="salary mb-2">Salary:
                      <strong>$30000 - $90000/Monthly</strong>
                    </div>

                    <strong><i class="fas fa-map-marker-alt"></i> Atlanta</strong>
                    <div class="jobcompany d-flex mt-3 justify-content-between align-items-center p-3 bg-light" style="border-radius: 15px;">
                      <div class="ftjobcomp">
                        <div>Mar 07, 2025</div>
                        <a href="" class="text-decoration-none text-dark" title="Power Color">Multimedia Design </a>
                      </div>
                      <a href="" class="company-logo" title="Power Color" style=" display: block; flex-shrink: 0;"><img src="./assets/img/power-color-1536854682-955.jpg" alt="Power Color" title="Power Color" style=" border-radius: 50%;  width: 60px;  height: 60px; object-fit: contain; border: 2px solid #ffffff;"></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-danger">
                  <div class="jobint p-3 ">

                    <!-- <span class="promotepof-badge"><i class="fa fa-bolt" title="This Match is Featured"></i></span> -->
                    <div class="d-flex">
                      <div class="fticon"><i class="fas fa-briefcase"></i> Full Time/Permanent</div>
                    </div>
                    <h4>
                      <a href="" class="text-decoration-none text-dark" title="UI/UX Designer">
                        Electrical Engineer
                      </a>
                    </h4>

                    <div class="salary mb-2">Salary:
                      <strong>$30000 - $90000/Monthly</strong>
                    </div>

                    <strong><i class="fas fa-map-marker-alt"></i> Aventura</strong>
                    <div class="jobcompany d-flex mt-3 justify-content-between align-items-center p-3 bg-light" style="border-radius: 15px;">
                      <div class="ftjobcomp">
                        <div>Mar 07, 2025</div>
                        <a href="" class="text-decoration-none text-dark" title="Power Color">Power Wave </a>
                      </div>
                      <a href="" class="company-logo" title="Power Color" style=" display: block; flex-shrink: 0;"><img src="./assets/img/power-color-1536854682-955.jpg" alt="Power Color" title="Power Color" style=" border-radius: 50%;  width: 60px;  height: 60px; object-fit: contain; border: 2px solid #ffffff;"></a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Followings -->
          <div class="appliedjobswrap">
            <h3>My Followings</h3>
            <p>No Followings Found</p>
          </div>


        </section>