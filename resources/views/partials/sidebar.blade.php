            @include('partials.mobile_menu')

            <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
                <div class="logo-w">
                    <a class="logo" href="#">
                        <img class="img-responsive" style="width:80%;display:table;margin:auto;" alt="" src="{{ asset('themes/img/logo-big.png') }}">
                    </a>
                </div>
                <div class="logged-user-w avatar-inline">
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
                            </div><span>Master</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Master</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="{{route('company.index')}}">Company</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>User Management</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">User Management</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="{{route('user.index')}}">Register User</a></li>
                                    <li><a href="{{route('user.index')}}">Role User</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Business</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Business</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="{{route('customer.index')}}">Customer</a></li>
                                    <li><a href=" {{ route('supplier.index') }} ">Supplier</a></li>
                                    <li><a href=" {{ route('sales.create') }} ">Sales Folder</a></li>
                                    <li><a href="#">Invoice</a></li>
                                    <li><a href="#">LG</a></li>
                                    <li><a href="#">Inventory</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Voucher</a></li>
                                    <li><a href="#">Visa</a></li>
                                    <li><a href="#">Queue</a></li>
                                    <li><a href="#">Report</a></li>
                                    <li><a href="{{ route('transaction.index') }}">Transaction</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Outbound</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Outbound</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Guide</a></li>
                                    <li><a href="#">Itin</a></li>
                                    <li><a href="#">Folder</a></li>
                                    <li><a href="#">Order</a></li>
                                    <li><a href="#">Visa</a></li>
                                    <li><a href="#">Avail</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Queue</a></li>
                                    <li><a href="#">Visa Rpt</a></li>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Allotment</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Hotel</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Hotel</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Enquiry</a></li>
                                    <li><a href="#">Booking</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>FIT</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">FIT</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Folder</a></li>
                                    <li><a href="#">Availability</a></li>
                                    <li><a href="#">FIT Order</a></li>
                                    <li><a href="#">Delivery</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Invoice</a></li>
                                    <li><a href="#">LG</a></li>
                                    <li><a href="#">Allotment</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>AR</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">AR</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Customer</a></li>
                                    <li><a href="#">Invoice</a></li>
                                    <li><a href="#">Misc. Inv.</a></li>
                                    <li><a href="#">Receipt</a></li>
                                    <li><a href="#">Settlem't</a></li>
                                    <li><a href="#">Rec. Vou.</a></li>
                                    <li><a href="#">Bank</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Deposit</a></li>
                                    <li><a href="#">Reminder</a></li>
                                    <li><a href="#">Cr. Note</a></li>
                                    <li><a href="#">Cr. Card</a></li>
                                    <li><a href="#">Billing</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>AP</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">AP</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Supplier</a></li>
                                    <li><a href="#">LG</a></li>
                                    <li><a href="#">Deposit</a></li>
                                    <li><a href="#">LG Delivery</a></li>
                                    <li><a href="#">Pay-Req</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Payment</a></li>
                                    <li><a href="#">Petty. Cash</a></li>
                                    <li><a href="#">Chq Print</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Settlement</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Settlement</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Deposit</a></li>
                                    <li><a href="#">Settlem't</a></li>
                                    <li><a href="#">Rec. Vou.</a></li>
                                    <li><a href="#">Payment</a></li>
                                    <li><a href="#">Receipt</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>GL</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">GL</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Journal</a></li>
                                    <li><a href="#">Posting</a></li>
                                    <li><a href="#">Report</a></li>
                                    <li><a href="#">Per. End</a></li>
                                    <li><a href="#">JV Period</a></li>
                                </ul>
                                <ul class="sub-menu">
                                    <li><a href="#">Recon.</a></li>
                                    <li><a href="#">Bank Rec.</a></li>
                                    <li><a href="#">FX Trans.</a></li>
                                    <li><a href="#">BSP Rec.</a></li>
                                    <li><a href="#">Finance</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Refund</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Refund</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Refund</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Inventory</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Inventory</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Inventory</a></li>
                                    <li><a href="#">LG Delivery</a></li>
                                    <li><a href="#">BSP Rec.</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Budget</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Budget</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Budget</a></li>
                                    <li><a href="#">Ex. Rate</a></li>
                                    <li><a href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Internal</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Internal</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Profile</a></li>
                                    <li><a href="#">Cash Adv.</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>TMIS</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">TMIS</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">Report</a></li>
                                    <li><a href="#">C. Report</a></li>
                                    <li><a href="#">Rpt. Tool2.0</a></li>
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">All Rpt.</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layers"></div>
                            </div><span>Interface</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Interface</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="#">BOS</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>