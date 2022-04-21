<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @component('seo')
    @endcomponent

    @component('favicon')
    @endcomponent
</head>

<body>
    <div id="app"></div>

    <script>
        window.gigyaSettings = {
            apiKey: "{{ config('gigya.api_key') }}",
            modal: {!! json_encode(config('gigya.modal_settings')) !!}
        }
    </script>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
