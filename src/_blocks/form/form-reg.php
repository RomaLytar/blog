<!-- Registration form -->

<form action="<?php echo admin_url(); ?>admin-ajax.php" method="post"  name="registration" data-form-validate data-action="ajaxregister">
    <div class="form__inner">
        <label class="form__label">
            <input
              class="form__input"
              type="text"
              minlength="2"
              pattern="^[A-Za-zА-Яа-яЁё]{2,}$"
              name="fname"
              required
              data-required
              data-input
              data-wp-key="first_name">

            <span class="form__input-text">Имя*</span>
            <span class="form__input-error">Ваше имя</span>
        </label>
        <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>
        <label class="form__label">
            <input
              class="form__input"
              type="text"
              minlength="2"
              pattern="^[A-Za-zА-Яа-яЁё]{2,}$"
              name="lname"
              required
              data-required
              data-input
              data-wp-key="last_name">

            <span class="form__input-text">Фамилия*</span>
            <span class="form__input-error">Фаша фамилия</span>
        </label>
        <div class="form__label-wrap">
            <label class="form__label">
                <input
                class="form__input"
                id="user"
                required
                data-required
                data-input
                type="hidden"
                data-type="email"
                pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                name="username"
                data-wp-key="username">

                <input
                class="form__input"
                id="email"
                type="email"
                pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                name="email"
                required
                data-required
                data-input
                data-wp-key="email">

                <span class="form__input-text">E-mail*</span>
                <span class="form__input-error">Введите действующий E-mail</span>
            </label>
            <a href="#" class="form__email-link" data-popup-link="ru-mail">Владельцам ящиков яндекс и mail.ru</a>
        </div>
        <label class="form__label">
            <input
              class="form__input"
              type="password"
              minlength="2"
              pattern="[0-9a-fA-F]{6,}$"
              name="password"
              required
              data-required
              data-input
              data-wp-key="password">

            <span class="form__input-text">Пароль*</span>
            <span class="form__input-error">Минимум 6 символов</span>
        </label>
        <label class="form__label">
            <input
              class="form__input"
              type="password"
              minlength="2"
              pattern="[0-9a-fA-F]{6,}$"
              name="passconfirm"
              required
              data-required
              data-input>

            <span class="form__input-text">Пароль(подтверждение)*</span>
            <span class="form__input-error">Минимум 6 символов</span>
        </label>
        <div class="form__privacy">
            <p class="form__privacy-title">Пользовательское соглашение</p>
            <div class="form__privacy-descr">
                <p>Нажимая кнопку «Зарегистрироваться», я принимаю условия <a href="#">Договор пользователя сайтом</a>, ознакомлен с <a href="#">Правилами пользования сайтом</a> и правилами <a href="#">Использования материалов</a>,  и даю свое согласие блогу театра Схид Опера на обработку моих персональных данных в соответствии с Законом Украины «О защите персональных данных».</p>
            </div>
        </div>
        <label class="form__label form__label--agree">
            <input
              class="visually-hidden form__input-checkbox"
              type="checkbox"
              name="agree"
              checked>

            <span class="form__input-checkbox-icon"></span>
            <span class="form__input-checkbox-text">Я хочу получать рассылку новостей блога театра Схид Опреа на E-mail</span>
        </label>
        <input type="submit" class="btn btn--red btn--big" name="submit" value="Зарегистрироваться"/>
</form>

