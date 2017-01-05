var options = {
  responsive: {
    breakpoints: [
      {name: 'desktop', width: Infinity},
      {name: 'mobile', width: 768}
    ]
  },
  "language": {
    "lengthMenu": "Sayfada _MENU_ kayıt göster",
    "zeroRecords": "Aradığınız bulunamadı.",
    "info": "_TOTAL_ kayıttan _START_ - _END_ arası kayıtlar",
    "infoEmpty": "Kayıt bulunamadı.",
    "infoFiltered": "(Toplam _MAX_ kayıttan filtreleme yapıldı)",
    "search": "",
    "searchPlaceholder": "Kayıt Arama",
    "paginate": {
      "previous": "Önceki",
      "next": "Sonraki"
    }
  }
};

var user = $.extend(options, {
  columnDefs: [
    {className: 'desktop', targets: [3, 4]},
    {targets: [-1], orderable: false}
  ]
});

var course = $.extend(options, {
  columnDefs: [
    {className: 'desktop', targets: [1, 3, 4]},
    {targets: [-1], orderable: false}
  ]
});

var multi = $.extend(options, {
  columnDefs: [
    {className: 'desktop', targets: [-1]},
    {targets: [-1], orderable: false}
  ]
});

$('#dataTable-user').DataTable(user);
$('#dataTable-course').DataTable(course);
$('#dataTable-role, #dataTable-ability, #dataTable-instructor, #dataTable-department').DataTable(multi);
$('#dataTable-unit, #dataTable-courseusers').DataTable({
  responsive: true,
  "language": {
    "lengthMenu": "Sayfada _MENU_ kayıt göster",
    "zeroRecords": "Aradığınız bulunamadı.",
    "info": "_TOTAL_ kayıttan _START_ - _END_ arası kayıtlar",
    "infoEmpty": "Kayıt bulunamadı.",
    "infoFiltered": "(Toplam _MAX_ kayıttan filtreleme yapıldı)",
    "search": "",
    "searchPlaceholder": "Kayıt Arama",
    "paginate": {
      "previous": "Önceki",
      "next": "Sonraki"
    }
  },
  columnDefs: [
    {targets: [-1], orderable: false}
  ]
});
