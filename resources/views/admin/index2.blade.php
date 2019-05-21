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
      

    </div>
    <div class="row">
      <div class="col-md-6 chart shadow p-3 mb-5 bg-white rounded">
        <h4 class="text-center"><b>Users</b></h4>
        <canvas id="UserChart"></canvas>
      </div>
      <div class="col-md-6 chart shadow p-3 mb-5 bg-white rounded">
        <h4 class="text-center"><b>Auction Inventory</b></h4>
        <canvas id="AuctionChart"></canvas>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 chart shadow p-3 mb-5 bg-white rounded">
        <h4 class="text-center"><b>Time Line</b></h4>
        <canvas id="TimeLineChart" height="90px"></canvas>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 chart shadow p-3 mb-5 bg-white rounded">
        <h4 class="text-center"><b>Brand Car</b></h4>
        <canvas id="BrandChart"></canvas>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6">
        <h4 class="text-center"><b>Time Line1</b></h4>
        <canvas id="Timechart" height="90px"></canvas>
      </div>
      
    </div>
    <div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    var register = JSON.parse("{{ json_encode($user['register_user']) }}");
    var authorized = JSON.parse("{{ json_encode($user['authorized_user']) }}");
    var active = JSON.parse("{{ json_encode($user['active_user']) }}");
    var ctx = document.getElementById('UserChart');
    var UserChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Register', 'Authorized', 'Active'],
            datasets: [{
                label: 'User',
                data: [register, authorized, active],
                backgroundColor: [
                    'rgb(255,0,0, 0.5)',
                    'rgb(0,0,255, 0.5)',
                    'rgb(0,128,0, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 2
            }]
        },
        // options: {
        //     scales: {
        //         yAxes: [{
        //             ticks: {
        //                 beginAtZero: true
        //             }
        //         }]
        //     }
        // }
    });

    //Auction Inventory
    var pending_auction = JSON.parse("{{ json_encode($auction['pending_auction']) }}");
    var approved_auction = JSON.parse("{{ json_encode($auction['approved_auction']) }}");
    var completed_auction = JSON.parse("{{ json_encode($auction['completed_auction']) }}");
    var rejected_auction = JSON.parse("{{ json_encode($auction['rejected_auction']) }}");
    var ctx = document.getElementById('AuctionChart');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending Auction', 'Approved Auction', 'Completed Auction', 'Rejected Auction'],
            datasets: [{
                label: 'Auction',
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(7, 220, 178, 0.5)',
                    'rgba(153, 242, 117, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(7, 220, 178, 0.5)',
                    'rgba(153, 242, 117, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                data: [pending_auction, approved_auction, completed_auction, rejected_auction],
                borderWidth: 2
            }]
        },
        options: {}
    });

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
    var ctx = document.getElementById('TimeLineChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
            datasets: [{
                label: 'Time Line',
                // backgroundColor: '#fff',
                borderColor: 'rgb(255, 99, 132)',
                data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec]
            }]
        },

        // Configuration options go here
        options: {}
    });


    //Brand 
    var hyundai = JSON.parse("{{ json_encode($brand['hyundai']) }}");
    var honda   = JSON.parse("{{ json_encode($brand['honda']) }}");
    var renault = JSON.parse("{{ json_encode($brand['renault']) }}");
    var isuzu   = JSON.parse("{{ json_encode($brand['isuzu']) }}");

    var ctx = document.getElementById('BrandChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['hyundai','honda','renault','isuzu'],
            datasets: [{
                label: 'Brand',
                backgroundColor: [
                    'rgb(154,205,50)',
                    'rgb(0,191,255)'
                ],
                borderColor: [
                    'rgb(154,205,50)',
                    'rgb(0,191,255)'
                    
                ],
                data: [ hyundai,honda,renault,isuzu],
                borderWidth: 1
            }]
        },

        // Configuration options go here
        options: {}
    });
   


   
    var ctx = document.getElementById('Timechart1').getContext('2d');
    
    @foreach($make as $make)
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [@foreach($make->models as $model) '{!! $model->name!!}',@endforeach],
            datasets: [{
                label: '{!!$make->name!!}',
                 backgroundColor: [@foreach($make->models as $model) 
                    'rgb(154,205,50)',
                    'rgb(0,191,255)',
                    'rgb(220,20,60)',
                    'rgb(210,105,30)',
                    @endforeach],
                 borderColor: [
                    'rgb(154,205,50)',
                    'rgb(0,191,255)',
                    'rgb(220,20,60)',
                    'rgb(210,105,30)'],
                data: [@foreach($make->models as $model) {!! $model->vehicle_detail!!},@endforeach]
            }]

        },

        options: {}
    });
    @endforeach
</script>
@endsection