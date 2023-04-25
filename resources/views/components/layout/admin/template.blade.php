<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GVSU') }}</title>
    @vite(['resources/scss/main.scss'])
    @stack('styles')
    @stack('scripts')
    <style>
        .db-layout {
            display: grid;
            gap: 1.5rem;
            grid-template-areas: "sidebar main";
            grid-template-columns: 250px auto;
        }

        .db-sidebar {
            grid-area: sidebar;
        }

        .db-main {
            grid-area: main;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">CMS 5</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="{{ (request()->is('admin/user*') ? 'nav-link active' : 'nav-link') }}" aria-current="page" href="">Users</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cms.admin.logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="db-layout">
            <aside class="db-sidebar">
                <strong>Side Menu Stuff</strong>
                <hr>
                <nav class="nav flex-column card">
                    <a @class([ 'nav-link' => true, 'active' => request()->is('admin/site*')]) href="{{ route('cms.admin.site.index') }}">
                        <span class="fa fa-globe"></span>
                        Sites
                    </a>
                    <a class="nav-link" href="#">
                        <span class="fa fa-question"></span>
                        CMS Help
                    </a>
                    <a class="nav-link">
                        <span class="fa fa-puzzle-piece"></span>
                        CMS Training
                    </a>
                    <a class="nav-link">
                        <span class="fa fa-check"></span>
                        User Agreement
                    </a>
                    <a class="nav-link">
                        <span class="fa fa-search"></span>
                        Admin Lookup
                    </a>
                    <a class="nav-link">
                        <span class="fa fa-file"></span>
                        Content Pending Approval
                    </a>
                </nav>


                
                @if ( CMS::getCustomMenu() )
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title">Custom Stuff Here</div>
                        <nav class="nav flex-column">
                            @foreach (CMS::getCustomMenu() as $group)
                                <strong>{{ $group['heading'] }}</strong>
                                @foreach ($group['urls'] as $item)
                                    <a class="nav-link" href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                                @endforeach
                            @endforeach
                        </nav>
                    </div>
                </div>
                @endif
            </aside>
            <main class="db-main">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
