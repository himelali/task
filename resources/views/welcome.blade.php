<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>URL Shortener</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    </head>
    <body class="mt-5">
        <section class="h-100">
            <div class="container h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body" id="app">
                                <shortener-component></shortener-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
