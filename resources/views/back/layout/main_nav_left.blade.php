<aside id="left-panel">
    <nav>
        <ul>
            <li class="">
                <a href="{{ route('admin.index') }}" title=""><i class="fa fa-list-ul"></i><span class="menu-item-parent">Գլխավոր</span></a>
            </li>
{{--            <li class="">--}}
{{--                <a href="#" title="Օգտագործող"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Օգտագործող</span></a>--}}
{{--                <ul>--}}
{{--                    <li class="{{ Menu::isActive('back.user.index') }}">--}}
{{--                        <a href="/back/user" title="Ցուցակ"><span class="menu-item-parent">Ցուցակ</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ Menu::isActive('back.user.create') }} {{ Menu::isActive('back.user.edit') }}">--}}
{{--                        <a href="/back/user/create" title="Ստեղծել"><span class="menu-item-parent">Ստեղծել</span></a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}
            <li class="">
                  <a href="{{ route('admin.users.index') }}" title="Օգագործողներ"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Օգտագործողներ</span></a>
            </li>
            <li class="">
                  <a href="#" title="Կատեգորիա"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Կատեգորիա</span></a>
                  <ul>
                      <li class="">
                          <a href="{{ route('admin.categories.index') }}" title="Ստեղծել"><span class="menu-item-parent">Ցուցակ</span></a>
                      </li>
                      <li class="">
                          <a href="{{ route('admin.categories.create') }}" title="Ստեղծել"><span class="menu-item-parent">Ստեղծել</span></a>
                      </li>
                  </ul>
            </li>
{{--            <li class="">--}}
{{--                  <a href="#" title="Ապրանքներ"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Ապրանք</span></a>--}}
{{--                  <ul>--}}
{{--                      <li class="{{ Menu::isActive('back.product.index') }}">--}}
{{--                          <a href="/back/product/" title="Ցուցակ"><span class="menu-item-parent">Ցուցակ</span></a>--}}
{{--                      </li>--}}
{{--                      <li class="{{ Menu::isActive('back.product.create') }}">--}}
{{--                          <a href="/back/product/create" title="Ստեղծել"><span class="menu-item-parent">Ստեղծել</span></a>--}}
{{--                      </li>--}}
{{--                  </ul>--}}
{{--            </li>--}}
{{--            <li class="{{ Menu::isActive('back.slader.index') }}">--}}
{{--                  <a href="/back/slader" title="Սլայդ"><i class="fa fa-sliders"></i> <span class="menu-item-parent">Սլայդ</span></a>--}}
{{--            </li>--}}
{{--            <li class="{{ Menu::isActive('back.setting.index') }}">--}}
{{--                <a href="{{ route('back.setting.index') }}" title="Կարգավորումներ"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Կարգավորումներ</span></a>--}}
{{--            </li>--}}

{{--            <li class="">--}}
{{--                <a href="#" title="Մենյու"><i class="fa fa-lg fa-fw fa-list-ol"></i> <span class="menu-item-parent">Մենյու</span></a>--}}
{{--                <ul>--}}
{{--                    <li class="{{ Menu::isActive('back.menu.index') }}">--}}
{{--                        <a href="/back/menu/" title="Ցուցակ"><span class="menu-item-parent">Ցուցակ</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ Menu::isActive('back.menu.create') }} {{ Menu::isActive('back.menu.edit') }}">--}}
{{--                        <a href="/back/menu/create" title="Ստեղծել"><span class="menu-item-parent">Ստեղծել</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a href="#" title="Էջեր"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Էջեր</span></a>--}}
{{--                        <ul>--}}
{{--                            <li class="{{ Menu::isActive('back.pages.index') }}">--}}
{{--                                <a href="/back/pages/" title="Ցուցակ"><span class="menu-item-parent">Ցուցակ</span></a>--}}
{{--                            </li>--}}
{{--                            <li class="{{ Menu::isActive('back.pages.create') }} {{ Menu::isActive('back.pages.edit') }}">--}}
{{--                                <a href="/back/pages/create" title="Ստեղծել"><span class="menu-item-parent">Ստեղծել</span></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="{{ Menu::isActive('back.images.add') }}">--}}
{{--                  <a href="/back/images" title="Պատկերներ"><i class="fa fa-lg fa-fw fa-image"></i> <span class="menu-item-parent">Նկարներ</span></a>--}}
{{--            </li>--}}
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>
</aside>
