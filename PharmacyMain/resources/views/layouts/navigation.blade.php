

<!-- /.sidebar -->
<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo">
                        <span>MyPharmacy</span>
                    </div>
                     <li class="label">Main</li>
                    <li><a href="{{ route('home') }}" class="nav-link"><i class="ti-home"></i> Dashboard</a>
                        
                    </li>
                <li class="label">dashboard</li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Invoice
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('manageInvoice')}}">Manage invoice</a></li>
                        <li><a href="{{url('invoice')}}">Invoice type</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Customer 
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('customer')}}">Manage customers</a></li>
                        <li><a href="{{url('creditCustomer')}}">Credit customers</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Medicine 
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ url('catagory')}}">Catagory</a></li>
                        <li><a href="{{ url('unit')}}">Unit</a></li>
                        <li><a href="{{ url('medicine')}}">Add medicine</a></li>
                        <li><a href="{{ url('manageMedicine')}}">Manage medicine</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Suppliers
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('manufacturer')}}">Manage suppliers</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Purchase
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ url('purchase') }}">Add purchase</a></li>
                        <li><a href="{{ url('managePurchase') }}">Manage purchase</a></li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Sales
                    <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ url('sales') }}">GUI sale</a></li>
                        <li><a href="{{ url('manageSales')}}">Manage sale</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('stock') }}" ><i class="ti-bar-chart-alt"></i> Stock
                    </a>
                    {{-- <ul>
                        <li><a >Flot</a></li>
                    </ul> --}}
                </li>
                
              
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->