<!DOCTYPE html>
<html lang="az" class="@if(session('theme') === 'dark') dark @endif">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BizCRM - {{ $__env->yieldContent('title', 'İdarəetmə Paneli') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
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
                }
            }
        }
    </script>
    <style>
        :root {
            --background: 0 0% 100%;
            --foreground: 222.2 84% 4.9%;
            --card: 0 0% 100%;
            --card-foreground: 222.2 84% 4.9%;
            --primary: 221.2 83.2% 53.3%;
            --primary-foreground: 210 40% 98%;
            --secondary: 210 40% 96.1%;
            --secondary-foreground: 222.2 47.4% 11.2%;
            --muted: 210 40% 96.1%;
            --muted-foreground: 215.4 16.3% 46.9%;
            --accent: 210 40% 96.1%;
            --accent-foreground: 222.2 47.4% 11.2%;
            --destructive: 0 84.2% 60.2%;
            --destructive-foreground: 210 40% 98%;
            --border: 214.3 31.8% 91.4%;
            --input: 214.3 31.8% 91.4%;
            --ring: 221.2 83.2% 53.3%;
            --radius: 0.5rem;
        }
        .dark {
            --background: 222.2 84% 4.9%;
            --foreground: 210 40% 98%;
            --card: 222.2 84% 4.9%;
            --card-foreground: 210 40% 98%;
            --primary: 217.2 91.2% 59.8%;
            --primary-foreground: 222.2 47.4% 11.2%;
            --secondary: 217.2 32.6% 17.5%;
            --secondary-foreground: 210 40% 98%;
            --muted: 217.2 32.6% 17.5%;
            --muted-foreground: 215 20.2% 65.1%;
            --accent: 217.2 32.6% 17.5%;
            --accent-foreground: 210 40% 98%;
            --destructive: 0 62.8% 30.6%;
            --destructive-foreground: 210 40% 98%;
            --border: 217.2 32.6% 17.5%;
            --input: 217.2 32.6% 17.5%;
            --ring: 224.3 76.3% 48%;
        }
        * { border-color: hsl(var(--border)); }
        body { background: hsl(var(--background)); color: hsl(var(--foreground)); }
        .kanban-card { cursor: grab; transition: all 0.2s; }
        .kanban-card:active { cursor: grabbing; }
        .kanban-card.dragging { opacity: 0.5; }
        .kanban-column.drag-over { background: hsl(var(--accent)); }
    </style>
</head>
<body class="bg-background text-foreground overflow-x-hidden">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-64 flex-col border-r bg-card h-screen sticky top-0">
            <div class="flex h-16 items-center gap-2 border-b px-6">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-primary-foreground font-bold text-sm">B</div>
                <span class="text-lg font-bold">BizCRM</span>
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
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm font-medium transition-colors {{ $active ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">
                        <span class="text-base">{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="sticky top-0 z-30 flex h-16 items-center gap-4 border-b bg-card px-4 md:px-6">
                <form action="{{ route('company.filter') }}" method="POST" class="flex items-center gap-3 flex-1">
                    @csrf
                    <select name="company_id" onchange="this.form.submit()" class="flex h-10 w-48 rounded-md border border-input bg-background px-3 py-2 text-sm hidden md:flex">
                        <option value="">Bütün şirkətlər</option>
                        @foreach(\App\Models\Company::orderBy('company_name')->get() as $c)
                            <option value="{{ $c->id }}" @if(session('selected_company_id') === $c->id) selected @endif>{{ $c->company_name }}</option>
                        @endforeach
                    </select>
                </form>
                <button onclick="document.documentElement.classList.toggle('dark'); fetch('/toggle-theme')" class="p-2 rounded-md hover:bg-accent">🌙</button>
                <button class="p-2 rounded-md hover:bg-accent">🔔</button>
                <div class="flex items-center gap-2">
                    <div class="hidden md:block text-sm">
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-muted-foreground">{{ auth()->user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-sm rounded-md hover:bg-accent border">Çıxış</button>
                    </form>
                </div>
            </header>
            <main class="flex-1 p-4 pb-24 md:p-6 md:pb-6 overflow-x-hidden">
                @if(session('success'))
                    <div class="mb-4 rounded-md bg-green-500/10 border border-green-500/20 p-3 text-sm text-green-600">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 rounded-md bg-red-500/10 border border-red-500/20 p-3 text-sm text-red-600">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Mobile Nav -->
    <nav class="fixed bottom-0 left-0 right-0 z-40 flex border-t bg-card md:hidden">
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
            <a href="{{ route($item['route']) }}" class="flex flex-1 flex-col items-center gap-1 py-2 text-xs {{ $active ? 'text-primary' : 'text-muted-foreground' }}">
                <span class="text-lg">{{ $item['icon'] }}</span>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
    @yield('scripts')
</body>
</html>
