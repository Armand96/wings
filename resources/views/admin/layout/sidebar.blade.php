<aside class="main-sidebar sidebar-primary elevation-4">

    {{-- Sidebar brand logo --}}
    <a class="brand-link" href="">
        <img src="{{ asset('/img/wings.png') }}" alt="WINGS" class="brand-image img-circle elevation-3"
            style="opacity:.8">

        <span class="brand-text font-weight-light text-dark">
            <b>Wings</b>
        </span>
    </a>

    {{-- Sidebar menu --}}
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.product') }}"
                        class="nav-link {{ route('admin.product') == URL::to('/')."/".Route::current()->uri ? 'bg-dark' : '' }}">
                        <i class="fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}"
                        class="nav-link {{ route('admin.reports') == URL::to('/')."/".Route::current()->uri ? 'bg-dark' : '' }}">
                        <i class="fas fa-clipboard"></i>
                        <p>Reports</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>

</aside>
