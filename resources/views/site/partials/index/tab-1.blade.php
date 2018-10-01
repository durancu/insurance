<div class="tab-pane fade" id="tab_1">
    <div class="subheader" id="auto"></div>
    <div class="row">
        <aside class="col-xl-3 col-lg-4">
            <h2>Request a Quote and Compare prices!</h2>
            <p class="lead">An mei sadipscing dissentiet, eos ea partem viderer facilisi.</p>
            <ul class="list_ok">
                <li>Delicata persecuti ei nec, et his minim omnium, aperiam placerat ea vis.</li>
                <li>Suavitate vituperatoribus pro ad, cum in quis propriae abhorreant.</li>
                <li>Aperiri deterruisset ei mea, sed cu laudem intellegat, eu mutat iuvaret voluptatum mei.</li>
            </ul>
        </aside><!-- /aside -->
        
        <div class="col-xl-9 col-lg-8">
            <div id="wizard_container">
                <div id="top-wizard">
                    <strong>Progress</strong>
                    <div id="progressbar"></div>
                </div><!-- /top-wizard -->
                
                <form name="example-1" id="wrapped" method="POST">
                    <input id="website" name="website" type="text" value=""><!-- Leave for security protection, read docs for details -->
                    <div id="middle-wizard">
                        <div class="step">
                            
                            <h3 class="main_question"><strong>1/4</strong>Welcome! How can we help you?</h3>
                            
                            <div class="form-group radio_questions">
                                <label>1. I am currently insured, need saving.
                                    <input name="question_1" type="radio" value="Insured|Yes" class="icheck required">
                                </label>
                            </div>
                            <div class="form-group radio_questions">
                                <label>2. I am currently insured, just curious.
                                    <input name="question_1" type="radio" value="Insured|No" class="icheck required">
                                </label>
                            </div>
                            <div class="form-group radio_questions">
                                <label>3. I am uninsured now, need coverage.
                                    <input name="question_1" type="radio" value="Uninsured|Yes" class="icheck required">
                                </label>
                            </div>
                            <div class="form-group radio_questions">
                                <label>4. I am uninsured now, just curious.
                                    <input name="question_1" type="radio" value="Uninsured|No" class="icheck required">
                                </label>
                            </div>
                        
                        </div><!-- /step 1-->
                        
                        <div class="step">
                            <h3 class="main_question"><strong>2/4</strong>Tell us a little bit more</h3>
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group select">
                                        <label>Where do you live?:</label>
                                        <div class="form-group">
                                            <input type="text" name="zip_code" class="form-control" placeholder="Your zip code">
                                        </div>
                                    </div><!-- /select-->
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group select">
                                        <label>How many vehicles would you like to insure?:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="1">One vehicle</option>
                                                <option value="2">Two vehicles</option>
                                                <option value="3">More than two vehicles</option>
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                            </div>
                        
                        </div><!-- /step 2-->
                        
                        <div class="step">
                            <h3 class="main_question"><strong>3/4</strong>Tell us about your vehicle:</h3>
                            
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Year:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="" selected>Select year</option>
                                                @for($i=2018; $i>1980; $i--)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                                
                                @php
                                    $makes = ['Toyota', 'Ford', 'Chevrolet', 'Nissan', 'Hyundai', 'Kia', 'Buick', 'Chrysler', 'Dodge'];
                                    $models = ['Corolla', 'Camry', 'Avalon', 'Rav4'];
                                    $submodels = ['L', 'LE', 'LXE', 'Sport'];
                                @endphp
                                
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Make:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="" selected>Select make</option>
                                                @foreach($makes as $make)
                                                    <option value="{{$make}}">{{$make}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Model:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="" selected>Select model</option>
                                                @foreach($models as $model)
                                                    <option value="{{$model}}">{{$model}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Submodel:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="" selected>Select submodel</option>
                                                @foreach($submodels as $submodel)
                                                    <option value="{{$submodel}}">{{$submodel}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                                
                                <hr/>
    
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Ownership:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                    <option value="Owned">Owned</option>
                                                    <option value="Financed">Financed</option>
                                                    <option value="Leased">Leased</option>
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
    
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Primary Use:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="Commute">Commute</option>
                                                <option value="Pleasure">Pleasure</option>
                                                <option value="Business">Business</option>
                                                <option value="Farm">Farm</option>
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
    
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Annual Mileage:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="<10000">Less than 10000</option>
                                                @for($i=10000; $i<=50000; $i+=1000)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
    
                                <div class="col-sm-6">
                                    <div class="form-group select">
                                        <label>Night Parking:</label>
                                        <div class="styled-select">
                                            <select class="required" name="select_1">
                                                <option value="Carport">Carport</option>
                                                <option value="Driveway">Driveway</option>
                                                <option value="Private Garage">Private Garage</option>
                                                <option value="Parking Garage">Parking Garage</option>
                                                <option value="Parking Lot">Parking Lot</option>
                                                <option value="Street">Street</option>
                                            </select>
                                        </div>
                                    </div><!-- /select-->
                                </div>
                                
                            
                            
                            </div><!-- /row-->
                        </div><!-- /step 3-->
                        
                        <div class="submit step">
                            
                            <h3 class="main_question"><strong>4/4</strong>Please fill with your details</h3>
                            
                            <div class="row">
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="company_name" class="form-control" placeholder="Your company name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="firstname" class="required form-control" placeholder="First name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lastname" class="required form-control" placeholder="Last name">
                                    </div>
                                </div><!-- /col-sm-6 -->
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="required form-control" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="telephone" class="required form-control" placeholder="Your Telephone">
                                    </div>
                                    <div class="form-group">
                                        <div class="styled-select">
                                            <select class="required" name="country">
                                                <option value="" selected>Select your country</option>
                                                <option value="Europe">Europe</option>
                                                <option value="Asia">Asia</option>
                                                <option value="North America">North America</option>
                                                <option value="South America">South America</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- /col-sm-6 -->
                            </div><!-- /row -->
                            
                            <div class="form-group checkbox_questions">
                                <input name="terms" type="checkbox" class="icheck required" value="yes">
                                <label>Please accept <a href="#" data-toggle="modal" data-target="#terms-txt">terms and conditions</a> ?
                                </label>
                            </div>
                        
                        </div><!-- /step 4-->
                    
                    </div><!-- /middle-wizard -->
                    <div id="bottom-wizard">
                        <button type="button" name="backward" class="backward">Backward</button>
                        <button type="button" name="forward" class="forward">Forward</button>
                        <button type="submit" name="process" class="submit">Submit</button>
                    </div><!-- /bottom-wizard -->
                </form>
            </div><!-- /Wizard container -->
        
        </div><!-- /col -->
    </div><!-- /row -->
</div><!-- /TAB 1:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->