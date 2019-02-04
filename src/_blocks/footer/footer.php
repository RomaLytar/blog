<div class="footer">
  <div class="wrap">
    <div class="footer__inner">
      <div class="footer__menu footer__column">
          <?php echo clean_custom_menus(); ?>
      </div>
      <div class="footer__contact footer__column">
        <h3 class="footer__title"><?php pll_e('Contacts') ?></h3>
          <?php if(get_option('my_address') != ''): ?>
          <p><?php pll_e(get_option('my_address')); ?></p>
          <?php endif; ?>
        <p><a href="mailto:email@email.email" title="Mail us now">Email: <?php echo get_option('admin_email '); ?></a></p>
      </div>
      <div class="footer__column footer__social">
        <ul class="footer__social-list">
            <?php if(get_option('my_facebook') != ''): ?>
              <li class="footer__social-item">
                <span class="visually-hidden">Facebook</span>
                <a href="<?php echo get_option('my_facebook'); ?>" title="Facebook" class="footer__social-link">
                  <svg width="12" height="12" fill="#fff">
                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-facebook"/>
                  </svg>
                </a>
              </li>
            <?php endif; ?>
            <?php if(get_option('my_twitter') != ''): ?>
              <li class="footer__social-item">
                <span class="visually-hidden">Twitter</span>
                <a href="<?php echo get_option('my_twitter'); ?>" title="Twitter" class="footer__social-link">
                  <svg width="12" height="12" fill="#fff">
                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-twitter"/>
                  </svg>
                </a>
              </li>
            <?php endif; ?>
            <?php if(get_option('my_instagram') != ''): ?>
              <li class="footer__social-item">
                <span class="visually-hidden">Instagram</span>
                <a href="<?php echo get_option('my_instagram'); ?>" title="Instagram" class="footer__social-link">
                  <svg width="12" height="12" fill="#fff">
                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-instagram"/>
                  </svg>
                </a>
              </li>
            <?php endif; ?>
            <?php if(get_option('my_youtude') != ''): ?>
              <li class="footer__social-item">
                <span class="visually-hidden">YouTube</span>
                <a href="<?php echo get_option('my_youtude'); ?>" title="YouTube" class="footer__social-link">
                  <svg width="12" height="12" fill="#fff">
                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-youtube"/>
                  </svg>
                </a>
              </li>
            <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer__copyright">
    <div class="wrap">
      <p>© <span id="current-year"><?php echo date('Y'); ?></span><?php pll_e('CXID Opera All rights reserved') ?></p>
      <p><?php pll_e('The use of any materials posted on the site is permitted provided the link to the site') ?></p>
    </div>
  </div>
</div>

