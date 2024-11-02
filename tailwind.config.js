import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/**/*.vue',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'sans-serif'],
            },
            colors: {
                background: '#1c1c1e',
                navbar: '#282a36',
                footer: '#181818',
                card: '#333337',
                'text-primary': '#FFFFFF',
                'text-secondary': '#B0B0B0',
                'accent-red': '#FF5252',
                'accent-yellow': '#FFB400',
                'text-muted': '#6E6E6E',
                'gray-800': '#333',
                'gray-600': '#666',
                'gray-500': '#555',
            },
        },
    },
}