<!-- Biblioteca que exibe graficos Inclua o Chart.js (JavaScript) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Exibe o Grafico de Presenças x Ausências -->
<div class="col-10 login-container border-simple h-100">

    <!-- indica onde o usuário está na tela --> 
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">RELATÓRIO DE PRESENÇA</li>
        </ol>
    </nav> 

    <div class="container">
        <canvas id="presencasAusenciasChart"></canvas>
    </div>

</div>

<!-- Javascript para exiber o grafico -->
<script>
// Obter os dados do PHP
var meses = <?php echo $meses_json; ?>;
var presencas = <?php echo $presencas_json; ?>;
var ausencias = <?php echo $ausencias_json; ?>;

// Configurar e criar o gráfico
var ctx = document.getElementById('presencasAusenciasChart').getContext('2d');
var presencasAusenciasChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: meses,
        datasets: [
            {
                label: 'Presenças',
                data: presencas,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: false
            },
            {
                label: 'Ausências',
                data: ausencias,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: false
            }
        ]
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

    