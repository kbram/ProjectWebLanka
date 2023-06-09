<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}" type="text/css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    {{-- sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- Ajax --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class=" dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>

<!--Bootstrap -->
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

<script>
    document.getElementById('contact_number').addEventListener('input', function(event) {
    var phoneNumber = event.target.value;
    var cleaned = phoneNumber.replace(/\D/g, '');
    var formattedPhoneNumber = formatPhoneNumber(cleaned);
    event.target.value = formattedPhoneNumber;
});

function formatPhoneNumber(phoneNumber) {
    if (phoneNumber.length > 10) {
        phoneNumber = phoneNumber.slice(0, 10);
    }

    var formatted = '';
    for (var i = 0; i < phoneNumber.length; i++) {
        if (i === 0) {
            formatted += '(';
        } else if (i === 3) {
            formatted += ') - ';
        } else if (i === 6) {
            formatted += ' - ';
        }
        formatted += phoneNumber.charAt(i);
    }
    return formatted;
}
</script>

