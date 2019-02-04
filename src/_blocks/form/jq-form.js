;(function() {
  window.FormCustomValidation = class {
    constructor(obj) {
      this.obj = obj;
      this._popup = this.obj.closest(`[data-popup]`);
      this._regExp = {
        EMAIL: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
        FNAME: /^[A-Za-zА-Яа-яЁё]{2,}$/,
        LNAME: /^[A-Za-zА-Яа-яЁё]{2,}$/,
        TEXTAREA: /^.{2,}$/,
        PASSWORD: /^.{6,}$/,
        TEL: /^(\+[0-9][0-9])\s(\([0-9]{3}\))\s([0-9]{3})\s([0-9]{2})\s([0-9]{2})$/
      };
      this.requiredFields = obj.querySelectorAll(`:required`);
      // this.hiddenInputs = obj.querySelectorAll(`[type=hidden]`);
      this.allFields = obj.querySelectorAll(`[data-input]`);
      this.allFieldsWordPress = obj.querySelectorAll(`[data-wp-key]`);
      this.buttonSubmit = obj.querySelector(`[type=submit]`);
      this.buttonSubmit.addEventListener(`click`, (e) => this.checkValidation(e));
      this.agreeCheck = obj.querySelector(`[name="agree"]`);
      this.LANG = document.documentElement.lang.toUpperCase();
      this.passForgotForm = this.obj.hasAttribute(`data-forgot-form`);
      this.sendDataObj = {};

      this.TextError = {
        EMAIL: {
          EN: `E-mail address is invalid! The valid format is x@x.x!`,
          UK: `E-mail має не вірний формат! Вірний формат x@x.x!`,
          RU: `E-mail имеет не верный формат! Верный формат x@x.x!`
        },
        FNAME: {
          EN: `This field must contain letters only!`,
          UK: `Поле має складатися тільки з букв!`,
          RU: `Поле должно состоять только из букв!`
        },
        NAME_LENGTH: {
          EN: `This field must contain 2 letters minimum!`,
          UK: `Поле має складатися мінімум з 2 букв!`,
          RU: `Поле должно состоять минимум из 2 букв!`
        },
        PASSWORD: {
          EN: `This field must contain 6 symbols minimum!`,
          UK: `Поле має складатися мінімум з 6 символів!`,
          RU: `Поле должно состоять минимум из 6 символов!`
        },
        PASSCONFIRM: {
          EN: `This field must contain 6 symbols minimum!`,
          UK: `Поле має складатися мінімум з 6 символів!`,
          RU: `Поле должно состоять минимум из 6 символов!`
        },
        MESSAGE: {
          EN: `This field is requred!`,
          UK: `Це поле є обов\`язковим для заповнення!`,
          RU: `Это поле обязательно для заполнения!`
        },
        SEARCH: {
          EN: `This field is requred!`,
          UK: `Це поле є обов\`язковим для заповнення!`,
          RU: `Это поле обязательно для заполнения!`
        }
      };

      this.FeedbackText = {
        OK: {
          EN: `Thanks! Data accepted`,
          UK: `Дякуємо! Дані прийняті`,
          RU: `Спасибо! Данные приняты`
        },
        ERROR: {
          EN: `Ваши данные не были переданы. Попробуйте пожалуста еще`,
          UK: `Ваші дані не були передані. Спробуйте ще`,
          RU: `Your data wasn't transferred! Try again please`
        },
        FORGOTPASS: {
          EN: `На Ваш адрес отправлено письмо с защищенной ссылкой.`,
          UK: `На Вашу адресу відправлено листа з захищеним посиланням`,
          RU: `An email has been sent to your address with a secure link.`
        }
      };

      if (this.agreeCheck) {
        this.agreeCheck.addEventListener(`click`, (e) => this.buttonSubmit.disabled = e.target.checked == true ? false : true);
      }

      [...this.allFields].forEach((item) => item.addEventListener(`input`, (e) => this._keyInput(item)));
    }

    checkValidation(e) {
      let formValid = [...this.requiredFields].every((item) => this.fieldValidation(item));

      if (formValid) {
        e.preventDefault();
        this._getSendData();
      } else {
        console.warn(`Not correct data`);
      }
    };

    fieldValidation(item) {
      let value = item.value,
            type = item.type;

      if (type == `text`) type = item.name;

      type = type.toUpperCase();

      if (this._regExp[type]) {

        if (value.search(this._regExp[type]) != 0) {
          this._fieldInvalid(item);
          return false;
        } else {
          this._fieldValid(item);
          return true;
        }
      } else {
        console.log(`This field type ${type} was not found in regExp`);
        return true;
      }
    };

    _keyInput(item) {
      if ([...this.requiredFields].indexOf(item) != -1) {
        this.fieldValidation(item);
      } else {
        if (item.value.length) {
          item.dataset.inputDone = true;
        } else {
          item.removeAttribute(`data-input-done`);
        }
      }
    };

    _fieldValid(item) {
      item.removeAttribute(`data-input-error`);
      item.dataset.inputDone = true;
      item.setCustomValidity(``);
    };

    _fieldInvalid(item) {
      item.removeAttribute(`data-input-done`);
      item.dataset.inputError = true;

      const itemType = item.type.toUpperCase();

      if (item.name.toUpperCase() === `FNAME` || item.name.toUpperCase() === `LNAME`) {
        if (item.validity.tooShort) {
          item.setCustomValidity(this.TextError.NAME_LENGTH[this.LANG]);
        } else {
          item.setCustomValidity(this.TextError.FNAME[this.LANG]);
        }
      } else {
        item.setCustomValidity(this.TextError[item.name.toUpperCase()][this.LANG]);
      }
    };

    _getSendData() {
      let signonsecurity = this.obj.querySelector(`#signonsecurity`);
      if(signonsecurity) {
        this.sendDataObj[`security`] = signonsecurity.value;
      }
      this.sendDataObj[`action`] = this.obj.getAttribute(`data-action`);
      this.allFieldsWordPress.forEach((item) => {
        this.sendDataObj[item.getAttribute(`data-wp-key`)] = item.value;
      })

      console.log(this.sendDataObj);
      this._sendData();
    }


    _sendData() {
      $.ajax({
        type: this.obj.method,
        dataType: 'json',
        url: this.obj.action,
        data: this.sendDataObj,
        success: function (data) {
          console.log(data.message);
          console.log(data);
          // window.popupFeedback(data.message);
    // $('p.status', ctrl).text(data.message);
    if (data.loggedin == true) {
        console.log(data.loggedin);
                console.log(data);
                // document.location.href = ajax_auth_object.redirecturl;
            }
        }
    });
    }
    // _sendData(item) {
    //   this.getValueHiddenInputs();
    //   console.log(this.formObj);
    //   fetch(this.obj.action, {
    //     method: this.obj.method,
    //     headers: {
    //       "Content-Type": `application/json`,
    //       "Accept": `application/json`
    //     },
    //     body: JSON.stringify(this.formObj)
    //   })
    //   .then(response => {
    //     console.log(response.text());
    //     return response.json();
    //   })
    //   .then(data => data)
    //   .catch(error => console.log(error))
    // }
  }
})();

;(function(){
  let forms = [...document.querySelectorAll(`[data-form-validate]`)];
  if(!forms) return false;
  forms.map((item) => new FormCustomValidation(item));

  let inputEmail = document.querySelector(`#email`),
      inputUser = document.querySelector(`#user`);

  if (!inputEmail || !inputUser) return false;
    inputEmail.addEventListener(`input`, (e) => {
      inputUser.value = e.target.value;
    })
})();

