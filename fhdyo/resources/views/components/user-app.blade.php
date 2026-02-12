<!DOCTYPE html>
<html lang="en">

<head>
    <title>FHDYO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-950">
    <main class="min-h-full grid place-items-center px-4 justify-center">
        {{ $slot }}
    </main>

    <script>
        // Add active state to buttons
        const buttons = document.querySelectorAll('aside button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(btn => {
                    btn.classList.remove('bg-indigo-50', 'text-indigo-600');
                    btn.classList.add('text-gray-500');
                });
                button.classList.remove('text-gray-500');
                button.classList.add('bg-indigo-50', 'text-indigo-600');
            });
        });
    </script>
</body>

</html>
