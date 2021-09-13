<!DOCTYPE html>
<html lang="en">

@include('fixed.head')

<body>

<!-- Navigation -->
@include('fixed.navigation')

<!-- Page Content -->

@yield('content')

<!-- Footer -->
@include('fixed.footer')

<!-- Bootstrap core JavaScript -->
@include('fixed.scripts')
<script type="text/javascript">
    const url = '{{url('/')}}';
    const urlCurrent = '{{URL::current()}}';
</script>
</body>

</html>
