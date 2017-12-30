@if(Session::has('succMessage'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Success'
                , text: '{{ Session::get("succMessage") }}'
                , position: 'bottom-right'
                , loaderBg: '#ff6849'
                , icon: 'success'
                , hideAfter: 3000
                , stack: 6
            })
        });
    </script>

@endif

@if(Session::has('errMessage'))
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Error'
                , text: '{{ Session::get("errMessage") }}'
                , position: 'bottom-right'
                , loaderBg: '#ff6849'
                , icon: 'error'
                , hideAfter: 3000
                , stack: 6
            })
        });
    </script>

@endif