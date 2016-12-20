// ***(Sonra ilgilenilecek)***
// Form Validation
/*$('#formValidate').validate({
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

 $('#formValidate2').validate({
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
 dep_id: {
 required: true
 }
 },
 submitHandler: function (form) {
 form.submit();
 }
 });

 $('#formValidate select').on('change', function (e) {
 $('#formValidate').validate().element($(this));
 });*/
// ***(Sonra ilgilenilecek)***

/*// Datepicker
window.onload = function () {
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    clearBtn: true,
    language: 'tr',
    todayHighlight: true,
    autoclose: true
  });
 };*/

$(".datetimepicker").datetimepicker({
  format: "dd MM yyyy - hh:ii",
  autoclose: true,
  todayBtn: true,
  todayHighlight: true,
  startDate: "2000-01-01 10:00",
  endDate: "2020-12-31 23:59",
  language: "tr",
  weekStart: 1
});

// Getting data to modal
$('#updateModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var name = button.data('name');
  var surname = button.data('surname');
  var department = button.data('department');
  var unit = button.data('unit');
  var ability = button.data('ability');
  var id = button.data('id');
  var user = button.data('user');
  var modal = $(this);


  modal.find('.modal-body').find("[data-id='updateDepSelect']").attr('title', department).children('.filter-option').text(department);
  modal.find('.modal-body #updateDepSelect option:contains(' + department + ')').attr('selected', 'selected');
  if (user === "") {
    modal.find('.modal-body').find("[data-id='updateUserSelect']").attr('title', user).children('.filter-option').text("Birim Yöneticisi Seçiniz");
    modal.find('.modal-body #updateUserSelect option:contains(' + user + ')').attr('selected', 'selected');
  }
  else {
    modal.find('.modal-body').find("[data-id='updateUserSelect']").attr('title', user).children('.filter-option').text(user);
    modal.find('.modal-body #updateUserSelect option:contains(' + user + ')').attr('selected', 'selected');
  }

  modal.find('.modal-body #updateName').val(name);
  modal.find('.modal-body #updateSurname').val(surname);
  modal.find('.modal-body #updateDepartment').val(department);
  modal.find('.modal-body #dep_id').val(id);
  modal.find('.modal-body #unit_id').val(id);
  modal.find('.modal-body #role_id').val(id);
  modal.find('.modal-body #ability_id').val(id);
  modal.find('.modal-body #educator_id').val(id);
  modal.find('.modal-body #manager_id').val(id);
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

/***************************************/

// AJAX şimdilik kaldırıldı.

/*// Yetenek Tablosunu Görüntüleme AJAX
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
 '<th>Çok Kötü</th>' +
 '<th>Kötü</th>' +
 '<th>Orta</th>' +
 '<th>İyi</th>' +
 '<th>Çok İyi</th>' +
 '</thead>' +
 '<tbody></tbody>' +
 '</table>');
 $.each(data, function (i, data) {
 data.id += 1;
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
 {"orderable": false}
 ]
 }).fnAddData([
 data.ability,
 '<input name="' + data.ability + '" type="radio" class="form-control"><label for="' + data.id++ + '"></label>',
 '<input name="' + data.ability + '" type="radio" class="form-control"><label for="' + data.id++ + '"></label>',
 '<input name="' + data.ability + '" type="radio" class="form-control"><label for="' + data.id++ + '"></label>',
 '<input name="' + data.ability + '" type="radio" class="form-control"><label for="' + data.id++ + '"></label>',
 '<input name="' + data.ability + '" type="radio" class="form-control"><label for="' + data.id + '"></label>'
 ]);
 });
 $("#ability-container .btn-danger").click(function () {
 $("#ability-container").empty().addClass("hidden");
 });
 if ($(window).width() < 768) {
 $("td.desktop").remove();
 }
 },
 error: function (xhr, status, error) {
 alert(xhr.responseText);
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
 });*/

/***************************************/

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

$("#userDepartment").change(function () {
  $("#userUnit").prop('disabled', true);
  $('.selectpicker').selectpicker('refresh');
  if ($(this).children('option:nth-child(2)').is(':selected')) {
    $("#userUnit").prop('disabled', false);
    $('.selectpicker').selectpicker('refresh');
  }
});

$("#userUnit").change(function () {
  $("#userDepartment").prop('disabled', true);
  $('.selectpicker').selectpicker('refresh');
  if ($(this).children('option:nth-child(2)').is(':selected')) {
    $("#userDepartment").prop('disabled', false);
    $('.selectpicker').selectpicker('refresh');
  }
});

$(window).resize(function () {
  if ($(window).width() < 768) {
    $("td.desktop").remove();
  }
});


function changeSide() {
  // Deleting
  $("#topic .table-specific .btn-danger").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#topic .card-title button").removeAttr("disabled");

    var text = $(this).parent().parent().children().first().text();
    text = text.replace("Sil", "");
    $(this).parent().parent().remove();

    $("#topic .table-all .selectpicker").prepend("<option value='" + text + "'>" + text + "</option>");
    $(".selectpicker").selectpicker("refresh");

    changeSide();
  });
  $("#user .table-specific .btn-danger").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#user .card-title button").removeAttr("disabled");

    var text = $(this).parent().text();
    text = text.replace("Sil", "");
    $(this).parent().parent().remove();

    $("#user .table-all .selectpicker").prepend("<option value='" + text + "'>" + text + "</option>");
    $(".selectpicker").selectpicker("refresh");

    changeSide();
  });
  $("#skill .table-specific .btn-danger").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#skill .card-title button").removeAttr("disabled");

    var selectedSkill = $(this).parent().parent().children().first().text();
    $(this).parent().parent().remove();

    $("#skill .table-all tbody tr td:first-child .selectpicker").prepend("<option value='" + selectedSkill + "'>" + selectedSkill + "</option>");
    $(".selectpicker").selectpicker("refresh");

    changeSide();
  });


  // Adding
  $("#topic .table-all .btn-success").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#topic .card-title button").removeAttr("disabled");

    var selectSkill = $(this).prev().find("option:selected").text();
    $(this).prev().find("option:selected", this).remove();
    $(".selectpicker").selectpicker("refresh");

    var row = "<tr><td>" + selectSkill + "<a href='javascript:void(0)' onclick='changeSide()' class='btn btn-danger float-xs-right'>Sil</a></td></tr>";

    $("#topic .table-specific tbody").append(row);
    changeSide();
  });
  $("#user .table-all .btn-success").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#user .card-title button").removeAttr("disabled");

    var selectUser = $(this).prev().find("option:selected").text();
    $(this).prev().find("option:selected", this).remove();
    $(".selectpicker").selectpicker("refresh");

    var row = "<tr><td>" + selectUser + "<a href='javascript:void(0)' onclick='changeSide()' class='btn btn-danger float-xs-right'>Sil</a></td></tr>";

    $("#user .table-specific tbody").append(row);
    changeSide();
  });
  $("#skill .table-all .btn-success").on("click", function (event) {
    event.stopImmediatePropagation();
    $("#skill .card-title button").removeAttr("disabled");

    var selectSkill = $(this).parent().parent().children(":first-child").find("option:selected").text();
    var selectLevel = $(this).prev().find("option:selected").text();
    $(this).parent().parent().children(":first-child").find("option:selected", this).remove();
    $(".selectpicker").selectpicker("refresh");

    var row = "<tr><td>" + selectSkill + "</td><td>" + selectLevel + "<a href='javascript:void(0)' onclick='changeSide()' class='btn btn-danger float-xs-right'>Sil</a></td></tr>";

    $("#skill .table-specific tbody").append(row);
    changeSide();
  });
}
changeSide();