<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;

?>

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">
        <div class="card">
          <div class="body">
            <div id="plist" class="people-list">
              <div class="chat-search">
                <input type="text" class="form-control" placeholder="Search..." />
              </div>
              <!-- new -->
              <ul class="message-history list-unstyled">
                <li class="message-grid active bg-secondary" id="adactive9">
                  <a href="">
                    <div class="d-flex py-2 align-items-center">
                      <div class="jobcompany px-4">

                        <!-- <a href="" class="d-block flex-shrink-0" title="Multimedia Design"><img src="https://www.sharjeelanjum.com/demos/jobsportal-update/company_logos/multimedia-design-1614272292-782.jpg" alt="Multimedia Design" title="Multimedia Design" style=" border-radius: 50%; width: 40px; height: 40px; object-fit: contain; border: 2px solid #ffffff;"> </a> -->
                      </div>

                      <div class="user-name d-flex justify-content-between">
                        <div class="author pe-5 text-dark"> <span>Multimedia Design</span>
                        </div>
                        <div class="count-messages" style="color: blue;">
                          0
                        </div>
                      </div>
                    </div>


                  </a>
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-8">
        <div class="card">
          <div class="chat">
            <div class="chat-header clearfix">
              <img src="assets/img/users/user-1.png" alt="avatar">
              <div class="chat-about">
                <div class="chat-with">Javeria Noor </div>
                <div class="chat-num-messages">2 new messages</div>
              </div>
            </div>
          </div>
          <div class="chat-box" id="mychatbox">
            <div class="card-body chat-content">
            </div>
            <div class="card-footer chat-form">
              <form id="chat-form">
                <input type="text" class="form-control" placeholder="Type a message">
                <button class="btn btn-primary">
                  <i class="far fa-paper-plane"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>