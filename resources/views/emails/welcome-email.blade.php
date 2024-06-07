<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-lg mx-auto my-10 bg-white p-5 rounded-lg shadow-md">
        <div class="bg-yellow-400 p-4 rounded-t-lg">
            <h1 class="text-2xl font-bold text-gray-800">Hi {{ $user->name }} ! Welcome to {{ config('app.name') }}</h1>
        </div>
        <div class="p-4">
            <p class="text-gray-700 mt-2">We're excited to have you on board at {{ config('app.name') }}! Thank you for
                joining our community. We are dedicated to providing you with the best experience possible.</p>
            <p class="text-gray-700 mt-2">To get started, please visit your profile and update your information. If you
                have any questions, feel free to reach out to our support team.</p>
            <p class="text-gray-700 mt-2">Best regards,<br>The {{ config('app.name') }} Team</p>
            <div class="mt-4">
                <a href="{{ route('login') }}"
                    class="inline-block bg-yellow-400 text-gray-800 font-semibold py-2 px-4 rounded shadow-md hover:bg-yellow-300">Click
                    Here To Login</a>
            </div>
        </div>
        <div class="bg-gray-200 text-gray-600 text-center text-sm p-4 rounded-b-lg">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
