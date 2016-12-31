jQuery.validator.setDefaults({
  debug: true,
  errorElement: "span",
  success: "valid",
  ignore: ":not(select:hidden, input:visible, textarea:visible, .selectpicker)"
});

$('form[id^="validate-"] select').on('change', function () {
  $('form[id^="validate-"]').validate().element($(this));
});

$('#validate-profileModal').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    new_pw: {
      required: true,
      minlength: 6
    },
    new_pw_again: {
      required: true,
      equalTo: "#new_password",
      minlength: 6
    }
  },
  messages: {
    new_pw: {
      required: "Yeni şifre giriniz",
      minlength: "Şifreniz en az 6 karakter olmalıdır"
    },
    new_pw_again: {
      required: "Şifrenizi tekrar giriniz",
      equalTo: "Şifreleriniz aynı olmalı",
      minlength: "Şifreniz en az 6 karakter olmalıdır"
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-profile').validate({
  rules: {
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
    phone_num: {
      required: true,
      minlength: 10,
      maxlength: 10
    },
    address: {
      required: true
    }
  },
  messages: {
    f_name: "İsim giriniz",
    l_name: "Soyisim giriniz",
    u_name: "Kullanıcı adı giriniz",
    date_of_birth: "Doğum tarihi seçiniz",
    e_mail: {
      required: "E-mail adresi giriniz",
      email: "Geçerli bir e-mail adresi giriniz"
    },
    phone_num: {
      required: "Mobil telefon giriniz",
      minlength: "Mobil telefon en az 10 haneli olmalı",
      maxlength: "Mobil telefon en fazla 10 haneli olmalı"
    },
    address: "Adres giriniz"
  },
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-userCreate').validate({
  rules: {
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
      required: true,
      minlength: 10,
      maxlength: 10
    },
    address: {
      required: true
    },
    dep_id: {
      require_from_group: [1, ".selectone"]
    },
    unit_id: {
      require_from_group: [1, ".selectone"]
    },
    role_id: {
      required: true
    }
  },
  messages: {
    f_name: "İsim giriniz",
    l_name: "Soyisim giriniz",
    u_name: "Kullanıcı adı giriniz",
    date_of_birth: "Doğum tarihi seçiniz",
    e_mail: {
      required: "E-mail adresi giriniz",
      email: "Geçerli bir e-mail adresi giriniz"
    },
    phone_number: {
      required: "Mobil telefon giriniz",
      minlength: "Mobil telefon en az 10 haneli olmalı",
      maxlength: "Mobil telefon en fazla 10 haneli olmalı"
    },
    address: "Adres giriniz",
    dep_id: {
      require_from_group: "Departman ya da Birim seçiniz"
    },
    unit_id: {
      require_from_group: "Departman ya da Birim seçiniz"
    },
    role_id: "Rol Seçiniz"
  },
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-userInfo, #validate-userSkill').validate({
  rules: {
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
      required: true,
      minlength: 10,
      maxlength: 10
    },
    address: {
      required: true
    },
    dep_id: {
      require_from_group: [1, ".selectone"]
    },
    unit_id: {
      require_from_group: [1, ".selectone"]
    },
    role_id: {
      required: true
    },
    ability_id: {
      required: true
    },
    level_id: {
      required: true
    }
  },
  messages: {
    f_name: "İsim giriniz",
    l_name: "Soyisim giriniz",
    u_name: "Kullanıcı adı giriniz",
    date_of_birth: "Doğum tarihi seçiniz",
    e_mail: {
      required: "E-mail adresi giriniz",
      email: "Geçerli bir e-mail adresi giriniz"
    },
    phone_number: {
      required: "Mobil telefon giriniz",
      minlength: "Mobil telefon en az 10 haneli olmalı",
      maxlength: "Mobil telefon en fazla 10 haneli olmalı"
    },
    address: "Adres giriniz",
    dep_id: {
      require_from_group: "Departman ya da Birim seçiniz"
    },
    unit_id: {
      require_from_group: "Departman ya da Birim seçiniz"
    },
    role_id: "Rol seçiniz",
    ability_id: "Yetenek seçiniz",
    level_id: "Seviye seçiniz"
  },
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

/*$('#validate-userSkill').validate({
  rules: {
    ability_id: {
      required: true
    },
    level_id: {
      required: true
    }
  },
  messages: {
    ability_id: "Yetenek seçiniz",
    level_id: "Seviye seçiniz"
  },
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  submitHandler: function (form) {
    form.submit();
  }
});*/