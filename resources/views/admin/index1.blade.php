@extends('layouts.admin_layout')

@section('content')

<style type="text/css">
  .chart{
    padding:20px 0px;
    margin: 10px 0px;
  }
  .chart_item{
    /*margin: 5px 0px;*/
    /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
  }
</style>
<main class="main">
  <div class="container">
    <div class="row" style="text-align: center;">
    	<div class="col-md-12">
    		<h3 class="text-center"><b>Auction Admin</b></h3><br><br>
    	</div>
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-primary text-white">
      		<!-- <div class="card-header"></div> -->
      		<div class="card-body">
            <i class="fa fa-user"></i>Total User
      			<h4><b>{{ $total['user']}}</b></h4>
      		</div>
      	</div>
      </div>
      <!-- <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-dark text-white">
      		<div class="card-body">
            <i class="fa fa-gavel"></i>Total Bid Log
      			<h4><b>{{ $total['bid']}}</b></h4>
      		</div>
      	</div>
      </div> -->
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-success text-white">
          <!-- <div class="card-header"><i class="fa fa-gavel"></i>Total Bid Win</div> -->
          <div class="card-body">
            <i class="fa fa-gavel"></i>Total Bid Win
            <h4><b>{{ $total['bid_win']}}</b></h4>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-dark text-white">
      		<!-- <div class="card-header"></div> -->
      		<div class="card-body">
            <i class="fa fa-gavel"></i>Auction Inventory
      			<h4><b>{{ $total['car']}}</b></h4>
      		</div>
      	</div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-danger text-white">
      		<div class="card-body">
            <i class="fa fa-inr"></i>Total Amount
      			<h4><b>0</b></h4>
      		</div>
      	</div>
      </div>
      <!-- <div class="col-xs-6 col-sm-4 col-md-4 col-lg">
      	<div class="card bg-info text-white">
      		<div class="card-body">
      			<i class="fa fa-car-side"></i>Brand
            <h4><b></b></h4>
      		</div>
      	</div>
      </div> -->

    </div>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <div class="row chart">
    
    <div class="col-sm-12 col-md-6 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="UserChart" style="width: 100%; height: 300px;display: inline-block;"></div> 
    </div>
    <div class="col-sm-12 col-md-6 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="AuctionChart" style="width: 100%; height: 300px;display: inline-block;"></div>
    </div>
    <div class="col-sm-12 col-md-6 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="BidWinChart" style="width: 100%; height: 300px;display: inline-block;"></div>
    </div>
    
  </div>
  <div class="row chart">
    <div class="col-sm-12 col-md-6 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="BrandChart" style="width: 100%; height: 300px;display: inline-block;"></div>
    </div>
    <div class="col-sm-12 col-md-6">
      
    </div>
  </div>
  <div class="row chart">
    <div class="col-sm-12 col-md-6 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="TimeLineChart" style="width: 100%; height: 300px;display: inline-block;"></div>
    </div>
  </div>
  <div class="row chart">
    <div class="col-sm-12 col-md-12 chart_item shadow p-3 mb-5 bg-white rounded">
      <div id="chartContainer" style="width: 100%; height: 300px;display: inline-block;"></div>
    </div>
  </div>
  <div class="row chart">
    <div class="col-sm-12 col-md-12 chart_item shadow p-3 mb-5 bg-white rounded">
      <script src="http://code.highcharts.com/highcharts.js"></script>
      <div id="brandcontainer" style="height: 400px"></div>
    </div>
  </div>

  </div>
</main>

