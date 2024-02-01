<?php

namespace Infinity\Jumpstart;

use Illuminate\Support\Facades\File;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelJumpstartServiceProvider extends PackageServiceProvider
{
    const PACKAGE_JSON = 'package.json';

    const NPM_COMMANDS = [
        'dev' => 'vite',
        'build' => 'run-p type-check "build-only {@}" --',
        'preview' => 'vite preview',
        'test:unit' => 'vitest --dir ./resources/ts/',
        'build-only' => 'vite build',
        'type-check' => 'vue-tsc --build --force',
        'lint' => 'eslint . --ext .vue,.js,.jsx,.cjs,.mjs,.ts,.tsx,.cts,.mts --fix --ignore-path .gitignore',
        'format' => 'prettier --write ./resources/ts/'
    ];

    const NPM_DEPENDENCIES = [
        '@rushstack/eslint-patch' => '^1.6.1',
        '@tailwindcss/forms' => '^0.5.3',
        '@tsconfig/node18' => '^18.2.2',
        '@types/jsdom' => '^21.1.6',
        '@types/node' => '^18.19.3',
        '@vitejs/plugin-vue' => '^4.5.2',
        '@vue/eslint-config-prettier' => '^8.0.0',
        '@vue/eslint-config-typescript' => '^12.0.0',
        '@vue/test-utils' => '^2.4.3',
        '@vue/tsconfig' => '^0.5.0',
        '@vueuse/core' => '^10.7.2',
        'autoprefixer' => '^10.4.2',
        'axios' => '^1.6.1',
        'dotenv' => '^16.3.1',
        'eslint' => '^8.56.0',
        'eslint-plugin-vue' => '^9.19.0',
        'jsdom' => '^23.0.1',
        'laravel-vite-plugin' => '^1.0.1',
        'npm-run-all2' => '^6.1.1',
        'pinia' => '^2.1.7',
        'postcss' => '^8.4.32',
        'prettier' => '^3.1.1',
        'tailwindcss' => '^3.3.6',
        'typescript' => '~5.3.3',
        'vite' => '^5.0.10',
        'vitest' => '^1.0.4',
        'vue' => '^3.3.12',
        'vue-router' => '^4.2.5',
        'vue-tsc' => '^1.8.25',
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-jumpstart')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->comment('Removing old files...');
                        $this->deleteOldFiles();

                        $command->comment('Copying new files...');
                        File::copyDirectory(dirname(__DIR__) . '/stubs', base_path());

                        $command->comment('Adding dependencies');
                        $this->modifyNodePackage();
                    });
            });
    }

    /**
     * Remove the existing files that are no longer needed.
     *
     * @return void
     */
    protected function deleteOldFiles(): void
    {
        File::delete(base_path('vite.config.js'));
        File::delete(resource_path('views/welcome.blade.php'));
        File::deleteDirectory(resource_path('js'));
    }

    /**
     * Adjust the node dependencies.
     *
     * @return void
     */
    protected function modifyNodePackage(): void
    {
        $packageFileName = base_path(self::PACKAGE_JSON);
        $configuration = File::json($packageFileName);

        unset($configuration['dependencies'], $configuration['devDependencies']);

        $configuration['scripts'] = self::NPM_COMMANDS;
        $configuration['devDependencies'] = self::NPM_DEPENDENCIES;

        ksort($configuration['devDependencies']);

        $data = json_encode($configuration, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        File::put(self::PACKAGE_JSON, $data);
    }
}
