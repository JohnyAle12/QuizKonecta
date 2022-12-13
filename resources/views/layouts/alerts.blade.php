@if(session('success'))
  <script>
    setTimeout(function(){
      toastr.success("{{ session('success') }}", "Hola");
    }, 100);
  </script>
@endif

@if(session('danger'))
  <script>
    setTimeout(function(){
      toastr.error("{{ session('danger') }}", "Hola");
    }, 100);
  </script>
@endif

@if(session('info'))
  <script>
    setTimeout(function(){
      toastr.info("{{ session('info') }}", "Hola");
    }, 100);
  </script>
@endif

@if(session('warning'))
  <script>
    setTimeout(function(){
      toastr.warning("{{ session('warning') }}", "Hola");
    }, 100);
  </script>
@endif