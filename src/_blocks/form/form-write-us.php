 <!-- Write us form  -->

<form class="form" action="" method="POST" name="write-us" data-form-validate data-action="ajaxwrite">
  <div class="form__inner">
    <label class="form__label">
      <input
        class="form__input"
        type="text"
        minlength="2"
        pattern="^[A-Za-zА-Яа-яЁё]{2,}$"
        name="fname"
        required
        data-input
        data-wp-key="first_name">

      <span class="form__input-text">Имя*</span>
      <span class="form__input-error">Ваше имя</span>
    </label>
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
    <label class="form__label">
      <textarea
        class="form__input form__input--textarea"
        minlength="2"
        pattern="^.{2,}$"
        name="message"
        data-input
        data-wp-key="message">

      </textarea>
      <span class="form__input-text">Ваше сообщение</span>
    </label>
  </div>
  <button type="submit" class="btn btn--red">Отправить</button>
</form>
