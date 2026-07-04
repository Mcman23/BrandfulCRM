<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BizCRM - Giriş</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: {
                background: 'hsl(0 0% 100%)', foreground: 'hsl(222.2 84% 4.9%)',
                card: 'hsl(0 0% 100%)', 'card-foreground': 'hsl(222.2 84% 4.9%)',
                primary: 'hsl(221.2 83.2% 53.3%)', 'primary-foreground': 'hsl(210 40% 98%)',
                muted: 'hsl(210 40% 96.1%)', 'muted-foreground': 'hsl(215.4 16.3% 46.9%)',
                border: 'hsl(214.3 31.8% 91.4%)', input: 'hsl(214.3 31.8% 91.4%)',
                ring: 'hsl(221.2 83.2% 53.3%)',
            }}}
        }
    </script>
</head>
<body class="bg-gray-50">
    @yield('content')
</body>
</html>
