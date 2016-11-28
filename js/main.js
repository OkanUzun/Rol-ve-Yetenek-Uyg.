// Form Validation
$('#formValidate').validate({
  debug: true,
  errorPlacement: function (error, element) {
  },
  highlight: function (element) {
    $(element).parent().addClass("has-error").removeClass("has-success");
  },
  unhighlight: function (element) {
    $(element).parent().removeClass("has-error").addClass("has-success");
  },
  rules: {
    role_id: {
      required: true
    },
    f_name: {
      required: true
    },
    l_name: {
      required: true
    },
    u_name: {
      required: true
    },
    date_of_birth: {
      required: true
    },
    e_mail: {
      required: true,
      email: true
    },
    phone_number: {
      required: true
    },
    address: {
      required: true
    },
    dep_name: {
      required: true
    },
    unit_name: {
      required: true
    },
    dep_id: {
      required: true
    },
    unit_id: {
      required: true
    },
    role_name: {
      required: true
    },
    user_id: {
      required: "#companyIn:checked"
    },
    educator_name: {
      required: "#companyOut:checked"
    },
    ability_name: {
      required: true
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#formValidate select').on('change', function (e) {
  $('#formValidate').validate().element($(this));
});

// Datepicker
window.onload = function () {
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    clearBtn: true,
    language: 'tr',
    todayHighlight: true,
    autoclose: true
  });
};

// Getting data to modal
$('#updateModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var name = button.data('name');
  var surname = button.data('surname');
  var department = button.data('department');
  var unit = button.data('unit');
  var ability = button.data('ability');
  var id = button.data('id');
  var modal = $(this);

  modal.find('.modal-body').find("[data-id='updateDepartmentSelect']").attr('title', department).children('.filter-option').text(department);
  modal.find('.modal-body #updateDepartmentSelect option:contains(' + department + ')').attr('selected', 'selected');

  modal.find('.modal-body').find("[data-id='updateUnitSelect']").attr('title', unit).children('.filter-option').text(unit);
  modal.find('.modal-body #updateUnitSelect option:contains(' + unit + ')').attr('selected', 'selected');

  modal.find('.modal-body #updateName').val(name);
  modal.find('.modal-body #updateSurname').val(surname);
  modal.find('.modal-body #updateDepartment').val(department);
  modal.find('.modal-body #dep_id').val(id);
  modal.find('.modal-body #unit_id').val(id);
  modal.find('.modal-body #role_id').val(id);
  modal.find('.modal-body #ability_id').val(id);
  modal.find('.modal-body #educator_id').val(id);
});

$('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var modal = $(this);
  modal.find('.modal-body #dep_id').val(id);
  modal.find('.modal-body #unit_id').val(id);
  modal.find('.modal-body #role_id').val(id);
  modal.find('.modal-body #ability_id').val(id);
  modal.find('.modal-body #educator_id').val(id);
});


// Mobile sidebar toggle
$(".sidebar-toggle").click(function () {
  $(".wrapper, .side-navigation").addClass("active");
});

$(".side-navigation .close").click(function () {
  $(".wrapper, .side-navigation").removeClass("active");
});


// Tooltip Initialization
$('[data-toggle="tooltip"], [rel="tooltip"]').tooltip({
  trigger: "hover",
  placement: "bottom"
});

$(".mCustomScrollbar").mCustomScrollbar({
  scrollInertia: 250
});


// Yetenek Tablosunu Görüntüleme AJAX
$("#abilityShow").click(function () {
  $("#ability-container").removeClass("hidden");
  $("#ability-container").html('<div class="text-xs-center"><img src="img/loading.gif"/></div>');
  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "deneme2.php",
      dataType: "json",
      success: function (data) {
        $("#ability-container").html(
          '<div class="card-title">' +
          '<span>Yetenekler</span>' +
          '<div class="card-buttons">' +
          '<button type="button" class="btn btn-danger">İPTAL</button>' +
          '<button type="submit" class="btn btn-success">KAYDET</button>' +
          '</div>' +
          '</div>' +
          '<table class="table" id="dataTable-addability">' +
          '<thead>' +
          '<th>Yetenek Adı</th>' +
          '<th>Yok</th>' +
          '<th>Çok Kötü</th>' +
          '<th>Kötü</th>' +
          '<th>Orta</th>' +
          '<th>İyi</th>' +
          '<th>Çok İyi</th>' +
          '</thead>' +
          '<tbody></tbody>' +
          '</table>');
        $.each(data, function (i, data) {
          data.a += 1;
          $('#dataTable-addability').dataTable({
            bRetrieve: true,
            "language": {
              "lengthMenu": "Sayfada _MENU_ kayıt göster",
              "zeroRecords": "Hiçbirşey bulunamadı.",
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
            responsive: {
              breakpoints: [
                {name: 'desktop', width: Infinity},
                {name: 'mobile', width: 768}
              ]
            },
            columnDefs: [
              {className: 'desktop', targets: [2, 3, 4, 5, 6]}
            ],
            "columns": [
              null,
              {"orderable": false},
              {"orderable": false},
              {"orderable": false},
              {"orderable": false},
              {"orderable": false},
              {"orderable": false}
            ]
          }).fnAddData([
            data.b,
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control" checked><label for="' + data.a++ + '"></label>',
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control"><label for="' + data.a++ + '"></label>',
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control"><label for="' + data.a++ + '"></label>',
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control"><label for="' + data.a++ + '"></label>',
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control"><label for="' + data.a++ + '"></label>',
            '<input id="' + data.a + '" name="' + data.b + '" type="radio" class="form-control"><label for="' + data.a + '"></label>'
          ]);
        });
        $("#ability-container .btn-danger").click(function () {
          $("#ability-container").empty().addClass("hidden");
        });
      }
    });
  }, 1000);
});

