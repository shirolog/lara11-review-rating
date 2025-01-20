@if(session('success'))
    <script>
        swal("{{ session('success') }}", "", "success");
    </script>
@endif

@if(session('warning'))
    <script>
        swal("{{ session('warning') }}", "", "warning");
    </script>
@endif

@if(session('error'))
    <script>
        swal("{{ session('error') }}", "", "error");
    </script>
@endif
