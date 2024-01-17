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
                <h4 class="logo-text">Taniline</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto">
            <ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::user()->level==1)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('perusahaan') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>Perusahaan
                    </a>
                </li>
                <!-- <li> <a href="#">
                        <ion-icon name="ellipse-outline"></ion-icon>Data Admin Perusahaan
                    </a>
                </li> -->
                <li> <a href="{{ route('usercard') }}">
                    <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li>
                <!-- <li> <a href="{{ route('bank') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>Data Bank
                    </a>
                </li> -->
                <li> <a href="{{ route('kategoriuser') }}">
                    <ion-icon name="people-sharp"></ion-icon>Data Kategori User
                    </a>
                </li>
                <li> <a href="{{ route('device') }}">
                    <ion-icon name="desktop-sharp"></ion-icon>Data Device
                    </a>
                </li>

                <li> <a href="{{ route('merchant') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Merchant
                    </a>
                </li>
                <li> <a href="{{ route('jenis_tagihan') }}">
                    <ion-icon name="card-sharp"></ion-icon>Data Jenis Tagihan
                    </a>
                </li> 
                <li> <a href="{{ route('informasi') }}">
                    <ion-icon name="information-sharp"></ion-icon>Informasi
                    </a>
                </li> 
                <li> <a href="{{ route('history_sehat') }}">
                    <ion-icon name="medkit-sharp"></ion-icon>Data Kesehatan
                    </a>
                </li> 
                <li> <a href="{{ route('lembaga') }}">
                    <ion-icon name="library-sharp"></ion-icon>Data Lembaga
                    </a>
                </li> 
                <!-- <li> <a href="widgets-data-widgets.html">
                        <ion-icon name="ellipse-outline"></ion-icon>Data Kartu
                    </a>
                </li> -->
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('master_tagihan') }}">
                    <ion-icon name="albums"></ion-icon>Master Tagihan
                    </a>
                </li>
                </li>
                <li> <a href="{{ route('tagihan_user') }}">
                    <ion-icon name="calendar-sharp"></ion-icon>Cek Tagihan User
                    </a>
                </li>
                <li> <a href="{{ route('saldousercard') }}">
                    <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
                </li>
                <li> <a href="{{ route('saldo_merchant') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_merchant') }}">
                    <ion-icon name="swap-horizontal-sharp"></ion-icon>Transaksi Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_pembayaran') }}">
                    <ion-icon name="swap-vertical-sharp"></ion-icon>Transaksi Pembayaran
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('mutasi_rekening') }}">
                    <ion-icon name="newspaper"></ion-icon>Mutasi Rekening
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_merchant') }}">
                    <ion-icon name="documents"></ion-icon>Mutasi Rekening Merchant
                    </a>
                </li>
            </ul>
            <!-- <ul>
                <li> <a href="{{ route('laporan_pembayaran_user') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>Laporan Pembayaran User
                    </a>
                </li>
            </ul> -->
        </li>
        @elseif(Auth::user()->level==2)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('perusahaan_admin') }}">
                    <ion-icon name="business-sharp"></ion-icon>Data Perusahaan
                    </a>
                </li>
                <!-- <li> <a href="{{ route('bank_admin') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>Data Bank
                    </a>
                </li> -->
                <li> <a href="{{ route('usercardadmin') }}">
                    <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li>
                <li> <a href="{{ route('kategoriuseradmin') }}">
                    <ion-icon name="people-sharp"></ion-icon>Data Kategori User
                    </a>
                </li>
                <li> <a href="{{ route('device_admin') }}">
                    <ion-icon name="desktop-sharp"></ion-icon>Data Device
                    </a>
                </li>
                <li> <a href="{{ route('merchantadmin') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Merchant
                    </a>
                </li>
                <li> <a href="{{ route('jenis_tagihan_admin') }}">
                    <ion-icon name="card-sharp"></ion-icon>Data Jenis Tagihan
                    </a>
                </li>
                <li> <a href="{{ route('informasi_admin') }}">
                    <ion-icon name="information-sharp"></ion-icon>Informasi
                    </a>
                </li>
                <li> <a href="{{ route('history_sehat_admin') }}">
                    <ion-icon name="medkit-sharp"></ion-icon>Data Kesehatan
                    </a>
                </li>
                <li> <a href="{{ route('lembaga_admin') }}">
                    <ion-icon name="library-sharp"></ion-icon>Data Lembaga
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
       
                <li> <a href="{{ route('data.topup') }}">
                    <ion-icon name="wallet-sharp"></ion-icon>Data Topup
                </a>
                <li> <a href="{{ route('pencairan.usercard') }}">
                    <ion-icon name="reader"></ion-icon>Pencairan User Card
                </a>
                <li> <a href="{{ route('pencairan.merchant') }}">
                    <ion-icon name="receipt"></ion-icon>Pencairan Merchant
                </a>
                </li>
                <li> <a href="{{ route('master_tagihan_admin') }}">
                    <ion-icon name="albums"></ion-icon>Master Tagihan
                    </a>
                </li>
                <li> <a href="{{ route('tagihan_user_admin') }}">
                        <ion-icon name="calendar-sharp"></ion-icon>Cek Tagihan User
                    </a>
                </li>
                <li> <a href="{{ route('saldousercardadmin') }}">
                    <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
                </li>
                <li> <a href="{{ route('saldo_merchant_admin') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_merchant_admin') }}">
                    <ion-icon name="swap-horizontal-sharp"></ion-icon>Transaksi Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_pembayaran_admin') }}">
                    <ion-icon name="swap-vertical-sharp"></ion-icon>Transaksi Pembayaran
                    </a>
                </li>
                <li> <a href="{{ route('data.transaksi') }}">
                    <ion-icon name="swap-vertical-sharp"></ion-icon>Transaksi User
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('mutasi_rekening_admin') }}">
                    <ion-icon name="newspaper"></ion-icon>Mutasi Rekening
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_rekening_per_user') }}">
                    <ion-icon name="id-card"></ion-icon>Mutasi Rekening Per User
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_merchant_admin') }}">
                    <ion-icon name="documents"></ion-icon>Mutasi Rekening Merchant
                    </a>
                </li>
            </ul>
        </li>
        @elseif(Auth::user()->level==3)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('merchantmerchant') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Merchant
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('kas.keluar') }}">
                    <ion-icon name="wallet-sharp"></ion-icon>Kas Keluar
                </a>
                {{-- <li> <a href="{{ route('saldousercardadmin') }}">
                    <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
                </li> --}}
                <li> <a href="{{ route('saldo_merchant_merchant') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_merchant_merchant') }}">
                    <ion-icon name="swap-horizontal-sharp"></ion-icon>Transaksi Merchant
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                {{-- <li> <a href="{{ route('mutasi_rekening_merchant') }}">
                    <ion-icon name="newspaper"></ion-icon>Mutasi Rekening
                    </a>
                </li> --}}
                <li> <a href="{{ route('mutasi_merchantku') }}">
                    <ion-icon name="documents"></ion-icon>Mutasi Rekening Merchant
                    </a>
                </li>
            </ul>
        </li>
        @elseif(Auth::user()->level==5)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('usercardadmin') }}">
                    <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li>
                <li> <a href="{{ route('merchantadmin') }}">
                    <ion-icon name="storefront-sharp"></ion-icon>Data Merchant
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('pencairan.usercard') }}">
                    <ion-icon name="reader"></ion-icon>Pencairan User Card
                </a>
                <li> <a href="{{ route('pencairan.merchant') }}">
                    <ion-icon name="receipt"></ion-icon>Pencairan Merchant
                </a>
                </li>
                <li> <a href="{{ route('master_tagihan_admin') }}">
                    <ion-icon name="albums"></ion-icon>Master Tagihan
                    </a>
                </li>
                <li> <a href="{{ route('tagihan_user_admin') }}">
                    <ion-icon name="calendar-sharp"></ion-icon>Cek Tagihan User
                    </a>
                </li>
                <li> <a href="{{ route('saldousercardadmin') }}">
                    <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
                </li>
                <li> <a href="{{ route('saldo_merchant_admin') }}">
                    <ion-icon name="pricetags-sharp"></ion-icon>Saldo Merchant
                    </a>
                </li>
                <li> <a href="{{ route('transaksi_merchant_admin') }}">
                    <ion-icon name="swap-horizontal-sharp"></ion-icon>Transaksi Merchant
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('mutasi_rekening_admin') }}">
                    <ion-icon name="newspaper"></ion-icon>Mutasi Rekening
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_rekening_per_user') }}">
                    <ion-icon name="id-card"></ion-icon>Mutasi Rekening Per User
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_merchant_admin') }}">
                    <ion-icon name="documents"></ion-icon>Mutasi Rekening Merchant
                    </a>
                </li>
            </ul>
        </li>
        @elseif(Auth::user()->level==4)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('usercardadmin') }}">
                    <ion-icon name="person-sharp"></ion-icon>Data User
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
            <ul>
                <li> <a href="{{ route('tagihan_user_admin') }}">
                    <ion-icon name="calendar-sharp"></ion-icon>Cek Tagihan User
                    </a>
                </li>
                <li> <a href="{{ route('saldousercardadmin') }}">
                    <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="menu-title">Laporan</div>
            </a>
            <ul>
                <li> <a href="{{ route('mutasi_rekening_admin') }}">
                    <ion-icon name="newspaper"></ion-icon>Mutasi Rekening
                    </a>
                </li>
                <li> <a href="{{ route('mutasi_merchant_admin') }}">
                    <ion-icon name="documents"></ion-icon>Mutasi Rekening Merchant
                    </a>
                </li>
            </ul>
        </li>
        @elseif(Auth::user()->level==8)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
                <li> <a href="{{ route('informasi_admin') }}">
                    <ion-icon name="information-sharp"></ion-icon>Informasi
                    </a>
                </li>
            </ul>
        </li>
        @elseif(Auth::user()->level==10)
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
                    <ion-icon name="server-outline"></ion-icon>
                </div>
                <div class="menu-title">Data</div>
            </a>
            <ul>
            <li> <a href="{{ route('saldousercardadmin') }}">
                <ion-icon name="pricetag-sharp"></ion-icon>Saldo User
                    </a>
            </li>
            <li> <a href="{{ route('history_sehat_admin') }}">
                <ion-icon name="medkit-sharp"></ion-icon>Data Kesehatan
                    </a>
                </li> 
            </ul>
        </li>
        @endif
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->

