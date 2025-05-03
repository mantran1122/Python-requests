/** @type {import('tailwindcss').Config} */
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
      colors: {
        primary: '#7C3AED', // Tím chủ đạo
        secondary: '#9333EA', // Tím sáng hơn
        accent: '#10B981', // Xanh ngọc
        danger: '#F43F5E', // Đỏ cảnh báo
        muted: '#64748B', // Text mờ
        background: '#1E1B4B', // Nền tím đậm
        card: '#312E81', // Card tím trung bình
        gray: '#9B9B9B',
        indigo: {
          500: '#6366F1',
          600: '#4F46E5',
          700: '#4338CA',
        },
        fuchsia: {
          400: '#F0ABFC',
          500: '#E879F9',
        },
        slate: {
          700: '#334155',
          800: '#1E293B',
        },
      },
      backgroundImage: {
        'gradient-to-br': 'linear-gradient(to bottom right, var(--tw-gradient-stops))',
      },
      borderRadius: {
        '2xl': '1rem',
        '3xl': '1.5rem',
      },
      boxShadow: {
        'magic': '0 4px 20px rgba(156, 39, 176, 0.3)',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: 0 },
          '100%': { opacity: 1 },
        },
      },
    },
  },
  plugins: [forms],
};
