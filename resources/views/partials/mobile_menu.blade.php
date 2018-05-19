<div class="menu-mobile menu-activated-on-click color-scheme-dark">
    <div class="mm-logo-buttons-w">
        <a class="mm-logo" href="{{route('dashboard')}}"><img src="{{asset('themes/img/logo.png')}}"><span>{{env('APP_NAME')}}</span></a>
        <div class="mm-buttons">
            <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
        </div>
    </div>
    <div class="menu-and-user">
        <div class="logged-user-w">
            <div class="avatar-w"><img alt="" src="{{asset('themes/img/avatar1.jpg')}}"></div>
            <div class="logged-user-info-w">
                <div class="logged-user-name">Maria Gomez</div>
                <div class="logged-user-role">Administrator</div>
            </div>
        </div>
        
        <ul class="main-menu">
            <li class="selected">
                <a href="{{route('dashboard')}}">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layout"></div>
                    </div><span>Dashboard</span></a>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>User Management</span></a>
                <ul class="sub-menu">
                    <li><a href="{{route('user.index')}}">Register User</a></li>
                </ul>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Business</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="{{route('customer.index')}}">Customer</a></li>
                        <li><a href="">Sales Folder</a></li>
                        <li><a href="">Invoice</a></li>
                        <li><a href="">LG</a></li>
                        <li><a href="">Inventory</a></li>
                        <li><a href="">Delivery</a></li>
                        <li><a href="">Voucher</a></li>
                        <li><a href="">Visa</a></li>
                        <li><a href="">Queue</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Outbound</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Guide</a></li>
                        <li><a href="">Itin</a></li>
                        <li><a href="">Folder</a></li>
                        <li><a href="">Order</a></li>
                        <li><a href="">Visa</a></li>
                        <li><a href="">Avail</a></li>
                        <li><a href="">Queue</a></li>
                        <li><a href="">Visa Rpt</a></li>
                        <li><a href="">Delivery</a></li>
                        <li><a href="">Allotment</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Hotel</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Hotel</a></li>
                        <li><a href="">Enquiry</a></li>
                        <li><a href="">Booking</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>FIT</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Folder</a></li>
                        <li><a href="">Availability</a></li>
                        <li><a href="">FIT Order</a></li>
                        <li><a href="">Delivery</a></li>
                        <li><a href="">Invoice</a></li>
                        <li><a href="">LG</a></li>
                        <li><a href="">Allotment</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>AR</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Customer</a></li>
                        <li><a href="">Invoice</a></li>
                        <li><a href="">Misc. Inv.</a></li>
                        <li><a href="">Receipt</a></li>
                        <li><a href="">Settlem't</a></li>
                        <li><a href="">Rec. Vou.</a></li>
                        <li><a href="">Bank</a></li>
                        <li><a href="">Deposit</a></li>
                        <li><a href="">Reminder</a></li>
                        <li><a href="">Cr. Note</a></li>
                        <li><a href="">Cr. Card</a></li>
                        <li><a href="">Billing</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>AP</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Supplier</a></li>
                        <li><a href="">LG</a></li>
                        <li><a href="">Deposit</a></li>
                        <li><a href="">LG Delivery</a></li>
                        <li><a href="">Pay-Req</a></li>
                        <li><a href="">Payment</a></li>
                        <li><a href="">Petty. Cash</a></li>
                        <li><a href="">Chq Print</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Settlement</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Deposit</a></li>
                        <li><a href="">Settlem't</a></li>
                        <li><a href="">Rec. Vou.</a></li>
                        <li><a href="">Payment</a></li>
                        <li><a href="">Receipt</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>GL</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Account</a></li>
                        <li><a href="">Journal</a></li>
                        <li><a href="">Posting</a></li>
                        <li><a href="">Report</a></li>
                        <li><a href="">Per. End</a></li>
                        <li><a href="">JV Period</a></li>
                        <li><a href="">Recon.</a></li>
                        <li><a href="">Bank Rec.</a></li>
                        <li><a href="">FX Trans.</a></li>
                        <li><a href="">BSP Rec.</a></li>
                        <li><a href="">Finance</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Refund</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Refund</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Inventory</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Inventory</a></li>
                        <li><a href="">LG Delivery</a></li>
                        <li><a href="">BSP Rec.</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Budget</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Budget</a></li>
                        <li><a href="">Ex. Rate</a></li>
                        <li><a href="">Report</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Internal</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Profile</a></li>
                        <li><a href="">Cash Adv.</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>TMIS</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">Report</a></li>
                        <li><a href="">C. Report</a></li>
                        <li><a href="">Rpt. Tool2.0</a></li>
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">All Rpt.</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class="os-icon os-icon-layers"></div>
                    </div><span>Interface</span></a>
                <div class="sub-menu-w">
                    <ul class="sub-menu">
                        <li><a href="">BOS</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        
    </div>
</div>