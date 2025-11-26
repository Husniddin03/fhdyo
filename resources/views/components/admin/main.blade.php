<!doctype html>

<html lang="en" data-theme="light" data-assets-path="assets/" data-layout-path="dashboard-free/" dir="ltr"
    class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Free - Dashboards | FlyonUI - Powered by FlyonUI</title>

    <meta name="description"
        content=" FlyonUIPro is the best FlyonUI dashboard for responsive web apps. Streamline your app development process with ease." />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href={{ Vite::asset('resources/assets/img/favicon/favicon.ico') }} />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Core CSS -->
    <!-- endbuild -->
    @vite('resources/assets/dist/libs/apexcharts/dist/apexcharts.min.js')
    @vite('resources/assets/dist/libs/flyonui/dist/helper-apexcharts.js')

    <!-- FlyonUI JS -->
    @vite('resources/assets/dist/libs/flyonui/flyonui.js')

    <!-- Theme Utils JS -->
    @vite('resources/assets/dist/js/theme-utils.js')

    <!-- Main JS -->
    @vite('resources/assets/dist/js/main.js')

    <!-- Page JS -->
    @vite('resources/assets/dist/js//common-dashboard-free.js')
    <!-- Vendor CSS -->
    @vite('resources/assets/dist/libs/apexcharts/dist/apexcharts.css')
    {{-- @vite('resources/assets/dist/libs/flyonui/src/vendor/apexcharts.css') --}}

    <!-- build:css -->
    @vite('resources/assets/dist/css/output.css')

    <script src='https://buttons.github.io/buttons.js'></script>

    <!-- Page CSS -->

    <!-- Theme JS -->
    <script type="text/javascript">
        (function() {
            try {
                const root = document.documentElement;
                const layoutPath = root.getAttribute('data-layout-path')?.replace('/', '') || 'dashboard-default';
                const localStorageKey = `${layoutPath}-theme`;

                // Theme configuration loaded from page-config.json at build time
                window.THEME_CONFIG = {
                    'dashboard-free': {
                        default: 'light',
                        light: 'light',
                        dark: 'dark',
                        system: {
                            light: 'light',
                            dark: 'dark'
                        }
                    }
                };

                // Get current system theme preference
                const getSystemPreference = () => window.matchMedia('(prefers-color-scheme: dark)').matches;

                // Resolve theme based on user selection and layout configuration
                const resolveTheme = (selectedTheme, layoutPath) => {
                    const layoutConfig = window.THEME_CONFIG[layoutPath];
                    if (!layoutConfig) return selectedTheme === 'system' ? (getSystemPreference() ? 'dark' :
                        'light') : selectedTheme;

                    if (selectedTheme === 'system') {
                        const systemConfig = layoutConfig.system;
                        const prefersDark = getSystemPreference();
                        return prefersDark ? systemConfig.dark : systemConfig.light;
                    }

                    return layoutConfig[selectedTheme] || selectedTheme || layoutConfig.default || 'light';
                };

                const savedTheme = localStorage.getItem(localStorageKey) || 'system';
                const resolvedTheme = resolveTheme(savedTheme, layoutPath);

                root.setAttribute('data-theme', resolvedTheme);
            } catch (e) {
                console.warn('Early theme script error:', e);
            }
        })();
    </script>
</head>

