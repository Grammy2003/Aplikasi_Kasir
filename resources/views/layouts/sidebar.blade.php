<div class="sidebar-wrapper">
    <!-- Header Image -->
    <br>
    <div class="sidebar-header text-center">
        <img src="{{ asset('assets/img/Storeg.png') }}" alt="Logo" class="img-fluid" style="max-width: 80%; margin: 10px auto;">
    </div>

    <ul class="nav">
        <li class="active">
            <a href="/home">
                <i class="nc-icon nc-layout-11"></i>
                <p>Dashboard</p>
            </a>
        </li>

        @if(Auth::user()->role == 'admin')
            <li>
                <a href="/suppliers">
                    <i class="nc-icon nc-box-2"></i>
                    <p>Suppliers</p>
                </a>
            </li>

            <li>
                <a href="/categories">
                    <i class="nc-icon nc-tag-content"></i>
                    <p>Categories</p>
                </a>
            </li>

            <li>
                <a href="/pelanggans">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Pelanggans</p>
                </a>
            </li>

            <!-- Show 'Satuans' link only for admin -->
            <li>
                <a href="/satuans">
                    <i class="nc-icon nc-box" style="font-size: 24px; color: #28a745;"></i>  <!-- Box Icon -->
                    <p>satuans</p>
                </a>
            </li>
        @endif

        <li>
            <a href="/products">
                <i class="nc-icon nc-cart-simple"></i>
                <p>Products</p>
            </a>
        </li>

        <li>
            <a href="/transaksi_penjualans">
                <i class="nc-icon nc-money-coins"></i>
                <p>Transaksi Penjualan</p>
            </a>
        </li>

        @if(in_array(Auth::user()->role, ['admin', 'kasir']))
            <li>
                <a href="/laporan-penjualan">
                    <i class="nc-icon nc-money-coins"></i>
                    <p>Laporan Penjualan</p>
                </a>
            </li>
        @endif

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100 text-start">
                    <i class="nc-icon nc-button-power"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
</div>
<div class="main-panel">
