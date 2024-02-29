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
                        <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li>
                <li> <a href="{{ route('data-merchant') }}">
                        <ion-icon name="storefront-sharp"></ion-icon>Data Merchant
                    </a>
                </li>
                <li> <a href="{{ route('produk') }}">
                        <ion-icon name="bag-handle-sharp"></ion-icon>Data Produk
                    </a>
                </li>
                <li> <a href="{{ route('kategori') }}">
                        <ion-icon name="list-sharp"></ion-icon>Data Kategori
                    </a>
                </li>
                <li> <a href="{{ route('informasi') }}">
                        <ion-icon name="information-sharp"></ion-icon>Data Informasi
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
                <li> <a href="{{ route('saldo-merchant') }}">
                        <ion-icon name="cash-sharp"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="#">
                        <ion-icon name="map-sharp"></ion-icon>Map Merchant

                    </a>
                </li>
                <li> <a href="#">
                        <ion-icon name="business-sharp"></ion-icon>Transaksi Merchant
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
                <li> <a href="#}">
                        <ion-icon name="newspaper-sharp"></ion-icon>Laporan Merchant
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
