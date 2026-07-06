<!DOCTYPE html>
<html lang="az" class="@if(session('theme') === 'dark') dark @endif">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BizCRM - {{ $__env->yieldContent('title', 'İdarəetmə Paneli') }}</title>

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
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        card: 'hsl(var(--card))',
                        'card-foreground': 'hsl(var(--card-foreground))',
                        primary: 'hsl(var(--primary))',
                        'primary-foreground': 'hsl(var(--primary-foreground))',
                        secondary: 'hsl(var(--secondary))',
                        'secondary-foreground': 'hsl(var(--secondary-foreground))',
                        muted: 'hsl(var(--muted))',
                        'muted-foreground': 'hsl(var(--muted-foreground))',
                        accent: 'hsl(var(--accent))',
                        'accent-foreground': 'hsl(var(--accent-foreground))',
                        destructive: 'hsl(var(--destructive))',
                        'destructive-foreground': 'hsl(var(--destructive-foreground))',
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                    },
                    borderRadius: {
                        lg: 'var(--radius)',
                        md: 'calc(var(--radius) - 2px)',
                        sm: 'calc(var(--radius) - 4px)',
                    },
                    boxShadow: {
                        soft: '0 1px 2px 0 rgb(0 0 0 / 0.04), 0 1px 3px 0 rgb(0 0 0 / 0.06)',
                        card: '0 2px 8px -2px rgb(0 0 0 / 0.06), 0 1px 3px -1px rgb(0 0 0 / 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --background: 240 20% 98.5%;
            --foreground: 224 24% 14%;
            --card: 0 0% 100%;
            --card-foreground: 224 24% 14%;
            --primary: 243 75% 59%;
            --primary-foreground: 0 0% 100%;
            --secondary: 240 15% 95%;
            --secondary-foreground: 224 24% 14%;
            --muted: 240 15% 95.5%;
            --muted-foreground: 224 10% 46%;
            --accent: 243 60% 96%;
            --accent-foreground: 243 75% 45%;
            --destructive: 0 72% 51%;
            --destructive-foreground: 0 0% 100%;
            --border: 224 15% 90%;
            --input: 224 15% 90%;
            --ring: 243 75% 59%;
            --radius: 0.75rem;
        }
        .dark {
            --background: 224 28% 8%;
            --foreground: 210 20% 96%;
            --card: 224 24% 11%;
            --card-foreground: 210 20% 96%;
            --primary: 243 80% 68%;
            --primary-foreground: 224 28% 8%;
            --secondary: 224 20% 16%;
            --secondary-foreground: 210 20% 96%;
            --muted: 224 20% 15%;
            --muted-foreground: 220 12% 65%;
            --accent: 224 20% 17%;
            --accent-foreground: 243 80% 78%;
            --destructive: 0 63% 42%;
            --destructive-foreground: 210 20% 96%;
            --border: 224 18% 18%;
            --input: 224 18% 18%;
            --ring: 243 80% 68%;
        }
        * { border-color: hsl(var(--border)); }
        html, body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        body { background: hsl(var(--background)); color: hsl(var(--foreground)); }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: hsl(var(--border)); border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: hsl(var(--muted-foreground) / 0.4); }

        .brand-logo {
            background: linear-gradient(135deg, hsl(243 85% 66%), hsl(258 70% 55%));
        }
        .nav-link { position: relative; transition: all .15s ease; }
        .nav-link:hover:not(.nav-active) { transform: translateX(2px); }
        .nav-active {
            background: linear-gradient(135deg, hsl(243 85% 66%), hsl(258 75% 58%));
            color: white !important;
            box-shadow: 0 4px 12px -2px hsl(243 75% 59% / 0.35);
        }
        .card-hover { transition: box-shadow .2s ease, transform .2s ease; }
        .card-hover:hover { box-shadow: 0 4px 16px -4px rgb(0 0 0 / 0.10); }

        .kanban-card { cursor: grab; transition: all 0.2s; }
        .kanban-card:active { cursor: grabbing; }
        .kanban-card.dragging { opacity: 0.5; }
        .kanban-column.drag-over { background: hsl(var(--accent)); }

        table thead th { letter-spacing: .02em; text-transform: uppercase; font-size: .68rem; }
        table tbody tr { transition: background-color .12s ease; }
        table tbody tr:hover { background: hsl(var(--accent) / 0.5); }

        button, .btn, a.btn { transition: all .15s ease; }
        input, select, textarea { transition: box-shadow .15s ease, border-color .15s ease; }
        input:focus, select:focus, textarea:focus { box-shadow: 0 0 0 3px hsl(var(--ring) / 0.18); }
    </style>
