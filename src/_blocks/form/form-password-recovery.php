<!-- Password-forgot-recovery -->

<form class="form" action="" method="POST" name="registration" data-form-validate data-action="ajaxrecovery">
  <div class="form__inner">
    <div class="form__label-wrap">
      <label class="form__label">
        <input class="form__input"
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

      <label class="form__label">
        <input class="form__input"
          type="password"
          minlength="2"
          pattern="[0-9a-fA-F]{6,}$"
          name="passconfirm"
          required
          data-input>
        <span class="form__input-text">Пароль(подтверждение)*</span>
        <span class="form__input-error">Минимум 6 символов</span>
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn--red">Сохранить</button>
</form>
