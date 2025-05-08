<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Fullcalendar -->


<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    datatable = $("#datatable").DataTable({
      destroy: true, //elakkan dari error initialise
      //				orderCellsTop: true,
      //		        fixedHeader: true,
      "ordering": false,
      "scrollX": true,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "pageLength": 10
    });
  });
</script>

<script type="text/javascript">
  $(function() {
    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var arLabels = [];
    var arSuratMasuk = [];
    var arSuratKeluar = [];
    var $table = $("#surat-data");

    $table.find("tr").each(function() {
      var $cols = $(this).find("td");
      arLabels.push($cols.eq(0).html()); // Ambil nama bulan
      arSuratMasuk.push(parseInt($cols.eq(1).html()) || 0);
      arSuratKeluar.push(parseInt($cols.eq(2).html()) || 0);
    });

    var $chart = $('#surat-chart');
    var suratChart = new Chart($chart, {
      type: 'bar',
      data: {
        labels: arLabels, // Menggunakan label dari tabel
        datasets: [{
            label: 'Surat Masuk',
            backgroundColor: '#005331',
            borderColor: '#005331',
            data: arSuratMasuk
          },
          {
            label: 'Surat Keluar',
            backgroundColor: '#ffc107',
            borderColor: '#ffc107',
            data: arSuratKeluar
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: {
            display: true
          },
          tooltip: {
            mode: 'index',
            intersect: false
          }
        }
      }
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'id',
      initialView: 'dayGridMonth',
      events: [{
          title: 'Surat Masuk - Undangan',
          start: '2025-03-01',
          description: 'Undangan rapat koordinasi'
        },
        {
          title: 'Surat Keluar - Laporan',
          start: '2025-03-05',
          description: 'Laporan kegiatan bulanan'
        }
      ],
      eventClick: function(info) {
        alert(info.event.title + "\n" + info.event.extendedProps.description);
      }
    });
    calendar.render();


  });
</script>
	