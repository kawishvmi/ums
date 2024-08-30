<?php
use yii\helpers\Html;
use yii\helpers\Json;

$this->title = 'Admin Profile';
?>

<div class="admin-dashboard container-fluid py-4">
    <h1 class="dashboard-title text-center mb-5"><?= Html::encode($this->title) ?></h1>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3 text-center">
            <h2 class="mb-3">Welcome, <?= Html::encode($user->username) ?></h2>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center action-card">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Manage Users</h5>
                    <?= Html::a('Manage Users', ['index'], ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm text-center action-card">
                <div class="card-body">
                    <i class="fas fa-user-plus fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Create New User</h5>
                    <?= Html::a('Create New User', ['create'], ['class' => 'btn btn-success btn-block']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Container -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h3 class="text-center mb-4">User Registrations Over Time</h3>
                <canvas id="userChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Get the data from the PHP variables
    var dates = <?= Json::encode($dates) ?>;
    var counts = <?= Json::encode($counts) ?>;

    // Create the bar chart
    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: 'Number of Users Registered',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Light blue
                borderColor: 'rgba(54, 162, 235, 1)', // Darker blue
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Users'
                    },
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5]
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += new Intl.NumberFormat().format(context.parsed.y);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
});
</script>

<style>
    .admin-dashboard {
        background-color: #f8f9fa;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
    }

    .action-card {
        border: none;
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .action-card .card-title {
        font-size: 1.25rem;
        margin-bottom: 15px;
    }

    .action-card .btn {
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 0.95rem;
        transition: background-color 0.3s;
    }

    .action-card .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .action-card .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .action-card .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .action-card .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .chart-container {
        padding: 20px;
        background: #ffffff;
        border: 1px solid #dddddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .card.shadow-sm {
        border-radius: 10px;
    }
</style>
