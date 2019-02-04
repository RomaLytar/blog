<!-- Authorization form -->

<form class="form" action="" method="POST" name="registration" data-form-validate data-action="ajaxauthorization">
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
    <label class="form__label">
      <input
        class="form__input"
        type="password"
        minlength="2"
        pattern="[0-9a-fA-F]{6,}$"
        name="password"
        required
        data-input
        data-wp-key="password">
      <span class="form__input-text">Пароль*</span>
      <span class="form__input-error">Минимум 6 символов</span>
    </label>
    <p class="form__link-popup">
      <a href="/passwort-forgot">Забыли пароль?</a>
    </p>
  </div>
  <button type="submit" class="btn btn--red">Войти</button>
</form>
