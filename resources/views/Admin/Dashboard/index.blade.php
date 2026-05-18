@section('meta_title') Dashboard | LCW Lighting @endsection
@extends('Admin.Layouts.layout')
@section('css')
<style>
    .card {
        display: block;
        min-width: 0;
        word-wrap: break-word;
        background-color: var(--ct-card-bg);
        background-clip: border-box;
        border: 0 solid var(--ct-card-border-color);
        border-radius: 0.25rem;

    }

    .morris-donut-example svg text tspan {
        font-size: 10px !important;
    }

    .content {
        padding-top: 25px;
    }

    .random {
        display: none;
    }
    .content-page {
    padding: 0 12px 40px 12px;
}
</style>
@endsection
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Categories</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="bi bi-grid-fill text-info"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['category_count'])?$count['category_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">Categories</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Sub Categories</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="bi bi-diagram-3-fill text-warning"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['subcategory_count'])?$count['subcategory_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">Sub Categories</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Sub Sub Categories</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="bi bi-layers-fill "></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['subsubcategory_count'])?$count['subsubcategory_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">Sub Sub Categories</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Products</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
   
                                    <i class="bi bi-box-seam text-danger"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['products_count'])?$count['products_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">No of Customer</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account-circle text-secondary"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['customer_count'])?$count['customer_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">No of Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">No of Order</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-clipboard-list text-purple"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['orders_count'])?$count['orders_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">No of Order</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Contact Enquiry</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account-check"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{!empty($count['contact_enq_count'])?$count['contact_enq_count']:'0'}} </h2>
                                    <p class="text-muted mb-1">Contact Enquiry</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                        <div class="row ms-0 mb-3">
                            <div class="col-md-12 th-bg">
                                <div>
                                    <p class="text-left mb-0 fs-4"> Total Order - {{!empty($count['orders_count'])?$count['orders_count']:'0'}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 bg-white py-1 pt-2">
                                <div class="row">
                                    <div class="col-md-3 card-body p-2 bg-warning mx-2 mb-2">
                                      <h4 class="card-title mb-1">Pending Payment</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['payment_pending_orders_count'])?$count['payment_pending_orders_count']:'0'}}
                                      </p>
                                    </div>
                                    <div class="col-md-3 card-body p-2 bg-warning mx-2 mb-2">
                                      <h4 class="card-title mb-1">Pending Orders</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['pending_orders_count'])?$count['pending_orders_count']:'0'}}

                                      </p>
                                    </div>
                                    <div class="col-md-3 card-body p-2 bg-success mx-2 mb-2">
                                      <h4 class="card-title mb-1">Confirmed Orders</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['confirmed_orders_count'])?$count['confirmed_orders_count']:'0'}}

                                      </p>
                                    </div>
                                    <div class="col-md-3 card-body p-2 bg-info mx-2 mb-2">
                                      <h4 class="card-title mb-1">Inprocess Orders</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['inprocess_orders_count'])?$count['inprocess_orders_count']:'0'}}

                                      </p>
                                    </div>
                                    <div class="col-md-3 card-body p-2 bg-success mx-2 mb-2">
                                      <h4 class="card-title mb-1">Delivered Orders</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['delivered_orders_count'])?$count['delivered_orders_count']:'0'}}

                                      </p>
                                    </div>
                                    <div class="col-md-3 card-body p-2 bg-danger mx-2 mb-2">
                                      <h4 class="card-title mb-1">Cancelled Orders</h4>
                                      <p class="m-0 fw-bold fs-4">
                                        {{!empty($count['cancelled_orders_count'])?$count['cancelled_orders_count']:'0'}}

                                      </p>
                                    </div>
                                  </div>
                                  
                              </div>
                              
                        </div>
   

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var pieCanvas = document.getElementById('support-ticket-pie-chart').getContext('2d');
    var support_counts = JSON.parse($("#support-ticket-pie-chart").attr('data-counts'));
    var pieData = {
        labels: ['Resolved', 'Pending', 'Closed'],
        datasets: [{
            data: support_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(pieCanvas, {
        type: 'pie',
        data: pieData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>

<script>
    var doughnutCanvas = document.getElementById('requisition-doughnut-chart').getContext('2d');
    var requisition_counts = JSON.parse($("#requisition-doughnut-chart").attr('data-counts'));
    var doughnutData = {
        labels: ['Completed', 'Pending', 'Rejected'],
        datasets: [{
            data: requisition_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(doughnutCanvas, {
        type: 'doughnut',
        data: doughnutData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>
@endsection