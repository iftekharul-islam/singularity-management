<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'viser-x ecommerce') }}</title>
    <meta name="description" content="viser-x ecommerce">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
<!-- css of architecture ui admin panel -->
    <link rel="stylesheet" href="{{ asset('main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr.min.css') }}">
    <!-- Latest compiled and minified CSS -->
{{--    <link href="{{ asset('assets/select2.min.css') }}" rel="stylesheet" />--}}
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    @include('layouts.admin.partial.navbar')
    @include('layouts.admin.partial.ui_setting')

    <div class="app-main">
        @include('layouts.admin.partial.sidebar')

        <div class="app-main__outer">
            <div class="app-main__inner">
                @yield('content')
            </div>
            @include('layouts.admin.partial.footer')
        </div>
    </div>
</div>
<script src="{{asset('assets/scripts/main.js')}}"></script>
<!-- sweetalert2 js -->
<script src="{{ asset('assets/sweetalert2.min.js') }}"></script>
{{--<script src="{{ asset('assets/jquery/2.2.4/jquery.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/select2.min.js') }}"></script>--}}
<!-- Latest compiled and minified JavaScript -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>--}}


{{--{!! Toastr::message() !!}--}}
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
<script>
    $.fn.selectpicker.Constructor.BootstrapVersion = '4';
    $('.selectpicker').selectpicker();
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    function deleteData(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                document.getElementById('delete-form-' + id).submit();
                swalWithBootstrapButtons.fire({
                    title: 'Processing!',
                    text: 'Your file delete is on processing...',
                    icon: 'success',
                    timer: 1500,
                })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: 'Cancelled',
                    text: 'Your imaginary file is safe :)',
                    icon: 'error',
                    timer: 1500,
                })
            }
        });
    }
    function initMap() {
        const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
        {{--const myLatLng = { lat: {{ $outlet->latitude }}, lng: {{ $outlet->longitude }} };--}}
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Outlet Location",
        });
    }

    window.initMap = initMap;
</script>
<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
</body>
</html>
