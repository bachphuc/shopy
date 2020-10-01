@php
    $menus = [
        [
        'title' => 'Dashboard',
        'icon' => 'dashboard',
        'url' => url('admin'),
        'key' => 'dashboard',
    ], [
        'title' => 'Orders',
        'icon' => 'dashboard',
        'url' => route('admin.orders.index'),
        'key' => 'orders',
    ], [
        'title' => 'Categories',
        'icon' => 'dashboard',
        'url' => route('admin.categories.index'),
        'key' => 'categories',
    ], [
        'title' => 'Products',
        'icon' => 'dashboard',
        'url' => route('admin.products.index'),
        'key' => 'products',
    ], [
        'title' => 'Customers',
        'icon' => 'dashboard',
        'url' => route('admin.customers.index'),
        'key' => 'customers',
    ], [
        'title' => 'Fields',
        'icon' => 'dashboard',
        'url' => route('admin.fields.index'),
        'key' => 'fields'
    ], [
        'title' => 'Settings',
        'icon' => 'dashboard',
        'url' => url('admin/settings'),
        'key' => 'settings'
    ]
];
@endphp

<ul class="nav">
    @if(isset($menus))
    @foreach($menus as $menu)
    <li class="{{(isset($activeMenu) && $menu['key'] == $activeMenu) || (!isset($activeMenu) && $menu['key'] == 'dashboard') ? 'active' : ''}}">
        @if(isset($menu['subs']) && !empty($menu['subs']))
        <a class="nav-link" data-toggle="collapse" href="#menu_item_collapse_{{$menu['key']}}" aria-expanded="true">
            <i class="material-icons">{{$menu['icon']}}</i>
            <p>{{$menu['title']}}<b class="caret"></b></p>
        </a>

        <div id="menu_item_collapse_{{$menu['key']}}" class="collapse" style="height : 0px;">
            <ul class="nav">
                @foreach($menu['subs'] as $subMenu)
                <li class="{{(isset($activeMenu) && $subMenu['key'] == $activeMenu) ? 'active' : ''}}">
                    <a href="{{isset($subMenu['url']) ? $subMenu['url'] : '#'}}">
                        <i class="material-icons">{{$subMenu['icon']}}</i>
                        <p>{{$subMenu['title']}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @else
        <a href="{{$menu['url']}}">
            <i class="material-icons">{{$menu['icon']}}</i>
            <p>{{$menu['title']}}</p>
        </a>
        @endif
    </li>
    @endforeach
    @endif
</ul>