<body>

    <div class="bg-base-200 flex min-h-screen flex-col">
        <!-- Layout Navbar -->

        <!-- ---------- HEADER ---------- -->
        <div class="bg-base-100 border-base-content/20 lg:ps-75 sticky top-0 z-50 flex border-b">
            <div class="mx-auto w-full max-w-7xl">
                <nav class="navbar py-2">
                    <div class="navbar-start items-center gap-2">
                        <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                            aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                            <span class="icon-[tabler--menu-2] size-4.5"></span>
                        </button>

                        <!-- Search  -->
                        <div class="input no-focus border-0 px-0">
                            <span
                                class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-4 shrink-0"></span>
                            <input type="search" class="grow placeholder:text-sm" placeholder="Type to Search..."
                                id="kbdInput" />
                            <label class="sr-only" for="kbdInput">Search</label>
                        </div>
                    </div>

                    <div class="navbar-end items-end gap-6">

                        <!-- Profile Dropdown -->
                        <div class="dropdown relative inline-flex [--offset:21]">
                            <button id="profile-dropdown" type="button" class="dropdown-toggle avatar"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <span class="rounded-field size-9.5">
                                    <img src={{ Vite::asset('resources/assets/img/avatars/2.png') }}
                                        alt="User Avatar" />
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-open:opacity-100 max-w-75 hidden w-full space-y-0.5"
                                role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                                <li class="dropdown-header pt-4.5 mb-1 gap-4 px-5 pb-3.5">
                                    <div class="avatar avatar-online-top">
                                        <div class="w-10 rounded-full">
                                            <img src={{ Vite::asset('resources/assets/img/avatars/2.png') }}
                                                alt="avatar" />
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="text-base-content mb-0.5 font-semibold">Mitchell Johnson</h6>
                                        <p class="text-base-content/80 font-medium">Influencer</p>
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item px-3" href="#">
                                        <span class="icon-[tabler--user] size-5"></span>
                                        My account
                                    </a>
                                </li>
                                <li class="dropdown-footer p-2 pt-1">
                                    <a class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal"
                                        href="#">
                                        <span class="icon-[tabler--logout] size-5"></span>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Activity Drawer Content  -->
        <div id="activity-drawer" class="overlay overlay-open:translate-x-0 drawer drawer-end sm:max-w-104 hidden"
            role="dialog" tabindex="-1">
            <div class="drawer-header border-base-content/20 border-b p-4">
                <h3 class="drawer-title text-base font-semibold">Activity</h3>
                <button type="button" class="btn btn-text btn-circle btn-xs" aria-label="Close"
                    data-overlay="#activity-drawer">
                    <span class="icon-[tabler--x] size-4"></span>
                </button>
            </div>
            <div class="drawer-body p-0">
                <ul class="space-y-0">
                    <!-- Joe Lincoln Activity -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/1.png') }} alt="avatar" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">joe Lincoln</span>
                                <span class="text-base-content text-sm">mentioned you in last trends topic</span>
                            </div>
                            <p class="text-base-content/50 mb-3 text-sm">18 Mins ago</p>

                            <div class="bg-base-200 rounded-box border-base-content/20 border px-4 py-2.5">
                                <p class="text-base-content mb-4 text-sm font-medium">@Flyonui For an expert opinion,
                                    check out what Mike has to say on this topic!</p>
                                <div class="input input-sm">
                                    <input type="text" class="grow" placeholder="Reply" id="flyonuiReply" />
                                    <span
                                        class="icon-[tabler--photo] text-base-content/80 my-auto ms-2 size-4 shrink-0"></span>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Sofia -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/2.png') }} alt="Sofia" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Sofia</span>
                                <span class="text-base-content text-sm">requested feedback on her design.</span>
                            </div>
                            <p class="text-base-content/50 text-sm">1 Hour ago</p>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Jane Perez File Review -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/3.png') }} alt="Jane Perez" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Jane Perez</span>
                                <span class="text-base-content text-sm">invites you to review a file.</span>
                            </div>
                            <p class="text-base-content/50 mb-2.5 text-sm">3 Hours ago</p>
                            <span class="badge badge-soft badge-lg">
                                <span class="icon-[tabler--file-type-pdf] text-error"></span>
                                invoices.pdf
                            </span>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Liam -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/11.png') }} alt="Liam" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Liam</span>
                                <span class="text-base-content text-sm">has shared a project update.</span>
                            </div>
                            <p class="text-base-content/50 text-sm">5 Hours ago</p>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Tyler Hero Design Project -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/9.png') }} alt="Tyler Hero" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Tyler Hero</span>
                                <span class="text-base-content text-sm">wants to view your design project</span>
                            </div>
                            <p class="text-base-content/50 mb-3 text-sm">18 Mins ago</p>

                            <div
                                class="bg-base-200 rounded-box border-base-content/20 flex items-center gap-4 border px-4 py-2.5">
                                <div class="avatar avatar-placeholder">
                                    <div class="bg-base-100 text-primary rounded-box size-8 p-2">
                                        <img src="https://cdn.flyonui.com/fy-assets/blocks/marketing-ui/brand-logo/figma-icon.png"
                                            alt="avatar" />
                                    </div>
                                </div>
                                <span class="text-sm font-medium">Launcher-UIkit.fig</span>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Denial Invite -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/4.png') }} alt="Denial" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Denial</span>
                                <span class="text-base-content text-sm">Invite from invite link</span>
                            </div>
                            <p class="text-base-content/50 text-sm">3 Hours ago</p>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Leslie Alexander Tags -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/5.png') }}
                                    alt="Leslie Alexander" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Leslie Alexander</span>
                                <span class="text-base-content text-sm">new tags to Web Redesign</span>
                            </div>
                            <p class="text-base-content/50 mb-3 text-sm">18 Mins ago</p>

                            <div class="flex gap-2.5">
                                <span class="badge badge-soft badge-primary badge-sm">Client - Request</span>
                                <span class="badge badge-soft badge-warning badge-sm">Figma</span>
                                <span class="badge badge-soft badge-info badge-sm">Redesign</span>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="divider"></div>
                    </li>

                    <!-- Miya File Review -->
                    <li class="flex items-start gap-4 p-4">
                        <div class="avatar">
                            <div class="size-8 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/6.png') }} alt="Miya" />
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-1">
                                <span class="text-base-content font-semibold">Miya</span>
                                <span class="text-base-content text-sm">invites you to review a file.</span>
                            </div>
                            <p class="text-base-content/50 text-sm">10 Hours ago</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ---------- END HEADER ---------- -->
        <!-- Menu -->
        <aside id="layout-sidebar"
            class="overlay overlay-open:translate-x-0 drawer drawer-start sm:w-75 inset-y-0 start-0 hidden h-full [--auto-close:lg] lg:z-50 lg:block lg:translate-x-0 lg:shadow-none"
            aria-label="Sidebar" tabindex="-1">
            <div class="drawer-body border-base-content/20 h-full border-e p-0">
                <div class="flex h-full max-h-full flex-col">
                    <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3 lg:hidden"
                        aria-label="Close" data-overlay="#layout-sidebar">
                        <span class="icon-[tabler--x] size-4.5"></span>
                    </button>
                    <div
                        class="text-base-content border-base-content/20 flex flex-col items-center gap-4 border-b px-4 py-6">
                        <div class="avatar">
                            <div class="size-17 rounded-full">
                                <img src={{ Vite::asset('resources/assets/img/avatars/2.png') }} alt="avatar" />
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="text-base-content text-lg font-semibold">Mitchell Johnson</h3>
                            <p class="text-base-content/80">flyonui@mitchell</p>
                        </div>
                    </div>
                    <div class="h-full overflow-y-auto">
                        <ul class="accordion menu menu-sm gap-1 p-3">
                            <!-- Accordion Menu Item (Level 0) -->
                            <li class="active accordion-item" id="dashboard">
                                <button
                                    class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                    aria-controls="dashboard-collapse-dashboard" aria-expanded="true">
                                    <span class="icon-[tabler--dashboard] size-4.5"></span>
                                    <span class="grow">Asosiy</span>
                                    <span
                                        class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                </button>
                                <div id="dashboard-collapse-dashboard"
                                    class="accordion-content mt-1 block w-full overflow-hidden transition-[height] duration-300"
                                    aria-labelledby="dashboard" role="region">
                                    <ul class="space-y-1">
                                        <!-- Simple Link Item (for nested items) -->
                                        <li>
                                            <a href="{{route('admin.index')}}"  class="{{$page=='admin.index'?'menu-active':''}} inline-flex w-full items-center px-2">
                                                <span>Satistika</span>
                                            </a>
                                        </li>

                                        <!-- Simple Link Item (for nested items) -->
                                        <li>
                                            <a href="{{route('admin.users.index')}}" class="{{$page=='admin.users.index'?'menu-active':''}} inline-flex w-full items-center px-2">
                                                <span class="grow">Foydalanuvchilar</span>
                                            </a>
                                        </li>

                                        <!-- Simple Link Item (for nested items) -->
                                        <li>
                                            <a href="#" class="inline-flex w-full items-center px-2"
                                                >
                                                <span class="grow">Yangi foydalanuvchi</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Accordion Menu Item (Level 0) -->
                            <li class="accordion-item" id="authentications">
                                <button
                                    class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                    aria-controls="authentications-collapse-authentications" aria-expanded="true">
                                    <span class="icon-[tabler--lock] size-4.5"></span>
                                    <span class="grow">Viloyatlar</span>
                                    <span
                                        class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                </button>
                                <div id="authentications-collapse-authentications"
                                    class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                    aria-labelledby="authentications" role="region">
                                    <ul class="accordion space-y-1">
                                        <!-- Accordion Menu Item (Level 1) -->
                                        <li class="accordion-item" id="authentications-login">
                                            <button
                                                class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                                aria-controls="login-collapse-authentications-login"
                                                aria-expanded="true">
                                                <span class="grow">Toshkent</span>
                                                <span
                                                    class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                            </button>
                                            <div id="login-collapse-authentications-login"
                                                class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                                aria-labelledby="authentications-login" role="region">
                                                <ul class="space-y-1">
                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="auth-login-1.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span>Chirchiq</span>
                                                        </a>
                                                    </li>

                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="https://demos.flyonui.com/templates/html/dashboard-default/auth-login-2.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span class="grow">Bekaobod</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Accordion Menu Item (Level 1) -->
                                        <li class="accordion-item" id="authentications-register">
                                            <button
                                                class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                                aria-controls="register-collapse-authentications-register"
                                                aria-expanded="true">
                                                <span class="grow">Jizzax</span>
                                                <span
                                                    class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                            </button>
                                            <div id="register-collapse-authentications-register"
                                                class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                                aria-labelledby="authentications-register" role="region">
                                                <ul class="space-y-1">
                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="auth-register-1.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span>Jizzax</span>
                                                        </a>
                                                    </li>

                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="https://demos.flyonui.com/templates/html/dashboard-default/auth-register-2.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span class="grow">Baxmal</span>
                                                            <span
                                                                class="badge badge-primary badge-sm badge-soft">Pro</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Accordion Menu Item (Level 1) -->
                                        <li class="accordion-item" id="authentications-forgot-password">
                                            <button
                                                class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                                aria-controls="forgot-password-collapse-authentications-forgot-password"
                                                aria-expanded="true">
                                                <span class="grow">Surxandaryo</span>
                                                <span
                                                    class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                            </button>
                                            <div id="forgot-password-collapse-authentications-forgot-password"
                                                class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                                aria-labelledby="authentications-forgot-password" role="region">
                                                <ul class="space-y-1">
                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="auth-forgot-password-1.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span>Termiz</span>
                                                        </a>
                                                    </li>

                                                    <!-- Simple Link Item (for nested items) -->
                                                    <li>
                                                        <a href="https://demos.flyonui.com/templates/html/dashboard-default/auth-forgot-password-2.html"
                                                            class="inline-flex w-full items-center px-2"
                                                            >
                                                            <span class="grow">Sho'rchi</span>
                                                            <span
                                                                class="badge badge-primary badge-sm badge-soft">Pro</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <!-- Accordion Menu Item (Level 0) -->
                            <li class="accordion-item" id="datatable">
                                <button
                                    class="accordion-toggle accordion-item-active:bg-neutral/10 inline-flex w-full items-center p-2 text-start text-sm font-normal"
                                    aria-controls="datatable-collapse-datatable" aria-expanded="true">
                                    <span class="icon-[tabler--table] size-4.5"></span>
                                    <span class="grow">Adminlar</span>
                                    <span
                                        class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-4.5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                </button>
                                <div id="datatable-collapse-datatable"
                                    class="accordion-content mt-1 hidden w-full overflow-hidden transition-[height] duration-300"
                                    aria-labelledby="datatable" role="region">
                                    <ul class="space-y-1">
                                        <!-- Simple Link Item (for nested items) -->
                                        <li>
                                            <a href="https://demos.flyonui.com/templates/html/dashboard-default/tables-datatables-basic.html"
                                                class="inline-flex w-full items-center px-2" >
                                                <span>Adminlar</span>
                                            </a>
                                        </li>

                                        <!-- Simple Link Item (for nested items) -->
                                        <li>
                                            <a href="https://demos.flyonui.com/templates/html/dashboard-default/tables-datatables-advanced.html"
                                                class="inline-flex w-full items-center px-2" >
                                                <span>Yangi admin</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown relative inline-flex w-full p-2 [--offset:5] [--placement:bottom]">
                        <button id="workshop-dropdown" type="button"
                            class="dropdown-toggle bg-base-200 rounded-box flex w-full items-center gap-4 px-4 py-2.5"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            <span class="avatar">
                                <span class="size-9.5">
                                    <span class="text-primary">
                                        <svg width="38" height="38" viewBox="0 0 34 34" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_18078_104881)">
                                                <mask id="mask0_18078_104881" style="mask-type:luminance"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="34"
                                                    height="34">
                                                    <path
                                                        d="M25.5 0H8.5C3.80558 0 0 3.80558 0 8.5V25.5C0 30.1944 3.80558 34 8.5 34H25.5C30.1944 34 34 30.1944 34 25.5V8.5C34 3.80558 30.1944 0 25.5 0Z"
                                                        fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_18078_104881)">
                                                    <path
                                                        d="M25.5 0H8.5C3.80558 0 0 3.80558 0 8.5V25.5C0 30.1944 3.80558 34 8.5 34H25.5C30.1944 34 34 30.1944 34 25.5V8.5C34 3.80558 30.1944 0 25.5 0Z"
                                                        fill="url(#paint0_linear_18078_104881)" />
                                                    <path
                                                        d="M16.1238 20.1522C16.511 19.662 17.2479 19.6428 17.66 20.1122L20.5526 23.41C21.1194 24.0563 20.6611 25.0689 19.8016 25.0692H14.3055C13.47 25.0692 13.0026 24.1059 13.5203 23.4501L16.1238 20.1522ZM16.1326 8.45497C16.5308 7.95801 17.286 7.95453 17.6883 8.44813L27.5164 20.5077C28.0488 21.161 27.5838 22.1395 26.741 22.1395H24.4442C24.1428 22.1395 23.8577 22.0034 23.6678 21.7694L17.7029 14.4188C17.2962 13.9175 16.5285 13.927 16.1346 14.4384L10.7303 21.454C10.5411 21.6996 10.2484 21.8435 9.9383 21.8436H7.4881C6.64925 21.8436 6.18332 20.8733 6.70783 20.2186L16.1326 8.45497Z"
                                                        fill="url(#paint1_linear_18078_104881)" />
                                                </g>
                                                <path
                                                    d="M25.5002 0.707886H8.50017C4.19695 0.707886 0.708496 4.19634 0.708496 8.49956V25.4996C0.708496 29.8028 4.19695 33.2912 8.50017 33.2912H25.5002C29.8034 33.2912 33.2918 29.8028 33.2918 25.4996V8.49956C33.2918 4.19634 29.8034 0.707886 25.5002 0.707886Z"
                                                    stroke="url(#paint2_linear_18078_104881)" stroke-width="2" />
                                            </g>
                                            <defs>
                                                <linearGradient id="paint0_linear_18078_104881" x1="30.2812"
                                                    y1="2.65625" x2="4.25" y2="32.4063"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" stop-color="currentColor" />
                                                    <stop offset="1" stop-color="currentColor" />
                                                </linearGradient>
                                                <linearGradient id="paint1_linear_18078_104881" x1="17.1147"
                                                    y1="8.08008" x2="17.1147" y2="25.0692"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" stop-color="white" />
                                                    <stop offset="1" stop-color="white" stop-opacity="0.6" />
                                                </linearGradient>
                                                <linearGradient id="paint2_linear_18078_104881" x1="17.0002"
                                                    y1="-0.000447931" x2="17.0002" y2="33.9996"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop offset="0" stop-color="white" stop-opacity="0.28" />
                                                    <stop offset="1" stop-color="white" stop-opacity="0.04" />
                                                </linearGradient>
                                                <clipPath id="clip0_18078_104881">
                                                    <rect width="34" height="34" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                </span>
                            </span>

                            <span class="flex flex-1 flex-col text-start">
                                <span class="text-base-content font-semibold">Kirishlar tarixi</span>
                                <span class="text-base-content/80 text-sm">tarix</span>
                            </span>
                            <span
                                class="icon-[tabler--chevron-up] dropdown-open:rotate-180 size-6 transition-transform duration-300"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-60 space-y-2"
                            role="menu" aria-orientation="vertical" aria-labelledby="workshop-dropdown">

                            <li>
                                <a class="dropdown-item px-3 py-2" href="#">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="size-9.5">
                                                <img src={{ Vite::asset('resources/assets/img/shadcn-logo.png') }}
                                                    alt="shadcn-studio" />
                                            </div>
                                        </div>
                                        <div class="flex-1 text-start">
                                            <h6 class="text-base-content font-semibold">Hammasini ko'rish</h6>
                                            <p class="text-base-content/80 text-sm">Workspace</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- / Menu -->
        {{ $slot }}
    </div>
    <button id="scrollToTopBtn"
        class="btn btn-circle btn-soft btn-secondary/20 bottom-15 end-15 motion-preset-slide-right motion-duration-800 motion-delay-100 fixed absolute z-[3] hidden"
        aria-label="Circle Soft Icon Button"><span class="icon-[tabler--chevron-up] size-5 shrink-0"></span></button>
</body>

</html>
