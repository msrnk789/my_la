@extends('layouts.admin_layout')

@section('content')
<?php
	
?>
<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3 class="text-center"><b>Vehicle Details</b></h3>
                <a href="{{url('admin/bid_vehicle_detail')}}" class="btn btn-danger">Back</a>
                <form method="POST" action="{{url('admin/bid_vehicle_detail/')}}" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label>Brand Name</label>
                        <select name="make_id" id="make" class="form-control" required autofocus onchange="getModel()"> 
                            <option value="">Select Brand</option>
                            @foreach($bidmake as $bidmake)
                            <option value="{{$bidmake->id}}">{{$bidmake->name}}</option>
                            @endforeach
                                      
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Model Name</label>
                        <select name="vehicle_model_id" id="model" class="form-control" required autofocus onchange="getVariant()">             
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Model Variant</label>
                        <select name="variant_id" id="variant" class="form-control" required >           
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fuel Type</label>
                        <select class="form-control" name="fuel_id" required>
                            <option value="">Select Fuel</option>
                            @foreach($bidfuel as $bidfuel)
                            <option value="{{$bidfuel->id}}">{{ $bidfuel->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Body Type</label>
                        <select class="form-control" name="body_type_id" required>
                            <option value="">Select Body Type</option>
                            @foreach($bodytype as $bodytype)
                            <option value="{{ $bodytype->id}}">{{ $bodytype->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Number of Owners</label>
                        <input type="text" name="number_of_owners" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Car Color</label>
                        <input type="text" name="car_color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Killometer Driven</label>
                        <input type="text" name="car_kms_driven" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Registration Number</label>
                        <input type="text" name="car_reg_num" class="form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label>Expected Price</label>
                        <input type="text" name="expected_price" class="form-control" required>
                    </div> -->
                    <div class="form-group">
                        <label>Registration Place</label>
                        <input type="text" name="car_reg_place" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Car Condition</label>
                        <input type="text" name="car_condition" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Licence Plate Number</label>
                        <input type="text" name="licence_plate_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Vin Number</label>
                        <input type="text" name="vin_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Purchase Year</label>
                        <input type="text" name="purchase_year" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Insurance Validity</label>
                        <input type="text" name="insurance_validity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Vehicle Value</label>
                        <input type="text" name="vehicle_value" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bid Minimum Price</label>
                        <input type="text" name="min_bid_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bid Start Time</label>
                        <input type="Time" name="bid_start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bid End Time</label>
                        <input type="time" name="bid_end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bid Date</label>
                        <input type="date" name="bid_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label> More than one Images</label>
                        <input type="file" name="image[]" class="form-control" multiple required>
                    </div>
                    <!-- <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" class="form-control" required>
                    </div> -->

                    <div class="form-group">
                        <a href="{{url('admin/bid_vehicle_detail')}}" class="btn btn-danger">Cancel</a>
                         <input type="submit" value="Submit" class="btn btn-primary">   
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<script>
    function getModel()
    {
        var val =document.getElementById('make').value;
        $.ajax({
            url:'{{ url("admin/get_vehicle_model")}}',
            type:'GET',
            data:{val:val},
            dataType:'JSON',
            success:function(data){
               
                var empty = '';
                empty += '<option value="">' + "Select Model" + '</option>';
                $.each(data, function (index, value) {
                    empty += '<option value='+value.id+'>' + value.name + '</option>';
                });
                
                $("#model").html(empty);
            }
        })
    }

    function getVariant()
        {
            var val =document.getElementById('model').value;
            $.ajax({
                url:'{{ url("admin/get_variant")}}',
                type:'GET',
                data:{val:val},
                dataType:'JSON',
                success:function(data){
                   // console.log(data);
                     var empty = '';
                empty += '<option value="">' + "Select Variant" + '</option>';
                $.each(data, function (index, value) {
                    empty += '<option value='+value.id+'>' + value.name + '</option>';
                });
                
                $("#variant").html(empty);
                }
            })
        }
</script>
@endsection