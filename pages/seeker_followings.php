<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;

?>

<section class="section">
  <div class="section-body">
    <h3 class="text-dark text-center mb-4">My Followings</h3>
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-primary">
          <div class="card-body">
            <div class="empint">
              <a href="" title="Multimedia Design" class="text-dark text-decoration-none">
                <div class="emptbox d-block text-center">
                  <div class="w-25 mx-auto mb-2"><img src="assets/img/multimedia-design-1614272292-782.jpg" alt="Multimedia Design" title="Multimedia Design" class="img-fluid"></div>
                  <div class="text-info-right">
                    <h4>Multimedia Design</h4>
                    <div class="indst fs-6">
                      Manufacturing
                    </div>
                    <div class="emloc py-2 text-dark"><i class="fas fa-map-marker-alt"></i> Designing</div>
                  </div>


                  <div class=" bg-light w-50 mx-auto py-1 border rounded px-2"><span><i class="fas fa-briefcase"></i> 6 Open Jobs</span></div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- card 2 -->
      <div class="col-lg-4">
        <div class="card card-success">
          <div class="card-body">
            <div class="empint">
              <a href="" title="Multimedia Design" class="text-dark text-decoration-none">
                <div class="emptbox d-block text-center">
                  <div class="w-25 mx-auto border rounded mb-2"><img src="assets/img/web-design-studio-1536858894-23.jpg" alt="Multimedia Design" title="Multimedia Design" class="img-fluid"></div>
                  <div class="text-info-right">
                    <h4>Web Design Studio</h4>
                    <div class="indst fs-6">
                      Manufacturing
                    </div>
                    <div class="emloc py-2 text-dark"><i class="fas fa-map-marker-alt"></i> UI/UX</div>
                  </div>


                  <div class="bg-light w-50 mx-auto py-1 border rounded px-2"><span><i class="fas fa-briefcase"></i> 0 Open Jobs</span></div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- card 3 -->
      <div class="col-lg-4">
        <div class="card card-warning">
          <div class="card-body">
            <div class="empint">
              <a href="" title="Multimedia Design" class="text-dark text-decoration-none">
                <div class="emptbox d-block text-center">
                  <div class="w-25 mx-auto border rounded mb-2"><img src="assets/img/wave-media-1536855186-701.jpg" alt="Multimedia Design" title="Multimedia Design" class="img-fluid"></div>
                  <div class="text-info-right">
                    <h4>Wave Media </h4>
                    <div class="indst fs-6">
                      Manufacturing
                    </div>
                    <div class="emloc py-2 text-dark"><i class="fas fa-map-marker-alt"></i> Designing</div>
                  </div>


                  <!-- <div class=" bg-light w-50 mx-auto py-1 border rounded px-2"><span><i class="fas fa-briefcase"></i> 6 Open Jobs</span></div> -->
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>