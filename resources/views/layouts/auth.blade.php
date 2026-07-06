<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizCRM - Giriş</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#6366f1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: {
                fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                colors: {
                background: 'hsl(240 20% 98.5%)', foreground: 'hsl(224 24% 14%)',
                card: 'hsl(0 0% 100%)', 'card-foreground': 'hsl(224 24% 14%)',
                primary: 'hsl(243 75% 59%)', 'primary-foreground': 'hsl(0 0% 100%)',
                muted: 'hsl(240 15% 95.5%)', 'muted-foreground': 'hsl(224 10% 46%)',
                border: 'hsl(224 15% 90%)', input: 'hsl(224 15% 90%)',
                ring: 'hsl(243 75% 59%)',
            }}}
        }
    </script>
    <style>
        html, body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .brand-logo { background: linear-gradient(135deg, hsl(243 85% 66%), hsl(258 70% 55%)); }
        input:focus { box-shadow: 0 0 0 3px hsl(243 75% 59% / 0.18); }
    </style>
</head>
<body class="bg-background antialiased">
    @yield('content')
</body>
</html>
