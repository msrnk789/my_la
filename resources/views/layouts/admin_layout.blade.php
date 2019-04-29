<!doctype html>
<html>
<head>
    @include('includes.admin_head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
   <header class="app-header navbar admin_header">
      @include('includes.admin_header')
   </header>
   <div class="app-body">
      <div class="sidebar">
         @include('includes.admin_sidebar')
      </div> 
      @yield('content')
   </div>
   @include('includes.admin_footer')
     <!-- CoreUI and necessary plugins-->
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
    <script src="{{ asset('assets/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/pace-progress/pace.min.js')}}"></script>
    <script src="{{ asset('assets/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
   <!-- <script src="{{ asset('assets/chart.js/dist/Chart.min.js')}}"></script>-->
    <script src="{{ asset('assets/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script>
    <!-- include summernote css/js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.3.1.min.js"></script>
    <script src="{{ asset('admin/js/main.js')}}"></script>
    
    <script>
     $(document).ready(function(){
        $('#summernote').summernote({
           toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']]
            ]
        });

        $('#table').DataTable();
        $('#table1').DataTable();
        //success alert
        
       $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });   
       $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#success-alert").slideUp(500);
        });
     })
    </script>
</body>
</html>