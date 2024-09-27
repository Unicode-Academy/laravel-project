<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{ $pageTitle }} - Unicode Academy</title>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    @vite(['resources/sass/app.scss'])
    @yield('stylesheets')
</head>

<body>
    @include ('parts.clients.header')
    <main>
        @yield('content')
    </main>
    @include ('parts.clients.footer')
    @yield('scripts')
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var trialUrl = `{{ route('courses.data.trial') }}`;
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js"></script>
<script>
    //Datepicker
    $(".datepicker-1").datepicker({
        uiLibrary: "bootstrap5",
    });
    $(".datepicker-2").datepicker({
        uiLibrary: "bootstrap5",
    });
</script>
@if (\Request::route()->getName() === 'students.account.checkout')
    <script>
        let paymentDate = '{{ getCurrentPaymentDate() }}';
    </script>
@endif
@vite(['resources/js/app.js'])
@yield('scripts')

</html>
