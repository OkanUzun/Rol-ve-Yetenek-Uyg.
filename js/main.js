$(".datepicker").datetimepicker({
  useCurrent: false,
  locale: "tr",
  format: 'DD/MM/YYYY',
  showTodayButton: true,
  showClear: true,
  icons: {
    time: 'mdi mdi-timer',
    date: 'mdi mdi-calendar',
    up: 'mdi mdi-arrow-up',
    down: 'mdi mdi-arrow-down',
    previous: 'mdi mdi-arrow-left-bold',
    next: 'mdi mdi-arrow-right-bold',
    today: 'mdi mdi-calendar-today',
    clear: 'mdi mdi-delete',
    close: 'mdi mdi-close'
  },
  tooltips: {
    today: 'Bugünü Seç',
    clear: 'Temizle',
    close: 'Kapat',
    selectMonth: 'Ay Seç',
    prevMonth: 'Önceki Ay',
    nextMonth: 'Sonraki Ay',
    selectYear: 'Yıl Seç',
    prevYear: 'Önceki Yıl',
    nextYear: 'Sonraki Yıl',
    selectDecade: 'Onyıl Seç',
    prevDecade: 'Önceki Onyıl',
    nextDecade: 'Sonraki Onyıl',
    prevCentury: 'Önceki Yüzyıl',
    nextCentury: 'Sonraki Yüzyıl'
  }
});

$(".datetimepicker, .datetimepicker2").datetimepicker({
  useCurrent: false,
  locale: "tr",
  format: 'DD/MM/YYYY - HH:mm',
  showTodayButton: true,
  showClear: true,
  icons: {
    time: 'mdi mdi-timer',
    date: 'mdi mdi-calendar',
    up: 'mdi mdi-arrow-up',
    down: 'mdi mdi-arrow-down',
    previous: 'mdi mdi-arrow-left-bold',
    next: 'mdi mdi-arrow-right-bold',
    today: 'mdi mdi-calendar-today',
    clear: 'mdi mdi-delete',
    close: 'mdi mdi-close'
  },
  tooltips: {
    today: 'Bugünü Seç',
    clear: 'Temizle',
    close: 'Kapat',
    selectMonth: 'Ay Seç',
    prevMonth: 'Önceki Ay',
    nextMonth: 'Sonraki Ay',
    selectYear: 'Yıl Seç',
    prevYear: 'Önceki Yıl',
    nextYear: 'Sonraki Yıl',
    selectDecade: 'Onyıl Seç',
    prevDecade: 'Önceki Onyıl',
    nextDecade: 'Sonraki Onyıl',
    prevCentury: 'Önceki Yüzyıl',
    nextCentury: 'Sonraki Yüzyıl',
    selectTime: 'Saat Seç',
    incrementHour: 'Saat Artır',
    decrementHour: 'Saat Azalt',
    incrementMinute: 'Dakika Artır',
    decrementMinute: 'Dakika Azalt',
    pickHour: 'Saat Seç',
    pickMinute: 'Dakika Seç'
  }
});

$(".datetimepicker").on("dp.change", function (e) {
  $(".datetimepicker2").data("DateTimePicker").minDate(e.date);
});
$(".datetimepicker2").on("dp.change", function (e) {
  $(".datetimepicker").data("DateTimePicker").maxDate(e.date);
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

$('.table-specific select').change(function () {
  var level = $(this).val();
  $("input[name='level_id']").val(level);
});