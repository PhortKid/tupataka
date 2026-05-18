<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="/" target="_blank">
            <img src="/favicon.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark"> Mazingira </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-dark" aria-controls="ProfileNav" role="button" aria-expanded="false">
                    <img src="https://static.vecteezy.com/system/resources/previews/026/630/551/non_2x/profile-icon-symbol-design-illustration-vector.jpg" class="avatar">
                    <span class="nav-link-text ms-2 ps-1"> {{ucfirst(Auth::user()->firstname) }} {{ucfirst(Auth::user()->lastname) }} </span>
                </a>
                <div class="collapse" id="ProfileNav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/profile">
                                <span class="sidenav-mini-icon"> MP </span>
                                <span class="sidenav-normal ms-3 ps-1"> My Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/settings">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal ms-3 ps-1"> Settings </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/logout">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal ms-3 ps-1"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal dark mt-0">
            
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="/" class="nav-link text-dark">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1 ps-1">Dashboard</span>
                </a>
            </li>

            <!-- Master Control -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#masterControl" class="nav-link text-dark" aria-controls="masterControl" role="button" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">manage_accounts</i>
                    <span class="nav-link-text ms-1 ps-1">Master Control</span>
                </a>
                <div class="collapse" id="masterControl">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/users_management">
                                <span class="sidenav-mini-icon"> UM </span>
                                <span class="sidenav-normal ms-1 ps-1"> User Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/staff">
                                <span class="sidenav-mini-icon"> SM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Staff Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/weo_staff_management">
                                <span class="sidenav-mini-icon"> WM </span>
                                <span class="sidenav-normal ms-1 ps-1"> WEO Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/vehicle">
                                <span class="sidenav-mini-icon"> VM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Vehicle Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/region_management">
                                <span class="sidenav-mini-icon"> LM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Location Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/designation">
                                <span class="sidenav-mini-icon"> DM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Designation Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/expense_category">
                                <span class="sidenav-mini-icon"> EC </span>
                                <span class="sidenav-normal ms-1 ps-1"> Expenses Category </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/payee">
                                <span class="sidenav-mini-icon"> PM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Payee Management </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/pettycashsource">
                                <span class="sidenav-mini-icon"> CS </span>
                                <span class="sidenav-normal ms-1 ps-1"> Cash Source </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/business_activity">
                                <span class="sidenav-mini-icon"> BM </span>
                                <span class="sidenav-normal ms-1 ps-1"> Business Type </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Customer Control -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#customerControl" class="nav-link text-dark" aria-controls="customerControl" role="button" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">groups</i>
                    <span class="nav-link-text ms-1 ps-1">Customer Control</span>
                </a>
                <div class="collapse" id="customerControl">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/regular_customers">
                                <span class="sidenav-mini-icon"> RC </span>
                                <span class="sidenav-normal ms-1 ps-1"> Regular Customer </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/irregular_customers">
                                <span class="sidenav-mini-icon"> IC </span>
                                <span class="sidenav-normal ms-1 ps-1"> Irregular Customer </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/bills">
                                <span class="sidenav-mini-icon"> VC </span>
                                <span class="sidenav-normal ms-1 ps-1"> Verified Customer's </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Accounting -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#accounting" class="nav-link text-dark" aria-controls="accounting" role="button" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">request_quote</i>
                    <span class="nav-link-text ms-1 ps-1">Accounting</span>
                </a>
                <div class="collapse" id="accounting">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/pettycashsource">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal ms-1 ps-1"> Petty Cash Source </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/expenses">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal ms-1 ps-1"> Petty Expenses </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Vehicle -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#vehicleMenu" class="nav-link text-dark" aria-controls="vehicleMenu" role="button" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">local_shipping</i>
                    <span class="nav-link-text ms-1 ps-1">Vehicle</span>
                </a>
                <div class="collapse" id="vehicleMenu">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/fuel_station">
                                <span class="sidenav-mini-icon"> FS </span>
                                <span class="sidenav-normal ms-1 ps-1"> Fuel Station </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/fuel_rate">
                                <span class="sidenav-mini-icon"> FR </span>
                                <span class="sidenav-normal ms-1 ps-1"> Fuel Rate </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/fuel_issues">
                                <span class="sidenav-mini-icon"> FI </span>
                                <span class="sidenav-normal ms-1 ps-1"> Fuel Issues </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/truck_services">
                                <span class="sidenav-mini-icon"> TS </span>
                                <span class="sidenav-normal ms-1 ps-1"> Truck Services </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#reports" class="nav-link text-dark" aria-controls="reports" role="button" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">insights</i>
                    <span class="nav-link-text ms-1 ps-1">Reports</span>
                </a>
                <div class="collapse" id="reports">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/tcb/transactions">
                                <span class="sidenav-mini-icon"> RT </span>
                                <span class="sidenav-normal ms-1 ps-1"> TCB Collection Receipts </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <span class="sidenav-mini-icon"> RT </span>
                                <span class="sidenav-normal ms-1 ps-1"> Customer Statement </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <span class="sidenav-mini-icon"> RT </span>
                                <span class="sidenav-normal ms-1 ps-1"> Report 3 </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>