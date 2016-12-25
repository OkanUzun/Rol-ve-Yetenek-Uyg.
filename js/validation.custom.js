$('#validate-profileModal').validate({
  onfocusout: false,
  onkeyup: false,
  onclick: false,
  debug: true,
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
  errorPlacement: function (error) {
    showtoast(error.text());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

/*$('#formValidate select').on('change', function (e) {
  $('#formValidate').validate().element($(this));
});*/

$('#validate-profile').validate({
  onfocusout: false,
  onkeyup: false,
  onclick: false,
  debug: true,
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
      required: true
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
  errorPlacement: function (error) {
    showtoast(error.text());
  },
  submitHandler: function (form) {
    form.submit();
  }
});

$('#formValidate select').on('change', function (e) {
  $('#formValidate').validate().element($(this));
});