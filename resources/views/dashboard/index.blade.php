@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <!-- //Aici incepe card -->
        <!-- <div class="card"> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$boards}}</h3>
                                <p>Number of Boards</p>
                            </div>
                            <div class="icon" style="position: relative;bottom:140px; font-size:80px">
                                <!-- <i class="ion ion-bag"></i> -->
                                <i class="ion-ios-photos" style="position:absolute; font-size: 85px;"></i>
                            </div>
                            <a href="/boards" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                            <h3>{{$Nrtask}}</h3>
                                <p>Number of assigned tasks</p>
                            </div>
                            <div class="icon" style="position: relative;bottom:137px;">
                                <i class="ion-android-clipboard" style="position:absolute; font-size: 80px;"></i>
                               </div>
                            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$users}}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$totalVizitatori}}</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
      
            
        <!-- </div> -->
        <!-- /.card -->
        <!-- Aici se termina card -->

       <div class="card" style="width:650px;position:relative;">
       
              <div class="card-header border-0" style="">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Store Visitors</h3>
                  <a href="">View Report</a>
                </div>
              </div>
              <div class="card-body">

<!-- div pentru data  -->
                  <input type="hidden" id="SixdaysagoVal" value="{{$sixdaysago}}" />
                  <input type="hidden" id="FivedaysagosagoVal" value="{{$fivedaysago}}" />
                  <input type="hidden" id="FourdaysagoVal" value="{{$fourdaysago}}" />
                  <input type="hidden" id="ThreedaysagoVal" value="{{$threedaysago}}" />
                  <input type="hidden" id="OtherdayVal" value="{{$Otherday}}" />
                  <input type="hidden" id="YesterdayVal" value="{{$Yesterday}}" />
                  <input type="hidden" id="todayVal" value="{{$today}}" />
<!-- div pentru data  -->


<!-- div pentru nr de  vizitatori  -->
                  <input type="hidden" id="VizitatoriSixdaysagoVal" value="{{$VizitatoriSixdaysago}}" />
                  <input type="hidden" id="VizitatoriFivedaysagoVal" value="{{$VizitatoriFivedaysago}}" />
                  <input type="hidden" id="VizitatoriFourdaysagoVal" value="{{$VizitatoriFourdaysago}}" />
                  <input type="hidden" id="VizitatoriThreedaysagoVal" value="{{$VizitatoriThreedaysago}}" />
                  <input type="hidden" id="VizitatoriOtherdayVal" value="{{$VizitatoriOtherday}}" />
                  <input type="hidden" id="VizitatoriYesterdayVal" value="{{$VizitatoriYesterday}}" />
                  <input type="hidden" id="VizitatoriTodayVal" value="{{$VizitatoriToday}}" />
<!-- div pentru nr de  vizitatori  -->


<!-- div pentru nr de  vizitari  -->
                  <input type="hidden" id="ViziteSixdaysagoVal" value="{{$ViziteSixdaysago}}" />
                  <input type="hidden" id="ViziteFivedaysagoVal" value="{{$ViziteFivedaysago}}" />
                  <input type="hidden" id="ViziteFourdaysagoVal" value="{{$ViziteFourdaysago}}" />
                  <input type="hidden" id="ViziteThreedaysagoVal" value="{{$ViziteThreedaysago}}" />
                  <input type="hidden" id="ViziteOtherdayVal" value="{{$ViziteOtherday}}" />
                  <input type="hidden" id="ViziteYesterdayVal" value="{{$ViziteYesterday}}" />
                  <input type="hidden" id="ViziteTodayVal" value="{{$ViziteToday}}" />
<!-- div pentru nr de  vizitari  -->



                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Total Visit:{{$ViziteTotal}}</span>
                   
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
       
            </div>
            <!-- /.card -->



<!-- width:580px;left:670px;bottom:400px; -->

               <div class="card bg-gradient-success"  >
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%">
				<div class="bootstrap-datetimepicker-widget usetwentyfour">
				<ul class="list-unstyled"><li class="show">
				<div class="datepicker"><div class="datepicker-days" style="">
				<table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">March 2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="02/28/2021" class="day old weekend">28</td><td data-action="selectDay" data-day="03/01/2021" class="day">1</td><td data-action="selectDay" data-day="03/02/2021" class="day">2</td><td data-action="selectDay" data-day="03/03/2021" class="day">3</td><td data-action="selectDay" data-day="03/04/2021" class="day">4</td><td data-action="selectDay" data-day="03/05/2021" class="day">5</td><td data-action="selectDay" data-day="03/06/2021" class="day weekend">6</td></tr><tr><td data-action="selectDay" data-day="03/07/2021" class="day weekend">7</td><td data-action="selectDay" data-day="03/08/2021" class="day">8</td><td data-action="selectDay" data-day="03/09/2021" class="day">9</td><td data-action="selectDay" data-day="03/10/2021" class="day">10</td><td data-action="selectDay" data-day="03/11/2021" class="day">11</td><td data-action="selectDay" data-day="03/12/2021" class="day">12</td><td data-action="selectDay" data-day="03/13/2021" class="day weekend">13</td></tr><tr><td data-action="selectDay" data-day="03/14/2021" class="day weekend">14</td><td data-action="selectDay" data-day="03/15/2021" class="day">15</td><td data-action="selectDay" data-day="03/16/2021" class="day">16</td><td data-action="selectDay" data-day="03/17/2021" class="day">17</td><td data-action="selectDay" data-day="03/18/2021" class="day">18</td><td data-action="selectDay" data-day="03/19/2021" class="day">19</td><td data-action="selectDay" data-day="03/20/2021" class="day weekend">20</td></tr><tr><td data-action="selectDay" data-day="03/21/2021" class="day weekend">21</td><td data-action="selectDay" data-day="03/22/2021" class="day">22</td><td data-action="selectDay" data-day="03/23/2021" class="day">23</td><td data-action="selectDay" data-day="03/24/2021" class="day">24</td><td data-action="selectDay" data-day="03/25/2021" class="day">25</td><td data-action="selectDay" data-day="03/26/2021" class="day">26</td><td data-action="selectDay" data-day="03/27/2021" class="day weekend">27</td></tr><tr><td data-action="selectDay" data-day="03/28/2021" class="day weekend">28</td><td data-action="selectDay" data-day="03/29/2021" class="day">29</td><td data-action="selectDay" data-day="03/30/2021" class="day">30</td><td data-action="selectDay" data-day="03/31/2021" class="day">31</td><td data-action="selectDay" data-day="04/01/2021" class="day new">1</td><td data-action="selectDay" data-day="04/02/2021" class="day new">2</td><td data-action="selectDay" data-day="04/03/2021" class="day new weekend">3</td></tr><tr><td data-action="selectDay" data-day="04/04/2021" class="day new weekend">4</td><td data-action="selectDay" data-day="04/05/2021" class="day new">5</td><td data-action="selectDay" data-day="04/06/2021" class="day new">6</td><td data-action="selectDay" data-day="04/07/2021" class="day new">7</td><td data-action="selectDay" data-day="04/08/2021" class="day new">8</td><td data-action="selectDay" data-day="04/09/2021" class="day new">9</td><td data-action="selectDay" data-day="04/10/2021" class="day new weekend">10</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month active">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year active">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
              </div>
              <!-- /.card-body -->
            </div>
			

    </section>
    <!-- /.content -->
@endsection