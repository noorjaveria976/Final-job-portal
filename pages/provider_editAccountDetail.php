<?php $pageTitle = "Edit Account "; ?>

<?php
include('config.php');



?>

<section class="section">
    <div class="section-body">
        <!-- add content here -->
        <!-- Personal Information -->
        <div class="">
            <div class="formpanel mt0">

                <form method="POST" action="#" accept-charset="UTF-8" class="form"
                    enctype="multipart/form-data"><input name="_method" type="hidden" value="PUT"><input
                        name="_token" type="hidden" value="SnB3SgeMremYiyemSiJBWHwCEoQHgXgOubUnbgIy">
                    <h5>Acount Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Email</label>
                                <input class="form-control" id="email" placeholder="Company Email"
                                    name="email" type="text" value="employer@jobsportal.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Password</label>
                                <input class="form-control" id="password" placeholder="Password"
                                    name="password" type="password" value="">
                            </div>
                        </div>
                    </div>
                    <hr>


                    <h5>Company Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="userimgupbox">
                                <div class="imagearea">
                                    <label>Company Logo</label>
                                    <img src="assets/img/image-gallery/companyLogo.png"
                                        style="max-width:100px; max-height:100px;" alt="" title="">
                                </div>
                                <div class="formrow">
                                    <div id="thumbnail"></div>
                                    <label class="btn btn-default"> Select Company Logo
                                        <input type="file" name="logo" id="logo" style="display: none;">
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="formrow ">
                                <label>Company Name <span>*</span></label>
                                <input class="form-control" id="name" placeholder="Company Name"
                                    name="name" type="text" value="Multimedia Design">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Industry <span>*</span></label>
                                <select class="form-control" id="industry_id" name="industry_id">
                                    <option value="">Select Industry</option>

                                    <option value="44">Real Estate/Property</option>
                                    <option value="43">Recruitment/Employment Firms</option>
                                    <option value="26">Retail</option>
                                    <option value="45">Security/Law Enforcement</option>
                                    <option value="25">Services</option>
                                    <option value="46">Shipping/Marine</option>
                                    <option value="2">Telecommunication/ISP</option>
                                    <option value="9">Textiles/Garments</option>
                                    <option value="55">Tiles &amp; Ceramics</option>
                                    <option value="24">Travel/Tourism/Transportation</option>
                                    <option value="56">Warehousing</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Ownership <span>*</span></label>
                                <select class="form-control" id="ownership_type_id"
                                    name="ownership_type_id">
                                    <option value="">Select Ownership type</option>
                                    <option value="1">Sole Proprietorship</option>
                                    <option value="2">Public</option>
                                    <option value="3" selected="selected">Private</option>
                                    <option value="4">Government</option>
                                    <option value="5">NGO</option>
                                </select>
                            </div>
                        </div>





                        <div class="col-md-12">
                            <div class="formrow ">
                                <label>Description <span>*</span></label>
                                <textarea
                                    class="form-control summernote-simple">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias minus quod dignissimos.</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 d-none">
                            <div class="formrow ">
                                <label>Address <span>*</span></label>
                                <input class="form-control" id="location" placeholder="Location"
                                    name="location" type="text" value="Your Location Address USA">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>No of Office <span>*</span></label>
                                <select class="form-control" id="no_of_offices" name="no_of_offices">
                                    <option value="">Select num. of offices</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5" selected="selected">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>No of Employees <span>*</span></label>
                                <select class="form-control" id="no_of_employees"
                                    name="no_of_employees">
                                    <option value="">Select num. of employees</option>
                                    <option value="1-10">1-10</option>
                                    <option value="11-50">11-50</option>
                                    <option value="51-100">51-100</option>
                                    <option value="101-200">101-200</option>
                                    <option value="201-300">201-300</option>
                                    <option value="301-600" selected="selected">301-600</option>
                                    <option value="601-1000">601-1000</option>
                                    <option value="1001-1500">1001-1500</option>
                                    <option value="1501-2000">1501-2000</option>
                                    <option value="2001-2500">2001-2500</option>
                                    <option value="2501-3000">2501-3000</option>
                                    <option value="3001-3500">3001-3500</option>
                                    <option value="3501-4000">3501-4000</option>
                                    <option value="4001-4500">4001-4500</option>
                                    <option value="4501-5000">4501-5000</option>
                                    <option value="5000+">5000+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>Established In <span>*</span></label>
                                <select class="form-control" id="established_in" name="established_in">
                                    <option value="">Select Established In</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003" selected="selected">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                    <option value="1989">1989</option>
                                    <option value="1988">1988</option>
                                    <option value="1987">1987</option>
                                    <option value="1986">1986</option>
                                    <option value="1985">1985</option>
                                    <option value="1984">1984</option>
                                    <option value="1983">1983</option>
                                    <option value="1982">1982</option>
                                    <option value="1981">1981</option>
                                    <option value="1980">1980</option>
                                    <option value="1979">1979</option>
                                    <option value="1978">1978</option>
                                    <option value="1977">1977</option>
                                    <option value="1976">1976</option>
                                    <option value="1975">1975</option>
                                    <option value="1974">1974</option>
                                    <option value="1973">1973</option>
                                    <option value="1972">1972</option>
                                    <option value="1971">1971</option>
                                    <option value="1970">1970</option>
                                    <option value="1969">1969</option>
                                    <option value="1968">1968</option>
                                    <option value="1967">1967</option>
                                    <option value="1966">1966</option>
                                    <option value="1965">1965</option>
                                    <option value="1964">1964</option>
                                    <option value="1963">1963</option>
                                    <option value="1962">1962</option>
                                    <option value="1961">1961</option>
                                    <option value="1960">1960</option>
                                    <option value="1959">1959</option>
                                    <option value="1958">1958</option>
                                    <option value="1957">1957</option>
                                    <option value="1956">1956</option>
                                    <option value="1955">1955</option>
                                    <option value="1954">1954</option>
                                    <option value="1953">1953</option>
                                    <option value="1952">1952</option>
                                    <option value="1951">1951</option>
                                    <option value="1950">1950</option>
                                    <option value="1949">1949</option>
                                    <option value="1948">1948</option>
                                    <option value="1947">1947</option>
                                    <option value="1946">1946</option>
                                    <option value="1945">1945</option>
                                    <option value="1944">1944</option>
                                    <option value="1943">1943</option>
                                    <option value="1942">1942</option>
                                    <option value="1941">1941</option>
                                    <option value="1940">1940</option>
                                    <option value="1939">1939</option>
                                    <option value="1938">1938</option>
                                    <option value="1937">1937</option>
                                    <option value="1936">1936</option>
                                    <option value="1935">1935</option>
                                    <option value="1934">1934</option>
                                    <option value="1933">1933</option>
                                    <option value="1932">1932</option>
                                    <option value="1931">1931</option>
                                    <option value="1930">1930</option>
                                    <option value="1929">1929</option>
                                    <option value="1928">1928</option>
                                    <option value="1927">1927</option>
                                    <option value="1926">1926</option>
                                    <option value="1925">1925</option>
                                    <option value="1924">1924</option>
                                    <option value="1923">1923</option>
                                    <option value="1922">1922</option>
                                    <option value="1921">1921</option>
                                    <option value="1920">1920</option>
                                    <option value="1919">1919</option>
                                    <option value="1918">1918</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Website URL <span>*</span></label>
                                <input class="form-control" id="website" placeholder="Website"
                                    name="website" type="text" value="http://www.comapnydomain.com">
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Phone <span>*</span></label>
                                <input class="form-control" id="phone" placeholder="Phone" name="phone"
                                    type="text" value="+1234567890">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Facebook</label>
                                <input class="form-control" id="facebook" placeholder="Facebook"
                                    name="facebook" type="text" value="https://www.facebook.com/">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Twitter</label>
                                <input class="form-control" id="twitter" placeholder="Twitter"
                                    name="twitter" type="text" value="https://twitter.com/">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>LinkedIn</label>
                                <input class="form-control" id="linkedin" placeholder="Linkedin"
                                    name="linkedin" type="text" value="https://www.linkedin.com/">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Pinterest</label>
                                <input class="form-control" id="pinterest" placeholder="Pinterest"
                                    name="pinterest" type="text" value="https://www.pinterest.com/">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>Country <span>*</span></label>
                                <select class="form-control" id="country_id" name="country_id">
                                    <option value="">Select Country</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Albania</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">American Samoa</option>
                                    <option value="5">Andorra</option>
                                    <option value="6">Angola</option>
                                    <option value="7">Anguilla</option>
                                    <option value="8">Antarctica</option>
                                    <option value="9">Antigua And Barbuda</option>
                                    <option value="10">Argentina</option>
                                    <option value="11">Armenia</option>
                                    <option value="12">Aruba</option>
                                    <option value="13">Australia</option>
                                    <option value="14">Austria</option>
                                    <option value="15">Azerbaijan</option>
                                    <option value="16">Bahamas The</option>
                                    <option value="17">Bahrain</option>
                                    <option value="18">Bangladesh</option>
                                    <option value="19">Barbados</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>State <span>*</span></label>
                                <span id="default_state_dd"> <select class="form-control" id="state_id"
                                        name="state_id">
                                        <option value="">Select State</option>
                                    </select> </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="formrow ">
                                <label>City <span>*</span></label>
                                <span id="default_city_dd"> <select class="form-control" id="city_id"
                                        name="city_id">
                                        <option value="">Select City</option>
                                    </select> </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="formrow ">
                                <label>Company Address <span>*</span></label>
                                <input class="form-control" id="map" placeholder="Company Address"
                                    name="map" type="text" value="New York USA">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <h3>HR Person Information</h3>
                        </div>

                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Name <span>*</span></label>
                                <input class="form-control" id="contact_name"
                                    placeholder="e.g. John Doe" name="contact_name" type="text"
                                    value="asdfa">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Email <span>*</span></label>
                                <input class="form-control" id="contact_email"
                                    placeholder="Contact email" name="contact_email" type="email"
                                    value="sfsdf@erer.com">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Designation </label>
                                <input class="form-control" id="ceo" placeholder="e.g. CEO" name="ceo"
                                    type="text" value="Multimedia Design">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="formrow ">
                                <label>Company Registration Number </label>
                                <input class="form-control" id="registration_number"
                                    placeholder="Registration Number" name="registration_number"
                                    type="text" value="2323">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="formrow">
                                <button type="submit" class=" btn1"
                                    style=" background-color: #0400ff; color: #ffffff; padding: 10px 18px; border-radius: 5px; border: none; transition: all 0.3s ease; width: 100%; height: 40px;">Update
                                    Profile and Save <i class="fa fa-arrow-circle-right"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <input type="file" name="image" id="image" style="display:none;" accept="image/*" />
                </form>
            </div>
        </div>








    </div>
</section>