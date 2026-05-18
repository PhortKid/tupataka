@extends('layout.app')

@section('content')
<!-- Row 1: Area Info -->
<div class="row mb-4">
    <!-- Users -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Users</p>
                        <h4 class="mb-0">{{ $users }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">people</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-primary font-weight-bolder">Total </span>system users</p>
            </div>
        </div>
    </div>

    <!-- Districts -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Districts</p>
                        <h4 class="mb-0">{{ $districts }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-danger shadow-danger shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">map</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">Total </span>districts</p>
            </div>
        </div>
    </div>

    <!-- Wards -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Wards</p>
                        <h4 class="mb-0">{{ $wards }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-warning shadow-warning shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">location_on</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-warning font-weight-bolder">Total </span>wards</p>
            </div>
        </div>
    </div>

    <!-- Streets -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Streets</p>
                        <h4 class="mb-0">{{ $streets }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-info shadow-info shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">add_road</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-info font-weight-bolder">Total </span>streets</p>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: Customer & Finance Info -->
<div class="row">
    <!-- Regular Customers -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Regular Customers</p>
                        <h4 class="mb-0">{{ $regularCustomers }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-success shadow-success shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">person_check</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Active </span>customers</p>
            </div>
        </div>
    </div>

    <!-- Irregular Customers -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Irregular Customers</p>
                        <h4 class="mb-0">{{ $irregularCustomers }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-secondary shadow-secondary shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">person_off</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-secondary font-weight-bolder">Irregular </span>customers</p>
            </div>
        </div>
    </div>

    <!-- Revenue (Today) -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Revenue (Today)</p>
                        <h4 class="mb-0">TZS {{ number_format($todayRevenue, 0) }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-danger shadow-danger shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">payments</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">Today's </span>collection</p>
            </div>
        </div>
    </div>

    <!-- Revenue (Monthly) -->
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card mb-2">
            <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-sm mb-0 text-capitalize">Revenue (Monthly)</p>
                        <h4 class="mb-0">TZS {{ number_format($monthlyRevenue, 0) }}</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-success shadow-success shadow text-center border-radius-lg">
                        <i class="material-symbols-rounded opacity-10">trending_up</i>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">Monthly </span>collection</p>
            </div>
        </div>
    </div>
</div>
@endsection
