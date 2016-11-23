// Form Validation
$('#userForm').validate({
  debug: true,
  errorElement: 'span',
  errorClass: 'help-block',
  highlight: function (element) {
    $(element).parent().addClass("has-error");
    $(element).parent().removeClass("has-success");
  },
  unhighlight: function (element) {
    $(element).parent().removeClass("has-error");
    $(element).parent().addClass("has-success");
  },
  rules: {
    stepName: {
      required: true,
      minlength: 3,
      maxlength: 30
    },
    stepSurname: {
      required: true,
      minlength: 3,
      maxlength: 30
    },
    stepEmail: {
      required: true,
      email: true
    },
    stepTel: {
      required: true,
      minlength: 10,
      maxlength: 10
    },
    stepAddress: {
      required: true
    },
    stepUser: {
      required: true,
      minlength: 3,
      maxlength: 30
    },
    stepNo: {
      required: true
    },
    stepRol: {
      required: true
    }
  },
  messages: {
    stepName: {
      required: 'Lütfen isim giriniz.',
      minlength: 'En az 3 haneli olmalıdır.',
      maxlength: 'İsminizi kontrol ediniz.'
    },
    stepSurname: {
      required: 'Lütfen soyisim giriniz.',
      minlength: 'En az 3 haneli olmalıdır.',
      maxlength: 'İsminizi kontrol ediniz.'
    },
    stepEmail: {
      required: 'Lütfen email adresi giriniz.',
      email: 'Lütfen geçerli bir email adresi giriniz.'
    },
    stepTel: {
      required: 'Lütfen cep telefonu giriniz.',
      minlength: 'En az 10 haneli olmalıdır.',
      maxlength: 'En fazla 10 haneli olmalıdır.'
    },
    stepAddress: {
      required: 'Lütfen adres bilgisi giriniz.'
    },
    stepUser: {
      required: 'Lütfen kullanıcı adı giriniz.',
      minlength: 'En az 3 haneli olmalıdır.',
      maxlength: 'Kullanıcı adınızı ediniz.'
    },
    stepNo: {
      required: 'Lütfen sicil no giriniz.'
    },
    stepRol: {
      required: 'Lütfen rol seçiniz.'
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
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
  var id = button.data('id');
  var modal = $(this);

  modal.find('.modal-body #updateName').val(name);
  modal.find('.modal-body #updateSurname').val(surname);
  modal.find('.modal-body #updateDepartment').val(department);
  modal.find('.modal-body').find("[data-id='updateDepartmentSelect']").attr('title', department).children('.filter-option').text(department);
  modal.find('.modal-body #updateDepartmentSelect option:contains('+department+')').attr('selected', 'selected');
  modal.find('.modal-body #dep_id').val(id);
  modal.find('.modal-body #unit_id').val(id);
  modal.find('.modal-body #role_id').val(id);
});

$('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var modal = $(this);
  modal.find('.modal-body #dep_id').val(id);
  modal.find('.modal-body #unit_id').val(id);
  modal.find('.modal-body #role_id').val(id);
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
        $.each(data, function(i, data) {
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
                { name: 'desktop', width: Infinity },
                { name: 'mobile',   width: 768 }
              ]
            },
            columnDefs: [
              { className: 'desktop', targets: [2,3,4,5,6] }
            ],
            "columns": [
              null,
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              { "orderable": false },
              { "orderable": false }
            ]
          }).fnAddData([
            data.b,
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control" checked><label for="'+data.a+++'"></label>',
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control"><label for="'+data.a+++'"></label>',
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control"><label for="'+data.a+++'"></label>',
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control"><label for="'+data.a+++'"></label>',
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control"><label for="'+data.a+++'"></label>',
            '<input id="'+data.a+'" name="'+data.b+'" type="radio" class="form-control"><label for="'+data.a+'"></label>'
          ]);
        });
        $("#ability-container .btn-danger").click(function () {
          $("#ability-container").empty().addClass("hidden");
        });
      }
    });
  },1000);
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
        $.each(data, function(i, data) {
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
              { "orderable": false }
            ]
          }).fnAddData([
            data.ad+" "+data.soyad,
            data.yetenek,
            data.seviye,
            '<input id="'+data.id+'" type="checkbox" class="form-control"><label for="'+data.id+'">Ekle</label>'
          ]);
        });
        $("#courseAddUser .btn-danger").click(function () {
          $("#courseAddUser").empty().addClass("hidden");
        });
      }
    });
  },1000);
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
        $.each(data, function(i, data) {
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
              { "orderable": false }
            ]
          }).fnAddData([
            data.b,
            '<input id="'+data.a+'" type="checkbox" class="form-control"><label for="'+data.a+'">Ekle</label>'
          ]);
        });
        $("#ability-container .btn-danger").click(function () {
          $("#ability-container").empty().addClass("hidden");
        });
      }
    });
  },1000);
});


$(".create").click(function () {
  $(this).hide();
  $(".form-create").removeClass("hidden");

  $('.form-create select option').prop('selected', function () {
    return this.defaultSelected;
  });
  $('.selectpicker').selectpicker('refresh');
});

$(".instructor").click(function () {
  $(this).hide();
  $(".form-create").removeClass("hidden");

  $("label[for='companyIn']").click(function () {
    $(this).parent().parent().addClass("hidden");
    $(".company-in").removeClass("hidden");
  });
  $("label[for='companyOut']").click(function () {
    $(this).parent().parent().addClass("hidden");
    $(".company-out").removeClass("hidden");
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
  $("#roleDepartment").parent().parent().removeClass("hidden");
});

$("#roleUnit").change(function() {
  $("#roleDepartment").parent().parent().addClass("hidden");
});

$("#roleDepartment").change(function() {
  $("#roleUnit").prop('disabled', true);
  $('.selectpicker').selectpicker('refresh');
  if ($(this).children('option:nth-child(2)').is(':selected')) {
    $("#roleUnit").prop('disabled', false);
    $('.selectpicker').selectpicker('refresh');
  }
});


$(window).resize(function() {
  if ($(window).width() < 768) {
    $("td.desktop").remove();
  }
});