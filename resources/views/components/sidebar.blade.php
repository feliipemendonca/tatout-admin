@switch(auth()->user()->getRole())
    @case("company")
        @php
            $dashboard = [
                [
                    'title' => 'Inicio',
                    'route' => 'index',
                    'icon' => '<i data-feather="home"></i>',
                ],
                [
                    'title' => 'Vendedores',
                    'route' => 'index',
                    'icon' => '<i data-feather="user"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.vendedores.index',
                        ],
                        [
                            'title' => 'Novo usuário',
                            'route' => 'dashboard.vendedores.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Passeios',
                    'route' => 'index',
                    'icon' => '<i data-feather="shopping-cart"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.passeios.index',
                        ],
                        [
                            'title' => 'Novo passeio',
                            'route' => 'dashboard.passeios.create',
                        ],
                    ],
                ],
            ];

            $settings = [ ];
        @endphp
        @break
    @default
        @php
            $dashboard = [
                [
                    'title' => 'Inicio',
                    'route' => 'index',
                    'icon' => '<i data-feather="home"></i>',
                ],
                [
                    'title' => 'Fornecedores',
                    'route' => 'index',
                    'icon' => '<i data-feather="box"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.fornecedores.index',
                        ],
                        [
                            'title' => 'Novo fornecedor',
                            'route' => 'dashboard.fornecedores.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Vendedores',
                    'route' => 'index',
                    'icon' => '<i data-feather="user"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.vendedores.index',
                        ],
                        [
                            'title' => 'Novo usuário',
                            'route' => 'dashboard.vendedores.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Tipo de produto',
                    'route' => 'index',
                    'icon' => '<i data-feather="list"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.tipo-produto.index',
                        ],
                        [
                            'title' => 'Novo tipo',
                            'route' => 'dashboard.tipo-produto.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Passeios',
                    'route' => 'index',
                    'icon' => '<i data-feather="shopping-cart"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.passeios.index',
                        ],
                        [
                            'title' => 'Novo passeio',
                            'route' => 'dashboard.passeios.create',
                        ],
                    ],
                ],
            ];

            $settings = [
                [
                    'title' => 'Nível de Acesso',
                    'route' => 'index',
                    'icon' => '<i data-feather="lock"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.roles.index',
                        ],
                        [
                            'title' => 'Novo Nível',
                            'route' => 'dashboard.roles.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Permissões de Acesso',
                    'route' => 'index',
                    'icon' => '<i data-feather="command"></i>',
                    'dropdown' => [
                        [
                            'title' => 'Listar',
                            'route' => 'dashboard.permission.index',
                        ],
                        [
                            'title' => 'Novo Nível',
                            'route' => 'dashboard.permission.create',
                        ],
                    ],
                ],
                [
                    'title' => 'Logs',
                    'route' => 'dashboard.logs',
                    'icon' => '<i data-feather="activity"></i>'
                ],
            ];
        @endphp
@endswitch

<header class="main-nav">
    <div class="sidebar-user text-center">
        {{-- <a class="setting-primary" href="javascript:void(0)">
            <i data-feather="settings"></i>
        </a> --}}
        <img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom">
            <span class="badge badge-primary">New</span>
        </div>
        <a href="#">
            <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ auth()->user()->type() }}</p>
        {{-- <ul>
            <li>
                <span>
                    <span class="counter">19.8</span>k
                </span>
                <p>Follow</p>
            </li>
            <li>
                <span>2 year</span>
                <p>Experince</p>
            </li>
            <li>
                <span><span class="counter">95.2</span>k</span>
                <p>Follower</p>
            </li>
        </ul> --}}
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    @foreach ($dashboard as $item)
                        <li class="dropdown">
                            {{-- <a class="nav-link menu-title {{ @$item['dropdown'] ? prefixActive($item['route']) : ' link-nav ' . routeActive('contacts') }}" --}}
                            <a class="nav-link menu-title"
                                href="{{ @$item['dropdown'] ? 'javascript:void(0)' : route($item['route']) }}">
                                {!! $item['icon'] !!}
                                <span>{{ $item['title'] }}</span>
                            </a>

                            @isset($item['dropdown'])
                                {{-- <ul class="nav-submenu menu-content" style="display: {{ prefixBlock($item['route']) }};"> --}}
                                <ul class="nav-submenu menu-content">
                                    @foreach ($item['dropdown'] as $drop)
                                        <li>
                                            <a href="{{ route($drop['route']) }}"
                                                {{-- class="{{ routeActive($drop['route']) }}">{{ $drop['title'] }}</a> --}}
                                            >{{ $drop['title'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endisset
                        </li>
                    @endforeach
                    @if (count($settings) > 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Configurações</h6>
                            </div>
                        </li>
                        @foreach ($settings as $item)
                            <li class="dropdown">
                                {{-- <a class="nav-link menu-title {{ @$item['dropdown'] ? prefixActive($item['route']) : ' link-nav ' . routeActive('contacts') }}" --}}
                                <a class="nav-link menu-title"
                                    href="{{ @$item['dropdown'] ? 'javascript:void(0)' : route($item['route']) }}">
                                    {!! $item['icon'] !!}
                                    <span>{{ $item['title'] }}</span>
                                </a>

                                @isset($item['dropdown'])
                                    {{-- <ul class="nav-submenu menu-content" style="display: {{ prefixBlock($item['route']) }};"> --}}
                                    <ul class="nav-submenu menu-content">
                                        @foreach ($item['dropdown'] as $drop)
                                            <li>
                                                <a href="{{ route($drop['route']) }}"
                                                    {{-- class="{{ routeActive($drop['route']) }}">{{ $drop['title'] }}</a> --}}
                                                >{{ $drop['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </div>
    </nav>
</header>