<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">Menu</li>
        @if(isset($activeMenu))
        {!! $menu->render('sidebar', $activeMenu) !!}
        @else
        {!! $menu->render('sidebar') !!}
        @endif
    </ul>
</section>