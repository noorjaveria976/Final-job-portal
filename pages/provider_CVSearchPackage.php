<?php $pageTitle = "Edit Account "; ?>

<?php
include('config.php');



?>

<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between">
                    <h4>Purchased Cvs Package Details</h4>

                </div>
                <div class="card-body bg-light">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport"
                            style="width:100%;">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white">
                                        Package Name</th>
                                    <th class="text-white">Price</th>
                                    <th class="text-white">Available CV quota</th>
                                    <th class="text-white"> Purchased On</th>
                                    <th class="text-white"> Package Expired</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white text-dark">
                                    <td>Basic</td>
                                    <td>USD10</td>
                                    <td>10 / 21</td>
                                    <td>2025-04-08 11:32:29</td>
                                    <td>
                                        2026-11-28 19:00:00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---four-paln-->
        <div class="four-plan">
            <h3>Upgrade CV Search Packages</h3>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="boxes">
                        <li class="plan-name">Startup</li>
                        <li>
                            <div class="main-plan">
                                <div class="plan-price1-1">USD</div>
                                <div class="plan-price1-2">30</div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> Applicant CV Views 30
                        </li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> CV View Access 30
                            Days</li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> Premium Support 24/7
                        </li>


                        <li class="order paypal"><a href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#buypack4" class="reqbtn">Buy Now <i
                                    class="fas fa-arrow-right"></i></a></li>
                    </ul>
                    
                </div>



            </div>
        </div>
        <!---end four-paln-->
    </div>
</section>