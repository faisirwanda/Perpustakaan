    <style>
        /* #barChart {
          width: 5px;
          height: 10px;
        } */
        .chart-container {
          position: relative;
          margin-top: 2rem;
          width: 100%;
          max-width: 800px; /* Atur lebar maksimum sesuai kebutuhan Anda */
          height: auto;
        }
        .chart-container canvas {
          position: absolute;
          left: 0;
          top: 0;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<section class="container-fluid col-lg-8 justify-content-center" style="margin-top: 1rem;">
        <div class="d-flex justify-content-center align-items-center mb-5">
            <h2>Statistik Peminjaman Buku</h2>
        </div>
        <div class="chart-container">
            <canvas id="barChart" data-aos="slide-right" data-aos-duration="800" data-aos-anchor-placement="bottom-end"></canvas>
        </div>
    </section>

    <script>
        // Define the data using the transactions variable passed from the controller
        var labels = [];
        var values = [];
        @foreach ($transactions as $transaction)
            labels.push("{{ $transaction->book_id }}");
            values.push({{ $transaction->count }});
        @endforeach

        var data = {
            labels: labels,
            datasets: [{
                label: "Jumlah Peminjaman Buku",
                data: values,
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang (contoh: merah muda)
                borderColor: 'rgba(54, 162, 235, 1)',      // Warna garis tepi (contoh: biru)
                borderWidth: 1
            }]
        };


        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        var ctx = document.getElementById("barChart").getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: options
        });
    </script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Data untuk diagram batang
        var data = {
            labels: ["Sains", "Sastra", "Karya Umum", "Lainnya", "Mat", "Bahasa", "Kimia", "Agama", "tes", "tes"],
            datasets: [{
                label: "Jumlah Peminjaman Buku",
                data: [50, 40, 30, 20, 10, 5, 4, 3, 2, 1 ], // Ganti data ini sesuai dengan jumlah buku untuk masing-masing kategori
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(75, 192, 192, 0.2)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(75, 192, 192, 1)"
                ],
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Membuat dan menampilkan diagram batang
        var ctx = document.getElementById("barChart").getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: options
        });
    });
</script> --}}