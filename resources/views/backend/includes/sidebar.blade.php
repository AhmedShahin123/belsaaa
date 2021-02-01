<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/task*'), 'open')
                }}">
                <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/task*'))
                    }}" href="#">
                    <i class="nav-icon far fa-user"></i>
                    @lang('menus.backend.task.title')

                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                                active_class(Route::is('admin/task*'))
                            }}" href="{{ route('admin.task.index') }}">
                            @lang('labels.backend.task.management')

                            @if ($pending_approval > 0)
                                <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                                active_class(Route::is('admin/city*'))
                            }}" href="{{ route('admin.city.index') }}">
                            @lang('labels.backend.city.management')
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{--}}
{{--                                active_class(Route::is('admin/skill*'))--}}
{{--                            }}" href="{{ route('admin.skill.index') }}">--}}
{{--                            @lang('labels.backend.skill.management')--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                                active_class(Route::is('admin/employer*'))
                            }}" href="{{ route('admin.employer.index') }}">
                    <i class="nav-icon far fa-user"></i>
                    @lang('menus.backend.sidebar.employer')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                                active_class(Route::is('admin/tasker*'))
                            }}" href="{{ route('admin.tasker.index') }}">
                    <i class="nav-icon far fa-user"></i>
                    @lang('menus.backend.sidebar.tasker')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item">
                    <a class="nav-link {{
                                active_class(Route::is('admin/notification*'))
                            }}" href="{{ route('admin.notification.index') }}">
                        <i class="nav-icon far fa-bell"></i>
                        @lang('menus.backend.sidebar.notification')
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{
                                active_class(Route::is('admin/setting'))
                            }}" href="{{ url('/settings') }}">
                        <i class="nav-icon fas fa-tools"></i>
                        @lang('menus.backend.sidebar.settings')
                    </a>
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                                active_class(Route::is('admin/auth/role*'))--}}
{{--                            }}" href="{{ route('admin.auth.role.index') }}">--}}
{{--                                @lang('labels.backend.access.roles.management')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                                active_class(Route::is('admin/auth/oauth/token*'))--}}
{{--                            }}" href="{{ route('admin.token.index') }}">--}}
{{--                                @lang('labels.backend.token.management')--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/oauth/client*'))
                            }}" href="{{ route('admin.client.index') }}">
                                @lang('labels.backend.client.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
