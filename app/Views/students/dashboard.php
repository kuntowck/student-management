<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="bg-white shadow-sm rounded-lg p-8">
    <?php if (session('error')) :  ?>
        <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-4 py-2 rounded-sm mb-2">
            <?= session('error') ?? ''; ?>
        </div>
    <?php elseif (session('message')): ?>
        <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-4 py-2 rounded-sm mb-2">
            <?= session('message') ?? ''; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty(user())): ?>
        <h1 class="text-xl font-bold">Hello, <?= user()->username; ?>!</h1>
        <?php foreach (user()->getRoles() as $role): ?>
            <p>Role: <?= $role; ?></p>
        <?php endforeach; ?>

        <div class="">
            <div class="">
                <!-- Pie Chart: Credit distribution by grade -->
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="gradeChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bar Chart: Credits taken vs. credits required -->
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="creditChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Line Chart: GPA per Semester -->
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="gpaChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <h1 class="text-xl font-bold mb-6">
            Welcome to Student Management System
        </h1>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    // Data dari controller
    const gpaData = <?= $gpaData ?>;
    const creditsByGrade = <?= $creditsByGrade ?>;
    const creditComparison = <?= $creditComparison ?>;

    const gradeChart = new Chart(
        document.getElementById('gradeChart'), {
            type: 'pie',
            data: creditsByGrade,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Credit Distribution by Grade'
                    },
                    legend: {
                        position: 'right'
                    }
                }
            }
        }
    );

    const creditChart = new Chart(
        document.getElementById('creditChart'), {
            type: 'bar',
            data: creditComparison,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Credits'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Semester'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Credits Taken vs. Credits Required by Semester'
                    }
                }
            }
        }
    );


    const gpaChart = new Chart(
        document.getElementById('gpaChart'), {
            type: 'line',
            data: gpaData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        max: 4,
                        title: {
                            display: true,
                            text: 'GPA'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Semester'
                        }
                    }
                },

                plugins: {
                    title: {
                        display: true,
                        text: 'Academic Progress (GPA per Semester)'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `GPA: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        }
    );
</script>
<?= $this->endSection(); ?>