// Eğitime Kullanıcı Ekleme AJAX
$("#courseAddUserButton").click(function () {
  $("#courseAddUser").removeClass("hidden").html("<div class='text-xs-center'><img src='img/loading.gif'/></div>");
  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "deneme.php",
      dataType: "json",
      success: function (data) {
        $("#courseAddUser").html(
          '<div class="card-title">' +
          '<span>Kayıtlı Olmayan Katılımcılar</span>' +
          '<div class="card-buttons">' +
          '<button type="button" class="btn btn-danger">İPTAL</button>' +
          '<button type="submit" class="btn btn-success">KAYDET</button>' +
          '</div>' +
          '</div>' +
          '<form method="post">' +
          '<table class="table" id="dataTable2">' +
          '<thead>' +
          '<th>Çalışan</th>' +
          '<th>Yetenek</th>' +
          '<th>Seviye</th>' +
          '<th>İşlemler</th>' +
          '</thead>' +
          '<tbody></tbody>' +
          '</table>' +
          '</form>');
        $.each(data, function (i, data) {
          $('#dataTable2').dataTable({
            bRetrieve: true,
            responsive: true,
            "language": {
              "lengthMenu": "Sayfada _MENU_ kayıt göster",
              "zeroRecords": "Hiçbirşey bulunamadı.",
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
            "columns": [
              null,
              null,
              null,
              {"orderable": false}
            ]
          }).fnAddData([
            data.ad + " " + data.soyad,
            data.yetenek,
            data.seviye,
            '<input id="' + data.id + '" type="checkbox" class="form-control"><label for="' + data.id + '">Ekle</label>'
          ]);
        });
        $("#courseAddUser .btn-danger").click(function () {
          $("#courseAddUser").empty().addClass("hidden");
        });
      }
    });
  }, 1000);
});

// Eğitim Konu Düzenleme AJAX
$("#courseAbilityChange").click(function () {
  $("#ability-container").removeClass("hidden");
  $("#ability-container").html('<div class="text-xs-center"><img src="img/loading.gif"/></div>');
  setTimeout(function () {
    $.ajax({
      type: "POST",
      url: "deneme2.php",
      dataType: "json",
      success: function (data) {
        $("#ability-container").html(
          '<div class="card-title">' +
          '<span>Yetenekler</span>' +
          '<div class="card-buttons">' +
          '<button type="button" class="btn btn-danger">İPTAL</button>' +
          '<button type="submit" class="btn btn-success">KAYDET</button>' +
          '</div>' +
          '</div>' +
          '<table class="table" id="dataTable-adduser">' +
          '<thead>' +
          '<th>Konu</th>' +
          '<th>İşlemler</th>' +
          '</thead>' +
          '<tbody></tbody>' +
          '</table>');
        $.each(data, function (i, data) {
          $('#dataTable-adduser').dataTable({
            bRetrieve: true,
            responsive: true,
            "language": {
              "lengthMenu": "Sayfada _MENU_ kayıt göster",
              "zeroRecords": "Hiçbirşey bulunamadı.",
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
            "columns": [
              null,
              {"orderable": false}
            ]
          }).fnAddData([
            data.b,
            '<input id="' + data.a + '" type="checkbox" class="form-control"><label for="' + data.a + '">Ekle</label>'
          ]);
        });
        $("#ability-container .btn-danger").click(function () {
          $("#ability-container").empty().addClass("hidden");
        });
      }
    });
  }, 1000);
});


$(".create").click(function () {
  $(this).hide();
  $(".form-create").removeClass("hidden");

  $('.form-create select option').prop('selected', function () {
    return this.defaultSelected;
  });
  $('.selectpicker').prop('disabled', false).selectpicker('refresh');
});

$(".instructor").click(function () {
  $(this).hide();
  $(".form-create").removeClass("hidden");

  $("label[for='companyIn']").click(function () {
    $(".company-in").removeClass("hidden");
    $(".company-out").addClass("hidden");
  });
  $("label[for='companyOut']").click(function () {
    $(".company-out").removeClass("hidden");
    $(".company-in").addClass("hidden");
  });
  $('.form-create select option').prop('selected', function () {
    return this.defaultSelected;
  });
  $('.selectpicker').selectpicker('refresh');
});

$(".form-create .btn-danger").click(function () {
  $(".form-create, .company-in, .company-out").addClass("hidden");
  $(".instructor-status").removeClass("hidden");
  $(".create").show();
  $(".instructor").show();
  $("#companyIn, #companyOut").prop('checked', false);
  $(".form-create .form-group, .form-create .bootstrap-select").removeClass("has-error has-success");
});

$("#roleUnit").change(function () {
  $("#roleDepartment").prop('disabled', true);
  $('.selectpicker').selectpicker('refresh');
  if ($(this).children('option:nth-child(2)').is(':selected')) {
    $("#roleDepartment").prop('disabled', false);
    $('.selectpicker').selectpicker('refresh');
  }
});

$("#roleDepartment").change(function () {
  $("#roleUnit").prop('disabled', true);
  $('.selectpicker').selectpicker('refresh');
  if ($(this).children('option:nth-child(2)').is(':selected')) {
    $("#roleUnit").prop('disabled', false);
    $('.selectpicker').selectpicker('refresh');
  }
});

$(window).resize(function () {
  if ($(window).width() < 768) {
    $("td.desktop").remove();
  }
});