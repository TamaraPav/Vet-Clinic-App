<!DOCTYPE html>
<html lang="en">

@include('fixed.admin.head')

<body class="adminbody">
<div class="main>">
<!-- Navigation -->
@include('fixed.admin.navigation')

<!-- Page Content -->
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">
@yield('content')


        </div>
    </div>
</div>
<!-- Footer -->
@include('fixed.admin.footer')

<!-- Bootstrap core JavaScript -->
@include('fixed.admin.scripts')
<script type="text/javascript">
    const url = '{{url('/')}}';
    const urlCurrent = '{{URL::current()}}';
</script>
</div>
</body>

</html>
