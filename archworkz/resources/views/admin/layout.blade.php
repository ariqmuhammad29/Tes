<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.metadata')
    @include('admin.partials.styles')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('admin.partials.navbar')
            @include('admin.partials.sidebar')
            
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('breadcrumb')
    @include('admin.partials.footer')
    @include('admin.partials.scripts')
</body>
</html>
