<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            Smart Sklad
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                Приборная доска
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    Управление пользователями
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                Разрешения
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                Роли
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                Пользователи
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('ingredient_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.ingredients.index") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw fas fa-flask c-sidebar-nav-icon">

                    </i>
                    Ингредиенты
                </a>
            </li>
        @endcan
        @can('formula_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.formulas.index") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw fas fa-percentage c-sidebar-nav-icon">

                    </i>
                    Рецепт продукта
                </a>
            </li>
        @endcan
        @can('product_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw fas fa-cubes c-sidebar-nav-icon">

                    </i>
                    Продукты
                </a>
            </li>
        @endcan


        @can('report_access')
            <li class="c-sidebar-nav-dropdown ">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                    </i>
                    Отчеты
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income.index") }}" class="c-sidebar-nav-link">
                                <i class="fa-fw fas fa-calendar-plus c-sidebar-nav-icon">

                                </i>
                                Пополнения
                            </a>
                        </li>
                    @endcan
                    @can('outcome_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.outcome.index") }}" class="c-sidebar-nav-link">
                                <i class="fa-fw fas fa-calendar-minus c-sidebar-nav-icon">

                                </i>
                                Расходы
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('unit_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.global_units") }}" class="c-sidebar-nav-link">
                    <i class="fa-fw fas fa-balance-scale c-sidebar-nav-icon">

                    </i>
                    Единица измерения
                </a>
            </li>
        @endcan






        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        Изменить пароль
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                Выйти
            </a>
        </li>
    </ul>

</div>