</head>
<body class="bg-background text-foreground overflow-x-hidden antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-64 flex-col border-r bg-card h-screen sticky top-0">
            <div class="flex h-16 items-center gap-2.5 border-b px-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl brand-logo text-white font-bold text-base shadow-soft">B</div>
                <span class="text-lg font-extrabold tracking-tight">BizCRM</span>
            </div>
            <nav class="flex-1 space-y-1 p-3 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'dashboard', 'label' => 'İdarəetmə paneli', 'icon' => '📊'],
                        ['route' => 'companies', 'label' => 'Şirkətlər', 'icon' => '🏢'],
                        ['route' => 'clients.index', 'label' => 'Müştərilər', 'icon' => '👥'],
                        ['route' => 'pipeline', 'label' => 'Pipeline', 'icon' => '📋'],
                        ['route' => 'services', 'label' => 'Xidmətlər', 'icon' => '🔧'],
                        ['route' => 'sales', 'label' => 'Satış paneli', 'icon' => '📈'],
                        ['route' => 'expenses', 'label' => 'Xərclər', 'icon' => '💰'],
                        ['route' => 'follow-ups', 'label' => 'Geri dönüşlər', 'icon' => '📅'],
                        ['route' => 'users', 'label' => 'İstifadəçilər', 'icon' => '👤'],
                        ['route' => 'settings', 'label' => 'Tənzimləmələr', 'icon' => '⚙️'],
                    ];
                @endphp
                @foreach ($navItems as $item)
                    @php $active = request()->routeIs($item['route']) || request()->routeIs(str_replace('.', '_', $item['route']) . '*'); @endphp
                    <a href="{{ route($item['route']) }}" class="nav-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ $active ? 'nav-active' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                        <span class="text-base">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-3 border-t">
                <div class="rounded-lg bg-accent/60 px-3 py-2.5 text-xs text-muted-foreground">
                    <span class="font-semibold text-accent-foreground">BizCRM</span> · v2.0
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="sticky top-0 z-30 flex h-16 items-center gap-4 border-b bg-card/95 backdrop-blur px-4 md:px-6">
                <div class="flex items-center gap-2 md:hidden">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg brand-logo text-white font-bold text-sm">B</div>
                </div>
                <form action="{{ route('company.filter') }}" method="POST" class="flex items-center gap-3 flex-1">
                    @csrf
                    <select name="company_id" onchange="this.form.submit()" class="h-10 w-48 rounded-lg border border-input bg-background px-3 py-2 text-sm hidden md:flex">
                        <option value="">Bütün şirkətlər</option>
                        @foreach(\App\Models\Company::orderBy('company_name')->get() as $c)
                            <option value="{{ $c->id }}" @if(session('selected_company_id') === $c->id) selected @endif>{{ $c->company_name }}</option>
                        @endforeach
                    </select>
                </form>
                <button onclick="document.documentElement.classList.toggle('dark'); fetch('/toggle-theme')" class="p-2 rounded-lg hover:bg-accent transition-colors">🌙</button>
                <button class="p-2 rounded-lg hover:bg-accent transition-colors">🔔</button>
                <div class="flex items-center gap-2">
                    <div class="hidden md:flex items-center gap-2 pl-2 border-l">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full brand-logo text-white text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-sm leading-tight">
                            <div class="font-semibold">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-muted-foreground">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-sm rounded-lg hover:bg-accent border">Çıxış</button>
                    </form>
                </div>
            </header>
            <main class="flex-1 p-4 pb-24 md:p-6 md:pb-6 overflow-x-hidden">
                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-500/10 border border-green-500/20 p-3 text-sm text-green-600 flex items-center gap-2">
                        <span>✅</span>{{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 rounded-lg bg-red-500/10 border border-red-500/20 p-3 text-sm text-red-600 flex items-center gap-2">
                        <span>⚠️</span>{{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Mobile Nav -->
    <nav class="fixed bottom-0 left-0 right-0 z-40 flex border-t bg-card/95 backdrop-blur md:hidden shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        @php
            $mobileItems = [
                ['route' => 'dashboard', 'label' => 'Panel', 'icon' => '📊'],
                ['route' => 'clients.index', 'label' => 'Müştərilər', 'icon' => '👥'],
                ['route' => 'pipeline', 'label' => 'Pipeline', 'icon' => '📋'],
                ['route' => 'sales', 'label' => 'Satış', 'icon' => '📈'],
                ['route' => 'companies', 'label' => 'Şirkətlər', 'icon' => '🏢'],
            ];
        @endphp
        @foreach ($mobileItems as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}" class="flex flex-1 flex-col items-center gap-1 py-2 text-xs transition-colors {{ $active ? 'text-primary font-semibold' : 'text-muted-foreground' }}">
                <span class="text-lg">{{ $item['icon'] }}</span>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
    @yield('scripts')
</body>
</html>
