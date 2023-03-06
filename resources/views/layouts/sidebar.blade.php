<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{route('dashboard.index')}}">Laundry</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{route('dashboard.index')}}">Ly</a>
    </div>
    <ul class="sidebar-menu">

      <li class="menu-header">Dashboard</li>
      <li class="{{ active('dashboard*') }}">
        <a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

      <li class="menu-header">Master</li>
      <li class="{{ active('outlet*')}}">
        <a class="nav-link" href="/outlet"><i class="fas fa-store"></i><span>Outlet</span></a>
      </li>
      <li class="{{ active('produk*')}}">
        <a class="nav-link" href="/produk"><i class="fas fa-boxes"></i><span>Produk</span></a>
      </li>
      <li class="{{ active('member*')}}">
        <a class="nav-link" href="/member"><i class="fas fa-users"></i><span>Member</span></a>
      </li>

      <li class="menu-header">Transaksi</li>
      <li class="{{ active('transaksi*')}}">
        <a class="nav-link" href="/transaksi"><i class="fas fa-calculator"></i><span>Transaksi</span></a>
      </li>

      <li class="menu-header">User</li>
      <li class="{{ active('user*') }}">
        <a class="nav-link" href="{{route('user.index')}}"><i class="fas fa-user"></i><span>User</span></a>
      </li>                  
    </ul>
  </aside>
</div>
