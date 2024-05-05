<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-icon-2.png') }}" class="logo-icon"
                    alt="logo icon">
            </a>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" style="text-decoration: none">
                <h4 class="logo-text">{{ config('app.name', 'Laravel') }}</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon">
                    <ion-icon name="home-sharp"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Data Master</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="list-sharp"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('user') }}">
                        <ion-icon name="person-outline"></ion-icon>Data User
                    </a>
                </li>
                <li> <a href="{{ route('data-merchant') }}">
                        <ion-icon name="storefront-outline"></ion-icon>Data Merchant
                    </a>
                </li>
                <li> <a href="{{ route('maps') }}">
                        <ion-icon name="map-outline"></ion-icon>Map Merchant
                    </a>
                </li>
                <li> <a href="{{ route('produk') }}">
                        <ion-icon name="bag-handle-outline"></ion-icon>Data Produk
                    </a>
                </li>
                <li> <a href="{{ route('kategori') }}">
                        <ion-icon name="list-outline"></ion-icon>Data Kategori
                    </a>
                </li>
                <li> <a href="{{ route('informasi') }}">
                        <ion-icon name="information-outline"></ion-icon>Data Informasi
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="swap-horizontal-sharp"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('topup') }}">
                        <ion-icon name="wallet-outline"></ion-icon>Topup
                    </a>
                </li>
                <li> <a href="{{ route('saldo-merchant') }}">
                        <ion-icon name="wallet-outline"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="{{ route('cashout-merchant') }}">
                        <ion-icon name="cash-outline"></ion-icon>Cashout Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi-pembeli') }}">
                        <ion-icon name="business-outline"></ion-icon>Transaksi
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="newspaper"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('laporan-merchant') }}">
                        <ion-icon name="newspaper-outline"></ion-icon>Laporan Merchant
                    </a>
                </li>
                <li> <a href="{{ route('mutasi-merchant') }}">
                        <ion-icon name="archive-outline"></ion-icon>Mutasi Merchant
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
