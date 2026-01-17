import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import daisyui from 'daisyui'

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        daisyui,
    ],

    daisyui: {
        themes: [
            {
                adminTheme: {
                    primary: '#6366f1',   // indigo
                    secondary: '#8b5cf6', // violet
                    accent: '#22d3ee',    // cyan
                    neutral: '#1f2937',
                    'base-100': '#ffffff',
                    'base-200': '#f3f4f6',
                    'base-300': '#e5e7eb',
                    info: '#0ea5e9',
                    success: '#22c55e',
                    warning: '#f59e0b',
                    error: '#ef4444',
                },
            },
        ],
    },
}
