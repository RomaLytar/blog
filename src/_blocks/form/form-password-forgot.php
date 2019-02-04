<!-- Password-forgot-form -->

<form class="form" action="" method="POST" name="registration" data-form-validate data-forgot-form data-action="ajaxforgot">
  <div class="form__inner">
    <div class="form__label-wrap">
      <label class="form__label">
        <input
          class="form__input"
          type="email"
          pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
          name="email"
          required
          data-input
          data-wp-key="email">
        <span class="form__input-text">E-mail*</span>
        <span class="form__input-error">Введите действующий E-mail</span>
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn--red">Отправить</button>
</form>
