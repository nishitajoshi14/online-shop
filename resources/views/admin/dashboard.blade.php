@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            
            @include('admin.header')

            
            <!-- Flexbox Container for Boxes and Graph -->
            <div class="d-flex">
                <!-- Boxes Section -->
                <div class="boxes-section">
                    <div class="row">
                        <!-- First Row with Icons -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-box"></i> <!-- Box Icon for Total Orders -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Total Orders</h6>
                                        <p class="card-text"><strong>3</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-truck"></i> <!-- Truck Icon for Delivered Orders -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Delivered Orders</h6>
                                        <p class="card-text"><strong>0</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row (With Icons) -->
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-dollar-sign"></i> <!-- Dollar Icon for Total Amount -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Total Amount</h6>
                                        <p class="card-text"><strong>481.34</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-truck-loading"></i> <!-- Truck Icon for Delivered Orders Amount -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Delivered Orders Amount</h6>
                                        <p class="card-text"><strong>0.00</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row (With Icons) -->
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-hourglass-half"></i> <!-- Hourglass Icon for Pending Orders -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Pending Orders</h6>
                                        <p class="card-text"><strong>3</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-ban"></i> <!-- Ban Icon for Canceled Orders -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Canceled Orders</h6>
                                        <p class="card-text"><strong>0</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Row (With Icons) -->
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-hourglass-end"></i> <!-- Hourglass Icon for Pending Orders Amount -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Pending Orders Amount</h6>
                                        <p class="card-text"><strong>481.34</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-ban"></i> <!-- Ban Icon for Canceled Orders Amount -->
                                    </div>
                                    <div>
                                        <h6 class="card-title">Canceled Orders Amount</h6>
                                        <p class="card-text"><strong>0.00</strong></p> <!-- Bold Number -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graph Section -->
                <div class="graph-section ml-4 mt-4" style="flex-grow: 1;">
                    <div class="card text-dark" style="background-color: white; border-radius: 8px; height: 320px; width: 100%;">
                        <div class="card-body">
                            <h5 class="card-monthly">Earnings revenue</h5>
                            <canvas id="monthlyGraph" style="height: 240px;"></canvas> <!-- Canvas for Chart.js -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Cart Section (Order Summary) -->
<div class="cart-section mt-5">
    <div class="card"> <!-- Matching the width of boxes and graph -->
        <div class="card-header">
            <h4>Recent orders</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Order No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Subtotal</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Total Items</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example row of data -->
                    <tr>
                        <td>#1001</td>
                        <td>John Doe</td>
                        <td>(555) 123-4567</td>
                        <td>$200.00</td>
                        <td>$18.00</td>
                        <td>$218.00</td>
                        <td>Processing</td>
                        <td>2024-10-22</td>
                        <td>3</td>
                    </tr>
                    <!-- Add more rows dynamically from the backend -->
                </tbody>
            </table>
        </div>
    </div>
</div>

        </main>
    </div>
</div>




<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample Data for Monthly Graph
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Monthly Revenue',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [12, 19, 3, 5, 2, 3, 8], // Sample revenue data
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };
    const myChart = new Chart(
        document.getElementById('monthlyGraph'),
        config
    );
</script>
@endsection
