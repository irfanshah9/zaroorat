@extends('admin.layouts.app')

@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
        </div>
        <!-- <h3 class="page-title">
            <small></small>
        </h3> -->
        <div class="row">
            
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="more" href="#">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="1349">3343</span>
                            </div>
                            <div class="desc"> Test </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="more" href="#">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" ></span>4343 </div>
                            <div class="desc"> Test2</div>
                        </div>
                    </div>
                </a>
            </div>
             
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="more" href="#">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup">4344</span>
                            </div>
                            <div class="desc"> Test3 </div>
                        </div>
                    </div>
                </a>      
            </div>
              
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="more" href="#">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number"> 
                                <span data-counter="counterup" data-value="89"></span>3434 </div>
                            <div class="desc"> Test4</div>
                        </div>
                    </div>
                </a>
            </div>
            
    </div>
              
    
         <div class="row">
             <div id="chart_div" style="width: 900px; height: 500px;"></div>
        </div>
        
        <div class="clearfix"></div>
    </div>
</div>

@endsection
