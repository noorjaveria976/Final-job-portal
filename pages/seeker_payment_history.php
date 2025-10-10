<?php $pageTitle = "Profile "; ?>

<?php

include 'config.php';
$user_id = $_SESSION['user_id'] ?? 0;

?>


<section class="section">
  <div class="section-body">
    <div class="col-lg-12">
      <script>
        var elements = document.querySelectorAll('.popmessage, .bgoverlay');

        if (elements.length > 0) {
          setTimeout(function() {
            elements.forEach(function(element) {
              element.style.display = 'none';
            });
          }, 5000);
        }
      </script>
      <h3 class="text-dark mb-4 text-center">Payment History</h3>
      <table class="table table-bordered table-hover">
        <thead style="background-color: #f0f3ff;">
          <tr>
            <th>Package Title</th>
            <th>Price</th>
            <th>Featured Profile Days</th>
            <th>Payment Method</th>
            <th>Package Start Date</th>
            <th>Package End Date</th>
          </tr>
        </thead>
        <tbody>
          <!-- Only display if package exists -->
          <tr>
            <td>Featured Profile</td>
            <td>USD10</td>
            <td>60</td>
            <td>
              Offline (Added by Admin)
            </td>
            <td>04-05-2025</td>
            <td>03-07-2025</td>
          </tr>



        </tbody>
      </table>

    </div>
</section>