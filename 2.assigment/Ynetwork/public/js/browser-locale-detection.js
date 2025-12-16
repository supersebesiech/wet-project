 //Browser Locale Detection
document.addEventListener('DOMContentLoaded', function() {
    // Get browser language
    const browserLang = navigator.language || navigator.userLanguage;
    const langCode = browserLang.split('-')[0]; // Get primary language code
    
    const localeMap = {
        'nl': 'nl',
        'da': 'da',
        'de': 'de',
        'en': 'en'
    };
    
    // Get locale, default is 'en' when unsupported
    const detectedLocale = localeMap[langCode] || 'en';
    
    // Check if a locale was already set
    const currentLocaleFromSession = document.documentElement.getAttribute('data-locale') || '';
    
    if (detectedLocale !== 'en' && !currentLocaleFromSession) {
        window.location.href = `/set-locale/${detectedLocale}`;
    }
});