<script type="text/javascript">
          
    //user chart
    var register = JSON.parse("{{ json_encode($user['register_user']) }}");
    var authorized = JSON.parse("{{ json_encode($user['authorized_user']) }}");
    var active = JSON.parse("{{ json_encode($user['active_user']) }}");

    var chart = new CanvasJS.Chart("UserChart",
    {
        animationEnabled: true,
        //theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Users"
        },
        axisY: {
          title: "User Number"
        },

        data: [{      

          type: "column",  
          showInLegend: true, 
          legendMarkerColor: "grey",
          legendText: "users",
          dataPoints: [      
            { y: register, label: "Register" },
            { y: authorized,  label: "Authorized" },
            { y: active,  label: "Active" },
            
            
          ]
        }]
      });
    chart.render();

    //Auction chart
    var pending_auction = JSON.parse("{{ json_encode($auction['pending_auction']) }}");
    var approved_auction = JSON.parse("{{ json_encode($auction['approved_auction']) }}");
    var completed_auction = JSON.parse("{{ json_encode($auction['completed_auction']) }}");
    var rejected_auction = JSON.parse("{{ json_encode($auction['rejected_auction']) }}");

    var chart = new CanvasJS.Chart("AuctionChart",
    {
        animationEnabled: true,
        title: {
            text: "Auction Inventory",
        },
        data: [
        {
            type: "pie",
            showInLegend: true,
            dataPoints: [
                { y: pending_auction, legendText: "P A", indexLabel: "Pending Auction" },
                { y: approved_auction, legendText: "A A", indexLabel: "Approved Auction" },
                { y: completed_auction, legendText: "C A", indexLabel: "Completed Auction" },
                { y: rejected_auction, legendText: "R A", indexLabel: "Rejected Auction" }
                
            ]
        },
        ]
    });
    chart.render();

    //Bid Win
    var closed_bid_win = JSON.parse("{{ json_encode($win['closed_bid_win']) }}");
    var recent_bid_win = JSON.parse("{{ json_encode($win['recent_bid_win']) }}");
    var upcoming_bid_win = JSON.parse("{{ json_encode($win['upcoming_bid_win']) }}");

    var chart = new CanvasJS.Chart("BidWinChart",
    {
        animationEnabled: true,
        //theme: "light2", // "light1", "light2", "dark1", "dark2"
        title:{
          text: "Bid Win"
        },
        axisY: {
          title: "Bid Number"
        },
        data: [{        
          type: "column",  
          showInLegend: true, 
          legendMarkerColor: "grey",
          legendText: "bid win",
          dataPoints: [      
            { y: closed_bid_win, label: "Closed Bid Win" },
            { y: recent_bid_win,  label: "Recent Bid Win" },
            { y: upcoming_bid_win,  label: "Upcoming Bid Win" },
            
            
          ]
        }]
      });
    chart.render();

    //Brand chart
    var hyundai = JSON.parse("{{ json_encode($brand['hyundai']) }}");
    var honda   = JSON.parse("{{ json_encode($brand['honda']) }}");
    var renault = JSON.parse("{{ json_encode($brand['renault']) }}");
    var isuzu   = JSON.parse("{{ json_encode($brand['isuzu']) }}");

    var chart = new CanvasJS.Chart("BrandChart",
    {
        animationEnabled: true,
        title: {
            text: "Brand",
        },
        data: [
        {
            type: "pie",
            showInLegend: true,
            dataPoints: [
                { y: hyundai, legendText: "HY", indexLabel: "Hyundai" },
                { y: honda, legendText: "HO", indexLabel: "Honda" },
                { y: renault, legendText: "RE", indexLabel: "Renault" },
                { y: isuzu, legendText: "IZ", indexLabel: "Isuzu" }
                
            ]
        },
        ]
    });
    chart.render();

    //Time Line
    var jan = JSON.parse("{{ json_encode($time['Jan']) }}");
    var feb = JSON.parse("{{ json_encode($time['Feb']) }}");
    var mar = JSON.parse("{{ json_encode($time['Mar']) }}");
    var apr = JSON.parse("{{ json_encode($time['Apr']) }}");
    var may = JSON.parse("{{ json_encode($time['May']) }}");
    var jun = JSON.parse("{{ json_encode($time['Jun']) }}");
    var jul = JSON.parse("{{ json_encode($time['Jul']) }}");
    var aug = JSON.parse("{{ json_encode($time['Aug']) }}");
    var sep = JSON.parse("{{ json_encode($time['Sep']) }}");
    var oct = JSON.parse("{{ json_encode($time['Oct']) }}");
    var nov = JSON.parse("{{ json_encode($time['Nov']) }}");
    var dec = JSON.parse("{{ json_encode($time['Dec']) }}");

    var chart = new CanvasJS.Chart("TimeLineChart",
        {
            animationEnabled: true,
            title: {
                text: "Auction Time Line 2019"
            },
            axisX: {
                valueFormatString: "MMM",
                interval: 1,
                intervalType: "month"
            },
            axisY: {
                includeZero: false
            },
            data: [
            {
              type: "line",

              dataPoints: [

                  { x: new Date(2019, 0), y: jan },
                  { x: new Date(2019, 1), y: feb },
                  { x: new Date(2019, 2), y: mar },
                  { x: new Date(2019, 3), y: apr },
                  { x: new Date(2019, 4), y: may },
                  { x: new Date(2019, 5), y: jun },
                  { x: new Date(2019, 6), y: jul },
                  { x: new Date(2019, 7), y: aug },
                  { x: new Date(2019, 8), y: sep },
                  { x: new Date(2019, 9), y: oct },
                  { x: new Date(2019, 10), y: nov },
                  { x: new Date(2019, 11), y: dec }
                ]
            }
            ]
        });
    chart.render();


    
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer1", {
  title: {
    text: "Auction Time Line 2019"
  },
  axisX: {
    valueFormatString: "MMM YYYY"
  },
  
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    verticalAlign: "top",
    horizontalAlign: "center",
    dockInsidePlotArea: true,
    itemclick: toogleDataSeries
  },
  data: [{
    type:"line",
    axisYType: "secondary",
    name: "delivery",
    showInLegend: true,
    markerSize: 0,
    //yValueFormatString: "$#,###k",
    dataPoints: [   
      { x: new Date(2019, 0), y: jan },
      { x: new Date(2019, 1), y: feb },
      { x: new Date(2019, 2), y: mar },
      { x: new Date(2019, 3), y: apr },
      { x: new Date(2019, 4), y: may },
      { x: new Date(2019, 5), y: jun },
      { x: new Date(2019, 6), y: jul },
      { x: new Date(2019, 7), y: aug },
      { x: new Date(2019, 8), y: sep },
      { x: new Date(2019, 9), y: oct },
      { x: new Date(2019, 10), y: nov },
      { x: new Date(2019, 11), y: dec }
    ]
  },
  {
    type: "line",
    axisYType: "secondary",
    name: "Manhattan",
    showInLegend: true,
    markerSize: 0,
    //yValueFormatString: "$#,###k",
    dataPoints: [
      { x: new Date(2019, 0), y: 0 },
      { x: new Date(2019, 1), y: 9 },
      { x: new Date(2019, 2), y: 5 },
      { x: new Date(2019, 3), y: 7 },
      { x: new Date(2019, 4), y: 3 },
      { x: new Date(2019, 5), y: 2 },
      { x: new Date(2019, 6), y: 8 },
      { x: new Date(2019, 7), y: 2 },
      { x: new Date(2019, 8), y: 8 },
      { x: new Date(2019, 9), y: 9 },
      { x: new Date(2019, 10), y: 4 },
      { x: new Date(2019, 11), y: 3 }
    ]
  },
  {
    type: "line",
    axisYType: "secondary",
    name: "Seatle",
    showInLegend: true,
    markerSize: 0,
    //yValueFormatString: "$#,###k",
    dataPoints: [
      { x: new Date(2019, 0), y: 5 },
      { x: new Date(2019, 1), y: 8 },
      { x: new Date(2019, 2), y: 1 },
      { x: new Date(2019, 3), y: 3 },
      { x: new Date(2019, 4), y: 7 },
      { x: new Date(2019, 5), y: 2 },
      { x: new Date(2019, 6), y: 8 },
      { x: new Date(2019, 7), y: 2 },
      { x: new Date(2019, 8), y: 5 },
      { x: new Date(2019, 9), y: 2 },
      { x: new Date(2019, 10), y: 9},
      { x: new Date(2019, 11), y: 7 }
    ]
  },
  {
    type: "line",
    axisYType: "secondary",
    name: "Los Angeles",
    showInLegend: true,
    markerSize: 0,
    //yValueFormatString: "$#,###k",
    
  }]
});
chart.render();

function toogleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else{
    e.dataSeries.visible = true;
  }
  chart.render();
}

}

// click 



    


    

    
    

</script>
@endsection