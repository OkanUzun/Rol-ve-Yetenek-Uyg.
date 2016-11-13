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

//Oluşturma Sayfalarındaki Panel Toggle
$(".create").on("click", function () {
  $(".form-create").show();
  $(".create").hide();
  $('.form-create select option').prop('selected', function () {
    return this.defaultSelected;
  });
});

$(".form-create .btn-danger").on("click", function () {
  $(".form-create").hide();
  $(".create").show();
});

// Yetenek Ekleme
function callback() {
  $("#stepLevel, #addAbility").hide();
}
$("#stepAbility").on('change', function () {
  if ($(this).children('option:first-child').is(':selected')) {
    $("#stepLevel, #addAbility").hide();
  }
  else
    $("#stepLevel, #addAbility").css({
      display: "block",
      width: "100%"
    });
});
$("#addAbility").on("click", function () {
  var ability = $("#stepAbility").val();
  var level = $("#stepLevel").val();

  var text2 = $("<td/>", {"text": ability});
  var text3 = $("<td/>", {"text": level});
  var text1 = $("<tr/>").append(text2).append(text3);
  $('.createAbility').append(text1);

  $('#stepAbility option, #stepLevel option').prop('selected', function () {
    return this.defaultSelected;
  });
  $(".table-ability").show();
  callback();
});

//Kullanıcı Detay Rol Değiştir
$("#changeRole").on("click", function () {
  $("#stepRole, #stepRoleSave").toggleClass("hidden visible");
});

// Eğitim Oluşturma
function callback2() {
  $("#courseAdd").hide();
}
$("#courseAbility").on('change', function () {
  if ($(this).children('option:first-child').is(':selected')) {
    $("#courseAdd").hide();
  }
  else
    $("#courseAdd").css("display","block");
});
$("#courseAdd").on("click", function () {
  var ability = $("#courseAbility").val();

  var text2 = $("<td/>", {"text": ability});
  var text1 = $("<tr/>").append(text2);
  $('.courseTable').append(text1);

  $('#courseAbility option').prop('selected', function () {
    return this.defaultSelected;
  });
  $(".table-ability").show();
  callback2();
});

// Eğitim Detay Konu Ekleme
$("#courseTopic").on('change', function () {
  if ($(this).children('option:first-child').is(':selected')) {
    $(".btn-courseadd").hide();
  }
  else
    $(".btn-courseadd").css("display","block");
});

$(".btn-course").on("click", function () {
  $("#courseTopic, .btn-courseadd").css("display","block");
});

$(".btn-courseadd").on("click", function () {
  var ability = $("#courseTopic").val();
  var link = "<a href='javascript:void(0);' class='btn btn-warning btn-remove'>Çıkar</a>";

  var text2 = $("<td/>", {"text": ability});
  var text3 = $("<td/>",{"class": "text-xs-center"}).append(link);
  var text1 = $("<tr/>").append(text2).append(text3);
  $('.courseTable').append(text1);

  $('#courseTopic option').prop('selected', function () {
    return this.defaultSelected;
  });
  $(".btn-courseadd, #courseTopic").hide();
  $(".table-ability").show();
});

setInterval(function () {
  $(".btn-remove").click(function () {
    $(this).closest("tr").remove();
    if ($(".table-ability table tbody").children().length === 0) {
      $(".table-ability").hide();
    }
  });
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

$('#updateModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var name = button.data('name');
  var department = button.data('department');
  var modal = $(this);
  modal.find('.modal-body #updateName').val(name);
  modal.find('.modal-body #updateDepartment').val(department);
});

$(".sidebar-toggle").click(function () {
  $(".wrapper, .side-navigation").addClass("active");
});

$(".side-navigation .close").click(function () {
  $(".wrapper, .side-navigation").removeClass("active");
});

$("#courseAddUserButton").on("click", function () {
  $("#courseAddUser").removeClass("hidden").addClass("visible");
  $(this).hide();
});

$("#courseAddUser .btn-danger").on("click", function () {
  $("#courseAddUser").removeClass("visible").addClass("hidden");
  $("#courseAddUserButton").show();
});

// Tooltip Initialization
$('[data-toggle="tooltip"], [rel="tooltip"]').tooltip({
  trigger: "hover",
  placement: "bottom"
});


// Datatable config
$('#dataTable').DataTable({
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
  }
});

// Eğitime Kullanıcı Ekleme AJAX :))
$("#courseAddUserButton").click(function () {
  $.ajax({
    type: "POST",
    url: "deneme.php",
    dataType: "html",
    success: function (result) {
      var data = JSON.parse(result);
      $("#courseAddUser").append('<div class="card-title">Kayıtlı Olmayan Katılımcılar</div> <form method="post"> <table class="table" id="dataTable2"> <thead> <tr> <td>Çalışan</td> <td>Yetenek</td> <td>Seviye</td> <td>İşlemler</td> </tr> </thead> <tbody></tbody> </table> <button type="submit" class="btn btn-success">Kaydet</button> <button type="button" class="btn btn-danger">İptal</button> </form>');
      $.each(data, function(index, data) {
        $('#dataTable2').dataTable({
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
          }
        }).fnAddData([
          data.ad+" "+data.soyad,
          data.yetenek,
          data.seviye,
          '<input id="'+data.id+'" type="checkbox" class="form-control"><label for="'+data.id+'">Ekle</label>'
        ]);
      });
    }
  });
});


