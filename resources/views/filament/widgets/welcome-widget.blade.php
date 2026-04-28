<x-filament-widgets::widget class="fi-wi-welcome">
    <x-filament::section>
        <div style="position: relative; padding: 0.5rem;">
            <!-- Decorative gradient orb -->
            <div style="position: absolute; top: -40px; right: -40px; width: 160px; height: 160px; border-radius: 9999px; opacity: 0.15; filter: blur(40px); pointer-events: none; background: linear-gradient(to bottom right, {{ $gradientColors }})"></div>
            <div style="position: absolute; bottom: -40px; left: -40px; width: 128px; height: 128px; border-radius: 9999px; opacity: 0.15; filter: blur(32px); pointer-events: none; background: linear-gradient(to top right, {{ $gradientColors }})"></div>

            <div style="position: relative; z-index: 10; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.5rem;">
                <!-- Left: Greeting & Info -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem;">
                    <!-- Icon Badge -->
                    <div style="flex-shrink: 0; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, {{ $gradientColors }})">
                        <x-filament::icon
                            alias="heroicon-m-sun"
                            icon="{{ $icon }}"
                            style="width: 24px; height: 24px; color: white;"
                        />
                    </div>

                    <!-- Text Content -->
                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                        <h2 class="text-gray-900 dark:text-white" style="font-size: 1.125rem; font-weight: 700; margin: 0; line-height: 1.2;">
                            {{ $greeting }}, <span style="font-weight: 900;">{{ $userName }}</span>!
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400" style="font-size: 0.875rem; margin: 0;">
                            {{ $subText }}
                        </p>
                        <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; margin-top: 4px;">
                            <span class="bg-gray-100 text-gray-600 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700" style="display: inline-flex; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; border-width: 1px; border-style: solid;">
                                <x-filament::icon
                                    alias="heroicon-m-shield-check"
                                    icon="heroicon-m-shield-check"
                                    class="text-gray-500 dark:text-gray-400"
                                    style="width: 12px; height: 12px;"
                                />
                                {{ $userRole }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400" style="font-size: 0.75rem;">
                                {{ $currentTime }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right: Decorative Element -->
                <div style="display: flex; align-items: center; gap: 0.75rem; opacity: 0.8;">
                    <div class="bg-gray-200 dark:bg-gray-700" style="height: 32px; width: 1px;"></div>
                    <div style="display: flex; flex-direction: column; align-items: flex-end;">
                        <span class="text-gray-500 dark:text-gray-400" style="font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Portal Admin</span>
                        <span class="text-gray-900 dark:text-white" style="font-size: 0.875rem; font-weight: 700;">Desa Adat Tamanbali</span>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
