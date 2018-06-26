{{-- @include('partials.mobile_menu') --}}

<div class="fixed-menu menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-click menu-has-selected-link">
    <div class="logo-w">
        <a class="logo" href="#">
            <img class="img-responsive" style="width:80%;display:table;margin:auto;" alt="" src="{{ asset('themes/img/logo-big.png') }}">
        </a>
    </div>
    <div class="logged-user-w avatar-inline" style="display:none;">
        <div class="logged-user-i">
            <div class="avatar-w"><img alt="" src="{{link_to_avatar(user_info('avatar'))}}"></div>
            <div class="logged-user-info-w">
                <div class="logged-user-name">{{ user_info('first_name') }}</div>
                <div class="logged-user-role">{{ str_replace('-',' ',user_info('company_role')) }}</div>
            </div>
            <div class="logged-user-toggler-arrow">
                <div class="os-icon os-icon-chevron-down"></div>
            </div>
            <div class="logged-user-menu color-style-bright">
                <div class="logged-user-avatar-info">
                    <div class="avatar-w"><img alt="" src="{{link_to_avatar(user_info('avatar'))}}"></div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">{{ user_info('first_name') }}</div>
                        <div class="logged-user-role">{{ str_replace('-',' ',user_info('company_role')) }}</div>
                    </div>
                </div>
                <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                <ul>
                    <li><a href="{{ route('auth.profile') }}"><i class="fa fa-circle-o-male-circle2"></i><span>Profile Details</span></a></li>
                    <li><a href="{{ route('auth.logout') }}"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="menu-actions" style="display:none;">
      
        <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right"><i class="os-icon os-icon-mail-14"></i>
            <div class="new-messages-count">12</div>
            <div class="os-dropdown light message-list">
                <ul>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar1.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">John Mayers</h6>
                                <h6 class="message-title">Account Update</h6></div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar2.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Phil Jones</h6>
                                <h6 class="message-title">Secutiry Updates</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar3.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Bekky Simpson</h6>
                                <h6 class="message-title">Vacation Rentals</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar4.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Alice Priskon</h6>
                                <h6 class="message-title">Payment Confirmation</h6>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
      
        <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-right"><i class="os-icon os-icon-ui-46"></i>
            <div class="os-dropdown">
                <div class="icon-w"><i class="os-icon os-icon-ui-46"></i></div>
                <ul>
                    <li><a href="themes/users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a></li>
                    <li><a href="themes/users_profile_small.html"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a></li>
                    <li><a href="themes/users_profile_small.html"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a></li>
                    <li><a href="themes/users_profile_small.html"><i class="os-icon os-icon-ui-15"></i><span>Cancel Account</span></a></li>
                </ul>
            </div>
        </div>
      
        <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right"><i class="os-icon os-icon-zap"></i>
            <div class="new-messages-count">4</div>
            <div class="os-dropdown light message-list">
                <div class="icon-w"><i class="os-icon os-icon-zap"></i></div>
                <ul>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar1.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">John Mayers</h6>
                                <h6 class="message-title">Account Update</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar2.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Phil Jones</h6>
                                <h6 class="message-title">Secutiry Updates</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar3.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Bekky Simpson</h6>
                                <h6 class="message-title">Vacation Rentals</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="themes/#">
                            <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar4.jpg')}}"></div>
                            <div class="message-content">
                                <h6 class="message-from">Alice Priskon</h6>
                                <h6 class="message-title">Payment Confirmation</h6>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="element-search autosuggest-search-activator" style="display:none;">
        <input placeholder="Start typing to search..." type="text">
    </div>
    <h1 class="menu-page-header">Page Header</h1>
    <ul class="main-menu">
        <li class="selected">
            <a href="dashboard-sabre.html">
                <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <!--<li class="sub-header"><span>Business</span></li>-->
        <li class=" has-sub-menu">
            <a href="apps_bank.html">
                <div class="icon-w">
                    <div class="os-icon os-icon-user"></div>
                </div>
                <span>User Management</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-package"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Register User</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o-check"></i><span>Role User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-folder"></div>
                </div>
                <span>Business</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-file-text"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Sales</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Delivery</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Visa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Queue</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Report</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Outbond</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Tour Folder</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Tour Order</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Visa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Availability</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Queue</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Delivery</span>
                            </a>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>Report</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Visa Report</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-box"></div>
                </div>
                <span>Hotel</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Enquiry</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Booking</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Report</span>
                            </a>
                        </li>                                   
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-corner-left-up"></div>
                </div>
                <span>FIT</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>FIT Folder</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Availability</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Delivery</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Report</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-agenda-1"></div>
                </div>
                <span>Accounting</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Misc Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Credit Note</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Billing</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>LG</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>LG Delivery</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Pay Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Petty Cash</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Report</span>
                            </a>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>Settlement</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Deposit</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Settlement</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Receipt</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Receipt Voucher</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Payment</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>General Ledger</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Journal</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Posting</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Period End</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>JV Period</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Reconciliation</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Bank Reconciliation</span>
                                            </a>
                                        </li><li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>BSP Reconciliation</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Refund</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Budget</span>
                            </a>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>Report</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Receipt Enquiry</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-delivery-box-2"></div>
                </div>
                <span>Finance</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Invoice</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>L/G</span>
                            </a>
                        </li><li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Financial Analysis</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Cheque Printing</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Bank Deposit</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Deposit</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="has-sub-menu {!! (Request::is('business*') OR Request::is('business')) ? ' active' : '' !!}">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-folder"></div>
                </div><span>Master Data</span></a>
            <div class="sub-menu-w">
                
                <div class="sub-menu-icon"><i class="os-icon os-icon-folder"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li class="{!! (url(route('customer.index')) == Request::url() OR Request::is('business/customer*')) ? ' active' : '' !!}">
                            <a href="{{route('customer.index')}}"><i class="fa fa-circle-o"></i><span>Customer</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i><span>Hotel</span></a>
                        </li>
                        <li class="{!! (url(route('supplier.index')) == Request::url() OR Request::is('business/supplier*')) ? ' active' : '' !!}">
                            <a href=" {{ route('supplier.index') }} "><i class="fa fa-circle-o"></i><span>Supplier</span></a>
                        </li>
                        <li>
                            <a href="{{ route('inventory.index') }}"><i class="fa fa-circle-o"></i><span>Inventory</span></a>
                        </li>
                        <li class="{!! (url(route('voucher.index')) == Request::url() OR Request::is('business/voucher*')) ? ' active' : '' !!}">
                            <a href="{{ route('voucher.index') }}"><i class="fa fa-circle-o"></i><span>Voucher</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-circle-o"></i><span>Tour Guide</span></a>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>Outbound</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Guide</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Itinerary</span>
                                            </a>
                                        </li><li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Air Allotment</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                        <li class="sub-submenu">
                            <a>
                                <i class="fa fa-circle-o"></i><span>Accounting Setup</span><i class="arrow-third-menu os-icon os-icon-chevron-down"></i>
                            </a>
                            <div class="sub-menu-w third-menu">
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>FX Transaction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Budget Rate</span>
                                            </a>
                                        </li><li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i><span>Account</span>
                                            </a>
                                        </li>
                                    <ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Credit Card</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class=" has-sub-menu">
            <a href="#">
                <div class="icon-w">
                    <div class="os-icon os-icon-star"></div>
                </div>
                <span>System</span>
            </a>
            <div class="sub-menu-w">
                <div class="sub-menu-icon"><i class="os-icon os-icon-life-buoy"></i></div>
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Role</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>Permission</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i><span>System Config</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>