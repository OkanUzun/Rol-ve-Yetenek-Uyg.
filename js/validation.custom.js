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

$('#validate-userInfo').validate({
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
    role_id: "Rol seçiniz"
  },
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-newPassword').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    email: {
      required: true,
      email: true
    },
    new_password: {
      required: true,
      minlength: 6
    },
    new_password_again: {
      required: true,
      equalTo: "#new_password",
      minlength: 6
    }
  },
  messages: {
    email: {
      required: "E-mail adresi giriniz",
      email: "Geçerli bir e-mail adresi giriniz"
    },
    new_password: {
      required: "Yeni şifre giriniz",
      minlength: "Şifreniz en az 6 karakter olmalıdır"
    },
    new_password_again: {
      required: "Şifrenizi tekrar giriniz",
      equalTo: "Şifreleriniz aynı olmalı",
      minlength: "Şifreniz en az 6 karakter olmalıdır"
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-passRevovery').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    email: {
      required: "E-mail adresi giriniz",
      email: "Geçerli bir e-mail adresi giriniz"
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-instructor').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    user_id: {
      require_from_group: [1, ".selectone"]
    },
    educator_name: {
      require_from_group: [1, ".selectone"]
    }
  },
  messages: {
    user_id: {
      require_from_group: "Eğitimci Seçiniz"
    },
    educator_name: {
      require_from_group: "Eğitimci Giriniz"
    }
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-courseInfo').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    education_name: {
      required: true
    },
    educator_id: {
      required: true
    },
    lounge_id: {
      required: true
    },
    started_date: {
      required: true
    },
    complete_date: {
      required: true
    },
    education_detail: {
      required: true
    }
  },
  messages: {
    education_name: "Eğitim adı giriniz",
    educator_id: "Eğitmen seçiniz",
    lounge_id: "Salon seçiniz",
    started_date: "Başlangıç tarihi seçiniz",
    complete_date: "Bitiş tarihi seçiniz",
    education_detail: "Eğitim detayı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-courseCreate').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    course_name: {
      required: true
    },
    educator_id: {
      required: true
    },
    lounge_id: {
      required: true
    },
    starting_date: {
      required: true
    },
    complete_date: {
      required: true
    },
    course_detail: {
      required: true
    }
  },
  messages: {
    course_name: "Eğitim adı giriniz",
    educator_id: "Eğitmen seçiniz",
    lounge_id: "Salon seçiniz",
    starting_date: "Başlangıç tarihi seçiniz",
    complete_date: "Bitiş tarihi seçiniz",
    course_detail: "Eğitim detayı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-abilityCreate').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    ability_name: {
      required: true
    }
  },
  messages: {
    ability_name: "Yetenek adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-abilityModal').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    ability_name: {
      required: true
    }
  },
  messages: {
    ability_name: "Yetenek adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-roleCreate').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    role_name: {
      required: true
    }
  },
  messages: {
    role_name: "Rol adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-roleModal').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    role_name: {
      required: true
    }
  },
  messages: {
    role_name: "Rol adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-unitCreate').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    unit_name: {
      required: true
    },
    dep_id: {
      required: true
    }
  },
  messages: {
    unit_name: "Birim adı giriniz",
    dep_id: "Departman seçiniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-unitModal').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    unit_name: {
      required: true
    }
  },
  messages: {
    unit_name: "Birim adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-departmentCreate').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    dep_name: {
      required: true
    }
  },
  messages: {
    dep_name: "Departman adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#validate-departmentModal').validate({
  errorPlacement: function (error, element) {
    error.appendTo(element.parent());
  },
  rules: {
    dep_name: {
      required: true
    }
  },
  messages: {
    dep_name: "Departman adı giriniz"
  },
  submitHandler: function (form) {
    form.submit();
  }
});