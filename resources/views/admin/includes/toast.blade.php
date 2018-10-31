@if(Session::has('message'))
    <script typeof="text/javascript">
        $(document).ready(function() {
            var level = "{{ Session::get('level', 'info') }}";

            switch (level) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        });
    </script>
@endif