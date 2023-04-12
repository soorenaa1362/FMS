<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">هلدینگ فراز</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Card -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cards.index') }}">
            <i class="fas fa-money-check-alt"></i>
            <span>  حساب یا کارت بانکی </span>
        </a>
    </li>

    <!-- Nav Item - Income -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('incomes.index') }}">
            <i class="fas fa-hand-holding-usd"></i>
            <span> درآمد ها </span>
        </a>
    </li>

    <!-- Nav Item - Costs -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('costs.index') }}">
            <i class="fas fa-wallet"></i>
            <span> خرجکرد ها </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Reports -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="far fa-clipboard"></i>
            <span> گزارشات </span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('reports.day') }}">روزانه</a>
                <a class="collapse-item" href="#">هفتگی</a>
                <a class="collapse-item" href="#">ماهانه</a>
            </div>
        </div>
    </li> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
