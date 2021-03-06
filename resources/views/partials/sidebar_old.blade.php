            @include('partials.mobile_menu')

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
                                <li><a href="{{ route('auth.profile') }}"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a></li>
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
                                            <h6 class="message-title">Secutiry Updates</h6></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="themes/#">
                                        <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar3.jpg')}}"></div>
                                        <div class="message-content">
                                            <h6 class="message-from">Bekky Simpson</h6>
                                            <h6 class="message-title">Vacation Rentals</h6></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="themes/#">
                                        <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar4.jpg')}}"></div>
                                        <div class="message-content">
                                            <h6 class="message-from">Alice Priskon</h6>
                                            <h6 class="message-title">Payment Confirmation</h6></div>
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
                                            <h6 class="message-title">Account Update</h6></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="themes/#">
                                        <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar2.jpg')}}"></div>
                                        <div class="message-content">
                                            <h6 class="message-from">Phil Jones</h6>
                                            <h6 class="message-title">Secutiry Updates</h6></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="themes/#">
                                        <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar3.jpg')}}"></div>
                                        <div class="message-content">
                                            <h6 class="message-from">Bekky Simpson</h6>
                                            <h6 class="message-title">Vacation Rentals</h6></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="themes/#">
                                        <div class="user-avatar-w"><img alt="" src="{{asset('themes/img/avatar4.jpg')}}"></div>
                                        <div class="message-content">
                                            <h6 class="message-from">Alice Priskon</h6>
                                            <h6 class="message-title">Payment Confirmation</h6></div>
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
                    <li class="sub-header"><span>Main Menu</span></li>
                    <li class="{!! (url(route('dashboard')) == Request::url() OR Request::is('/*')) ? ' active' : '' !!}">
                        <a href="{{route('dashboard')}}">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layout"></div>
                            </div><span>Dashboard</span></a>
                    </li>
                    @if(user_info()->inRole('super-admin'))
                        <li class="{!! (url(route('audit-trail.index')) == Request::url() OR Request::is('audit-trail*')) ? ' active' : '' !!}">
                            <a href="{{route('audit-trail.index')}}">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-newspaper"></div>
                                </div><span>Audit Trail</span></a>
                        </li>
                        <li class="has-sub-menu {!! (Request::is('master*') OR Request::is('master')) ? ' active' : '' !!}">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layers"></div>
                                </div><span>Master</span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li class="{!! (url(route('company.index')) == Request::url() OR Request::is('master/company*')) ? ' active' : '' !!}">
                                            <a href="{{route('company.index')}}"><i class="fa fa-circle-o"></i><span>Company</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="has-sub-menu {!! (Request::is('user-management*') OR Request::is('user-management')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div><span>User Management</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-icon"><i class="os-icon os-icon-users"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('user.index')) == Request::url() OR Request::is('user-management/user*')) ? ' active' : '' !!}">
                                        <a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i><span>Register User</span></a>
                                    </li>
                                    <li class="{!! (url(route('role.index')) == Request::url() OR Request::is('user-management/role*')) ? ' active' : '' !!}">
                                        <a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i><span>Role User</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu {!! (Request::is('business*') OR Request::is('business')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-folder"></div>
                            </div><span>Business</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-folder"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('customer.index')) == Request::url() OR Request::is('business/customer*')) ? ' active' : '' !!}">
                                        <a href="{{route('customer.index')}}"><i class="fa fa-circle-o"></i><span>Customer</span></a>
                                    </li>
                                    <li class="{!! (url(route('supplier.index')) == Request::url() OR Request::is('business/supplier*')) ? ' active' : '' !!}">
                                        <a href=" {{ route('supplier.index') }} "><i class="fa fa-circle-o"></i><span>Supplier</span></a>
                                    </li>
                                    <li class="{!! (url(route('sales.index')) == Request::url() OR Request::is('business/sales*')) ? ' active' : '' !!}">
                                        <a href=" {{ route('sales.index') }} "><i class="fa fa-circle-o"></i><span>Sales Folder</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Invoice</span></a></li>
                                    <li class="{!! (url(route('lg.index')) == Request::url() OR Request::is('business/lg*')) ? ' active' : '' !!}">
                                        <a href="{{ route('lg.index') }}"><i class="fa fa-circle-o"></i><span>LG</span></a>
                                    </li>
                                    <li><a href="{{ route('inventory.index') }}"><i class="fa fa-circle-o"></i><span>Inventory</span></a></li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li class="{!! (url(route('delivery.index')) == Request::url() OR Request::is('business/delivery*')) ? ' active' : '' !!}">
                                        <a href=" {{ route('delivery.index') }} "><i class="fa fa-circle-o"></i><span>Delivery</span></a>
                                    </li>
                                    <li class="{!! (url(route('voucher.index')) == Request::url() OR Request::is('business/voucher*')) ? ' active' : '' !!}">
                                        <a href="{{ route('voucher.index') }}"><i class="fa fa-circle-o"></i><span>Voucher</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Visa</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Queue</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                    <li class="{!! (url(route('transaction.index')) == Request::url() OR Request::is('business/transaction*')) ? ' active' : '' !!}">
                                        <a href="{{ route('transaction.index') }}"><i class="fa fa-circle-o"></i><span>Transaction</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu {!! (Request::is('outbound*') OR Request::is('outbound')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-folder"></div>
                            </div><span>Outbound</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-folder"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('guide.index')) == Request::url() OR Request::is('outbound/guide*')) ? ' active' : '' !!}">
                                        <a href="{{ route('guide.index') }}"><i class="fa fa-circle-o"></i><span>Guide</span></a>
                                    </li>
                                    <li class="{!! (url(route('itin.index')) == Request::url() OR Request::is('outbound/itin*')) ? ' active' : '' !!}">
                                        <a href="{{ route('itin.index') }}"><i class="fa fa-circle-o"></i><span>Itin</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Folder</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Order</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Visa</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Avail</span></a></li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Queue</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Visa Rpt</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Delivery</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Allotment</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-file-text"></div>
                            </div><span>Hotel</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-file-text"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Hotel</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Enquiry</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Booking</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-box"></div>
                            </div><span>FIT</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-box"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Folder</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Availability</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>FIT Order</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Delivery</span></a></li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Invoice</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>LG</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Allotment</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-corner-left-up"></div>
                            </div><span>AR</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-corner-left-up"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Customer</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Invoice</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Misc. Inv.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Receipt</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Settlem't</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Rec. Vou.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Bank</span></a></li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Deposit</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Reminder</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Cr. Note</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Cr. Card</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Billing</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-agenda-1"></div>
                            </div><span>AP</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-agenda-1"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Supplier</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>LG</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Deposit</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>LG Delivery</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Pay-Req</span></a></li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Payment</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Petty. Cash</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Chq Print</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-delivery-box-2"></div>
                            </div><span>Settlement</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-delivery-box-2"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Deposit</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Settlem't</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Rec. Vou.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Payment</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Receipt</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu {!! (Request::is('gl*') OR Request::is('gl')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-star"></div>
                            </div><span>GL</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-star"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('account.index')) == Request::url() OR Request::is('gl/account*')) ? ' active' : '' !!}">
                                        <a href="{{ route('account.index') }}"><i class="fa fa-circle-o"></i><span>Account</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Journal</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Posting</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                    <li class="{!! (url(route('periodend.index')) == Request::url() OR Request::is('gl/periodend*')) ? ' active' : '' !!}">
                                        <a href="{{ route('periodend.index') }}"><i class="fa fa-circle-o"></i><span>Per. End</span></a>
                                    </li>
                                    <li class="{!! (url(route('jvperiod.index')) == Request::url() OR Request::is('gl/jvperiod*')) ? ' active' : '' !!}">
                                        <a href="{{route('jvperiod.index')}}"><i class="fa fa-circle-o"></i><span>JV Period</span></a>
                                    </li>
                                <!-- </ul>
                                <ul class="sub-menu"> -->
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Recon.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Bank Rec.</span></a></li>
                                    <li class="{!! (url(route('fx-trans.index')) == Request::url() OR Request::is('gl/fx-trans*')) ? ' active' : '' !!}">
                                        <a href="{{route('fx-trans.index')}}"><i class="fa fa-circle-o"></i><span>FX Trans.</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>BSP Rec.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Finance</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-wallet-loaded"></div>
                            </div><span>Refund</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Refund</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-cv-2"></div>
                            </div><span>Inventory</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-cv-2"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Inventory</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>LG Delivery</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>BSP Rec.</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu {!! (Request::is('budget*') OR Request::is('budget')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-bar-chart-stats-up"></div>
                            </div><span>Budget</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-bar-chart-stats-up"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('budget-rate.index')) == Request::url() OR Request::is('gl/budget-rate*')) ? ' active' : '' !!}">
                                        <a href="{{route('budget-rate.index')}}"><i class="fa fa-circle-o"></i><span>Budget Rate</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Ex. Rate</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu {!! (Request::is('internals*') OR Request::is('internals')) ? ' active' : '' !!}">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-mail"></div>
                            </div><span>Internal</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-mail"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li class="{!! (url(route('profile.index')) == Request::url() OR Request::is('gl/profile*')) ? ' active' : '' !!}">
                                        <a href="{{ route('profile.index') }}"><i class="fa fa-circle-o"></i><span>Profile</span></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Cash Adv.</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    {{--<li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div><span>TMIS</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-users"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Report</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>C. Report</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Rpt. Tool2.0</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>Dashboard</span></a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>All Rpt.</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-edit-32"></div>
                            </div><span>Interface</span></a>
                        <div class="sub-menu-w">
                            
                            <div class="sub-menu-icon"><i class="os-icon os-icon-edit-32"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i><span>BOS</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>--}}
                </ul>
            </div>