<?php
include('views/header.php');
include('inc/names.php');
include('inc/functions.php');

// Name von der URL parems holen.
$currentName = $_GET['name'];

$namesFiltered = [];

foreach ($names as $nameArray) {


    if ($nameArray['name'] !== $currentName) {
        continue;
    }
    $namesFiltered[] = $nameArray;
}
?>

<?php if (!empty($namesFiltered)): ?>
    <h2>Geburtsstatistik für den namen:
        <?php echo e($currentName) ?>
    </h2>

    <?php
    $chartYears = [];
    $charCounts = [];
    foreach ($namesFiltered as $nameArray) {
        $chartYears[] = $nameArray['year'];
        $charCounts[] = $nameArray['count'];
    }
    ?>

    <canvas id="myChart"></canvas>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                // X - Achse beschriftung
                labels: <?php echo json_encode($chartYears); ?>,
                datasets: [{
                    label: '# of babies',
                    // Y - Achse
                    data: <?php echo json_encode($charCounts); ?>,
                    fill: false,
                    borderColor: [
                        'rgb(75,192,192)'
                    ],
                    tension: 0.1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <table>
        <thead>
            <tr>
                <th>Jahr</th>
                <th>Anzahl Geburten</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($namesFiltered as $nameArray): ?>
                <tr>
                    <td>
                        <?php echo $nameArray['year']; ?>
                    </td>
                    <td>
                        <?php echo $nameArray['count']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php include('views/footer.php'); ?>