<!-- Authorization form -->

<form class="form form--search" action="ajaxregister" method="POST" name="search" data-form-validate>
  <div class="form__inner">
    <label class="form__label">
      <input
        class="form__input"
        type="search"
        minlength="2"
        pattern="^.{2,}$"
        name="search"
        data-input>
      <span class="form__input-text">Поиск</span>
    </label>
    <button type="submit" class="btn btn--red">Войти</button>
  </div>
</form>
