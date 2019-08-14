@extends('layouts.admin_layout')

@section('content')
<?php
	$i=1;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center"><b>Create New Products</b></h3>
            <a href="{{url('admin/product')}}" class="float-right btn btn-danger">Back</a><br><br>
            <div>
                @if(Session::has('msg'))
                <p class="alert alert-info alert-dismissable" style="color:#000;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('msg') }}
                </p>
                @endif
            </div>
        </div>  
    </div>
    <form method="POST" autocomplete="off" action="{{url('admin/product')}}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                {{ csrf_field()}}
                
                   
                    <div class="form-group">
                        <label>Category Name<span>*</span></label>
                        <select name="category_id" id="category" class="form-control" required autofocus onchange="getModel()"> 
                            <option value="">Select Category</option>
                            @foreach($categorys as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                                      
                        </select>
                    </div>
                        <div class="form-group">
                        <label>Sub Category Name<span>*</span></label>
                        <select name="sub_category_id" id="sub_category" class="form-control" required autofocus onchange="getCategory()">             
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Product Short Description</label>
                        <textarea type="text" name="product_short_description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Long Description</label>
                        <textarea type="text" name="product_long_description" class="form-control" required></textarea>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Product Main Image</label>
                    <input type="file" name="product_image" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label> Minimum Five Cutting Images Upload<span>*</span></label>
                    <input type="file" name="image[]" class="form-control" multiple required>
                </div> -->
                
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary">
                    <a href="{{url('admin/product')}}" class="btn btn-danger">Cancel</a>
                    
                </div>    
            </div>
            <div class="col-md-4">
                
            </div>
        </div>      
    </form>
</div>
<script>
    function getModel()
    {
        var val =document.getElementById('category').value;
        $.ajax({
            url:'{{ url("admin/get_sub_category")}}',
            type:'GET',
            data:{val:val},
            dataType:'JSON',
            success:function(data){
               
                var empty = '';
                empty += '<option value="">' + "Select Sub Category" + '</option>';
                $.each(data, function (index, value) {
                    empty += '<option value='+value.id+'>' + value.sub_category_name + '</option>';
                });
                
                $("#sub_category").html(empty);
            }
        })
    }

 
</script>
@endsection
