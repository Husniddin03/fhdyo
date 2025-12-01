<!doctype html>

<html lang="en" data-theme="light" data-assets-path="../assets/" data-layout-path="dashboard-free/" dir="ltr"
    class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Login</title>

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
    <!-- Layout wrapper -->
    <!-- Content -->
    <div
        class="flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-[url('../../img/illustrations/auth-background-2.png')] bg-cover bg-center bg-no-repeat py-10">
        <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div
                class="bg-base-100 shadow-base-300/20 z-1 sm:min-w-md w-full space-y-6 rounded-xl p-6 shadow-md lg:p-8">
                <div class="space-y-4">
                    <form class="mb-4 space-y-4" action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div>
                            <label class="label-text" for="userEmail">Email address*</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address"
                                class="input" id="userEmail" required />
                        </div>
                        <div>
                            <label class="label-text" for="userPassword">Password*</label>
                            <div class="input">
                                <input id="userPassword" value="{{ old('password') }}" type="password" name="password"
                                    placeholder="············" required />
                                <button type="button" data-toggle-password='{ "target": "#userPassword" }'
                                    class="block cursor-pointer" aria-label="userPassword">
                                    <span
                                        class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                    <span
                                        class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-gradient btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
