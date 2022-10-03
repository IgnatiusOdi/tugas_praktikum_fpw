<!DOCTYPE html>
<html lang="en" data-theme="garden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | iH - class</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.31.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @if (Session::has('message'))
        <div class="toast toast-top toast-end">
            <div class="alert alert-error shadow-lg">
                <div>
                    <span>{{ Session::get('message') }}</span>
                </div>
            </div>
        </div>
    @elseif (Session::has('success'))
        <div class="toast toast-top toast-end">
            <div class="alert alert-success shadow-lg">
                <div>
                    <span>{{ Session::get('success') }}</span>
                </div>
            </div>
        </div>
    @endif
    @yield('main')
</body>

</html>
