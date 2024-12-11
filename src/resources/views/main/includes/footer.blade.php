<a href="#top" class="footer__top desctop">
    <div class="footer__top-link">
        <img src="/images/top.svg" alt="top">Наверх
    </div>
</a>
<div class="footer-wrapper py-5">
    <div class="footer-container">
        <div class="footer-promo">
            <div class="footer-promo-logo">
                <div class="header__logo__text in-footer">
                    <a href="/" class="header__logo">
                        <img src="/images/107 LOGO.svg">
                    </a>
                </div>
            </div>
            <div class="footer-promo-text">
                © 2024. Все права защищены, копирование материалов разрешено только с
                указанием активной ссылки. Все упомянутые товарные знаки, названия игр
                и компаний, логотипы, материалы являются собственностью соответствующих
                владельцев.
            </div>
        </div>
        <div class="footer-menu">
            @include ('main.includes.vertical-menu-list', [
                'list'  => config('globals.MenuItems'),
                'title' => 'Меню',
            ])
        </div>
        <div class="footer-pages">
            @include ('main.includes.vertical-menu-list', [
                'list'  => ActionsSystem::Action('PagesList'),
                'title' => 'Компания',
            ])
        </div>
    </div>
</div>